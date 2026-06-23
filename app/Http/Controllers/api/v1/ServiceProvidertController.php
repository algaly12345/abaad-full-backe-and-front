<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOfferRequest;
use App\Services\ServiceProviderService;
use App\Models\EstateOffer;
use App\Models\ServiceProviderSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceProvidertController extends Controller
{
    protected $serviceProviderService;

    public function __construct(ServiceProviderService $serviceProviderService)
    {
        $this->serviceProviderService = $serviceProviderService;
    }

    public function update(Request $request)
    {
        $offer = EstateOffer::where(['estate_id' => $request['estate_id']])->update([
            'status' => 'accept'
        ]);
        if ($offer) {
            return "ok";
        }
    }

    public function index(Request $request)
    {
        $rows = DB::table('service_provider_subscriptions as sps')
            ->leftJoin('users as u', 'u.id', '=', 'sps.user_id')
            ->leftJoin('subscription_packages as sp', 'sp.id', '=', 'sps.service_plan_id')
            ->selectRaw("
                sps.id,
                sps.subscription_number,
                sps.subscription_status,
                sps.payment_status,
                sps.duration,
                sps.expiry_date,
                sps.price,

                u.id AS user_id,
                u.name AS user_name,
                u.email AS user_email,

                sp.package_name,
                sp.price AS package_price,
                sp.validity AS package_validity
            ")
            ->orderByDesc('sps.id')
            ->get();

        return response()->json([
            'success' => true,
            'count' => $rows->count(),
            'data' => $rows,
        ], 200);
    }

    /**
     * GET /api/v1/provider-subscriptions/offer-setup-data
     * بيانات الإعداد لشاشة "إضافة خدمة داخل عقار".
     */
    public function getOfferSetupData()
    {
        try {
            $data = $this->serviceProviderService->getSetupData();
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'فشل جلب البيانات التحضيرية',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /api/v1/provider-subscriptions/calculate-price
     * حساب السعر اللحظي حسب الباقة/المدة/عدد المناطق، بدون حفظ.
     * Body: service_plan_id, subscription_duration, zones_count
     */
    public function calculatePrice(Request $request)
    {
        $request->validate([
            'service_plan_id' => 'required|exists:service_plans,id',
            'subscription_duration' => 'required|integer|in:1,3,6,12',
            'zones_count' => 'required|integer|min:0',
        ]);

        $plan = \App\Models\ServicePlan::find($request->service_plan_id);

        $pricing = $this->serviceProviderService->calculatePrice(
            $plan,
            (int) $request->subscription_duration,
            (int) $request->zones_count
        );

        return response()->json([
            'status' => 'success',
            'data' => $pricing,
        ], 200);
    }

    /**
     * POST /api/v1/provider-subscriptions/store-offer
     * إنشاء العرض والاشتراك. الرد يحتوي payment_url لفتحه في WebView.
     */
    public function storeOfferAPI(StoreOfferRequest $request)
    {
        try {
            $user = auth()->user();
            $result = $this->serviceProviderService->createOfferAndSubscription(
                $request->validated(),
                $user,
                $request->file('image')
            );

            return response()->json([
                'status' => 'success',
                'message' => 'تم تسجيل الطلب بنجاح بانتظار إتمام الدفع',
                'data' => $result
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'فشلت عملية إنشاء العرض والاشتراك المالي',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/v1/provider-subscriptions/{subscription_number}/status
     * يستدعيه التطبيق بعد إغلاق WebView للتأكد الحقيقي من نتيجة الدفع
     * عبر التوكن العادي (Bearer)، بدلاً من الثقة بمحتوى صفحة WebView فقط.
     */
    public function getSubscriptionStatus($subscriptionNumber)
    {
        $subscription = ServiceProviderSubscription::where('subscription_number', $subscriptionNumber)
            ->where('user_id', auth()->id())
            ->first();

        if (! $subscription) {
            return response()->json([
                'status' => 'error',
                'message' => 'الاشتراك غير موجود',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'subscription_number' => $subscription->subscription_number,
                'payment_status'      => $subscription->payment_status,
                'subscription_status' => $subscription->subscription_status,
                'is_paid'              => $subscription->payment_status === 'paid',
            ],
        ]);
    }
}