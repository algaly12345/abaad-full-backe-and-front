<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\CommissionWithdrawalRequest;
use App\Models\ProviderPayoutMethod;
use App\Models\Referral;
use App\Models\ReferralSetting;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReferralController extends Controller
{
    /**
     * كود/رابط الإحالة الخاص بمزوّد الخدمة الحالي — يُولَّد عند أول طلب إن لم
     * يكن موجودًا. 10 أحرف بالضبط لتوافق التحقق الموجود في تطبيق الجوال.
     */
    public function myLink(Request $request)
    {
        $user = $request->user();

        if (empty($user->referral_code)) {
            $user->referral_code = $this->generateUniqueReferralCode();
            $user->save();
        }

        // نفس النطاق الذي يستمع له تطبيق الجوال في MyApp._handleReferralLink (main.dart).
        $referralLink = "https://abaadapp.sa/ref/{$user->referral_code}";

        return response()->json([
            'referral_code' => $user->referral_code,
            'referral_link' => $referralLink,
            'share_text' => "سجّل في تطبيق أبعاد عبر رابط الإحالة الخاص بي: {$referralLink}",
        ], 200);
    }

    /**
     * قائمة المُحالين من طرف المستخدم الحالي: اسم مزود الخدمة، الباقة، قيمة
     * العملية، المكافأة، حالتها، وتاريخ توفرها للسحب.
     */
    public function index(Request $request)
    {
        $referrals = Referral::with(['referred:id,name,phone,image', 'commission'])
            ->where('referrer_id', $request->user()->id)
            ->latest('id')
            ->get();

        $data = $referrals->map(function (Referral $referral) {
            $commission = $referral->commission;
            // oldest('id') وليس latest: العمولة تُحسَب دائماً من أول اشتراك
            // مدفوع فقط (راجع ReferralCommissionService)، وأي معرّف لاحق ينتمي
            // بالضرورة لتجديد لاحق أُنشئ بعده. لو استخدمنا latest هنا، ستُعرض
            // باقة/مبلغ التجديد الأخير بجانب مبلغ عمولة محسوب من الاشتراك الأول
            // فيتناقض العمودان لنفس السطر.
            $subscription = $commission
                ? \App\Models\ServiceProviderSubscription::where('user_id', $referral->referred_id)
                    ->where('payment_status', 'paid')
                    ->with('servicePlan:id,name')
                    ->oldest('id')
                    ->first()
                : null;

            return [
                'referred_name' => $referral->referred->name ?? null,
                'referred_phone' => $referral->referred->phone ?? null,
                'referred_image' => $referral->referred->image ?? null,
                'package_name' => $subscription->servicePlan->name ?? null,
                'transaction_amount' => $subscription ? (float) $subscription->price : null,
                'commission_amount' => $commission->amount ?? null,
                'commission_status' => $commission->status ?? null,
                'referral_status' => $referral->status,
                'available_at' => $commission->available_at ?? null,
                'created_at' => $referral->created_at,
            ];
        });

        return response()->json(['data' => $data], 200);
    }

    /**
     * إجماليات المكافآت حسب الحالة، لعرضها في لوحة المسوّق.
     */
    public function summary(Request $request)
    {
        $userId = $request->user()->id;

        $totals = Commission::where('user_id', $userId)
            ->selectRaw('status, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        $availableBalance = $this->availableCommissionBalance($userId);

        return response()->json([
            'referred_count' => Referral::where('referrer_id', $userId)->count(),
            'pending_total' => (float) ($totals['PENDING']->total ?? 0),
            'approved_total' => (float) ($totals['APPROVED']->total ?? 0),
            'available_total' => (float) ($totals['AVAILABLE']->total ?? 0),
            'withdrawn_total' => (float) ($totals['WITHDRAWN']->total ?? 0),
            'available_balance' => $availableBalance,
            // الحد الأدنى للسحب المضبوط من لوحة الإدارة — يعتمد عليه تطبيق الجوال
            // لتفعيل زرّ الطلب وعرض شريط التقدّم نحو الحد. 0 = بلا حد أدنى.
            'min_payout_limit' => (float) ReferralSetting::current()->min_payout_limit,
        ], 200);
    }

    /**
     * طلب سحب الرصيد المتاح. يُخصم فورًا من الرصيد المتاح كـ"محجوز" بحالة
     * pending. صرف/رفض الطلب من طرف الإدارة خارج نطاق هذا الإصدار.
     */
    public function requestWithdrawal(Request $request)
    {
        $this->normalizePayoutInput($request);

        $validator = Validator::make(
            $request->all(),
            array_merge(['amount' => 'required|numeric|min:0.01'], $this->payoutRules()),
            $this->payoutMessages()
        );

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $user = $request->user();
        $amount = (float) $request->amount;
        $settings = ReferralSetting::current();

        if ($settings->min_payout_limit > 0 && $amount < $settings->min_payout_limit) {
            return response()->json([
                'errors' => [['code' => 'withdrawal-002', 'message' => 'المبلغ أقل من الحد الأدنى للسحب']],
            ], 403);
        }

        $payout = [
            'account_holder_name' => trim($request->account_holder_name),
            'iban' => $request->iban,
            'bank_name' => trim($request->bank_name),
            'national_id' => $request->national_id,
        ];

        // معاملة + قفل صفوف العمولات المتاحة لهذا المستخدم: بدونها، طلبا سحب
        // متزامنان (ضغط مزدوج على الزر، أو محاولة متعمّدة) قد يقرآن نفس
        // الرصيد المتاح قبل أن يكتب أي منهما، فيسمحان معًا بسحب أكبر من
        // الرصيد الفعلي (double-spend).
        $result = DB::transaction(function () use ($user, $amount, $payout) {
            $available = $this->lockedAvailableCommissionBalance($user->id);

            if ($amount > $available) {
                return ['error' => true];
            }

            // "يُحفظ مرّة": أحدث حساب إيداع يبقى مخزّنًا على مستوى المستخدم
            // لتعبئة ورقة السحب تلقائيًا في المرة القادمة.
            ProviderPayoutMethod::updateOrCreate(['user_id' => $user->id], $payout);

            // "نسخة مع كل طلب": تُثبَّت القيم داخل صف الطلب حتى لا تتأثر بأي
            // تعديل لاحق على حساب الإيداع — تبقى لدى الإدارة كما كانت وقت الطلب.
            $withdrawal = CommissionWithdrawalRequest::create(array_merge([
                'user_id' => $user->id,
                'amount' => $amount,
                'status' => 'pending',
                'requested_at' => now(),
            ], $payout));

            $lastBalance = (float) (WalletTransaction::where('user_id', $user->id)->latest('id')->value('balance') ?? 0);
            WalletTransaction::create([
                'user_id' => $user->id,
                'transaction_id' => (string) Str::uuid(),
                'credit' => 0,
                'debit' => $amount,
                'admin_bonus' => 0,
                'balance' => round($lastBalance - $amount, 3),
                'transaction_type' => 'referral_withdrawal_request',
                'reference' => 'withdrawal:' . $withdrawal->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return ['error' => false, 'withdrawal' => $withdrawal];
        });

        if ($result['error']) {
            return response()->json([
                'errors' => [['code' => 'withdrawal-001', 'message' => 'المبلغ المطلوب أكبر من الرصيد المتاح للسحب']],
            ], 403);
        }

        return response()->json(['data' => $result['withdrawal']], 201);
    }

    /**
     * حساب الإيداع المحفوظ لمزوّد الخدمة الحالي — لتعبئة ورقة السحب مسبقًا.
     * يُرجع data = null إن لم يحفظ المزوّد حسابًا بعد.
     */
    public function payoutMethod(Request $request)
    {
        return response()->json([
            'data' => ProviderPayoutMethod::where('user_id', $request->user()->id)->first(),
        ], 200);
    }

    /**
     * حفظ/تحديث حساب الإيداع دون تقديم طلب سحب.
     */
    public function savePayoutMethod(Request $request)
    {
        $this->normalizePayoutInput($request);

        $validator = Validator::make($request->all(), $this->payoutRules(), $this->payoutMessages());

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $method = ProviderPayoutMethod::updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'account_holder_name' => trim($request->account_holder_name),
                'iban' => $request->iban,
                'bank_name' => trim($request->bank_name),
                'national_id' => $request->national_id,
            ]
        );

        return response()->json(['data' => $method], 200);
    }

    /**
     * توحيد صيغة الآيبان (بلا فراغات، أحرف كبيرة) ورقم الهوية (أرقام فقط)
     * قبل التحقق والتخزين.
     */
    private function normalizePayoutInput(Request $request): void
    {
        $request->merge([
            'iban' => strtoupper(str_replace(' ', '', (string) $request->input('iban'))),
            'national_id' => preg_replace('/\D/', '', (string) $request->input('national_id')),
        ]);
    }

    /**
     * قواعد بيانات حساب الإيداع: آيبان سعودي (SA + 22 رقمًا)، رقم هوية/إقامة
     * من 10 أرقام.
     */
    private function payoutRules(): array
    {
        return [
            'account_holder_name' => 'required|string|max:255',
            'iban' => ['required', 'string', 'regex:/^SA\d{22}$/'],
            'bank_name' => 'required|string|max:255',
            'national_id' => ['required', 'string', 'regex:/^\d{10}$/'],
        ];
    }

    private function payoutMessages(): array
    {
        return [
            'amount.required' => 'الرجاء إدخال مبلغ صحيح',
            'amount.numeric' => 'الرجاء إدخال مبلغ صحيح',
            'amount.min' => 'الرجاء إدخال مبلغ صحيح',
            'account_holder_name.required' => 'الرجاء إدخال اسم صاحب الحساب',
            'iban.required' => 'الرجاء إدخال رقم الآيبان',
            'iban.regex' => 'رقم الآيبان غير صحيح (يبدأ بـ SA ويليه 22 رقمًا)',
            'bank_name.required' => 'الرجاء إدخال اسم البنك',
            'national_id.required' => 'الرجاء إدخال رقم الهوية',
            'national_id.regex' => 'رقم الهوية يجب أن يكون 10 أرقام',
        ];
    }

    public function withdrawals(Request $request)
    {
        $withdrawals = CommissionWithdrawalRequest::where('user_id', $request->user()->id)
            ->latest('id')
            ->get();

        return response()->json(['data' => $withdrawals], 200);
    }

    /**
     * الرصيد المتاح فعليًا لسحب مكافآت الإحالة: مجموع العمولات AVAILABLE،
     * ناقص أي طلبات سحب سابقة لم تُرفض بعد. مُتعمّد عدم استخدام العمود
     * wallet_transactions.balance مباشرة هنا لأنه سجل مشترك يشمل مصادر أخرى
     * (نقاط الولاء، مكافآت الإدارة)، فلا يعكس بدقة الرصيد القابل للسحب من
     * عمولات الإحالة تحديدًا.
     */
    private function availableCommissionBalance(int $userId): float
    {
        $availableCommissions = (float) Commission::where('user_id', $userId)
            ->where('status', Commission::STATUS_AVAILABLE)
            ->sum('amount');

        $reservedWithdrawals = (float) CommissionWithdrawalRequest::where('user_id', $userId)
            ->whereIn('status', ['pending', 'approved', 'paid'])
            ->sum('amount');

        return max(0, round($availableCommissions - $reservedWithdrawals, 2));
    }

    /**
     * نفس حساب availableCommissionBalance لكن بقفل صفوف (lockForUpdate) —
     * يُستخدم فقط داخل معاملة DB::transaction في requestWithdrawal لمنع
     * سباق طلبي سحب متزامنين لنفس المستخدم من سحب أكثر من الرصيد الفعلي.
     */
    private function lockedAvailableCommissionBalance(int $userId): float
    {
        $availableCommissions = (float) Commission::where('user_id', $userId)
            ->where('status', Commission::STATUS_AVAILABLE)
            ->lockForUpdate()
            ->sum('amount');

        $reservedWithdrawals = (float) CommissionWithdrawalRequest::where('user_id', $userId)
            ->whereIn('status', ['pending', 'approved', 'paid'])
            ->lockForUpdate()
            ->sum('amount');

        return max(0, round($availableCommissions - $reservedWithdrawals, 2));
    }

    private function generateUniqueReferralCode(): string
    {
        do {
            $code = 'SP' . strtoupper(Str::random(8));
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }
}
