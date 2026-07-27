<?php

namespace Tests\Feature;

use App\Models\Commission;
use App\Models\Referral;
use App\Models\ServiceProviderSubscription;
use App\Models\User;
use App\Models\WalletTransaction;
use App\Services\ReferralCommissionService;
use Database\Seeders\ProviderPermissionsSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * اختبارات ارتداد (Regression) لمعادلة عمولة الإحالة: commission = subscription->price × 10%،
 * بدون أي خصم أو ضريبة، أول اشتراك فقط، وإلغاء تلقائي عند الاسترجاع.
 *
 * تشغَّل على قاعدة بيانات معزولة (abaadapp_abaad_pdm_testing، انظر phpunit.xml)
 * مستنسخة البنية فقط من قاعدة العمل الفعلية عبر mysqldump --no-data — لا تلمس
 * أي بيانات حقيقية. DatabaseTransactions (وليس RefreshDatabase) لأن جداول
 * الأساس (users, service_provider_subscriptions, wallet_transactions) ليست
 * مُدارة بأي migration في هذا المشروع أصلًا (جداول قديمة سابقة لنظام
 * الـ migrations)، فـ migrate:fresh سيفشل في إنشائها.
 */
class ReferralCommissionRegressionTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        // إنشاء مستخدم provider يستدعي مراقب (observer) يُسند دور Spatie
        // تلقائيًا — يحتاج صفوف roles/permissions موجودة فعلًا (نفس ما تفعله
        // ProviderPermissionsTest الموجودة مسبقًا في المشروع).
        $this->seed(ProviderPermissionsSeeder::class);
    }

    private function makeUser(string $type = User::TYPE_PROVIDER): User
    {
        return User::create([
            'name' => 'Test User ' . uniqid(),
            'email' => 'user' . uniqid() . '@example.test',
            'phone' => '+9665' . random_int(10000000, 99999999),
            'password' => bcrypt('password'),
            'user_type' => $type,
            'is_active' => 'active',
            'zone_id' => 1,
        ]);
    }

    private function makeReferral(User $referrer, User $referred, string $status = 'PENDING_PAYMENT'): Referral
    {
        return Referral::create([
            'referrer_id' => $referrer->id,
            'referred_id' => $referred->id,
            'status' => $status,
        ]);
    }

    private function makeSubscription(User $provider, float $price, string $paymentStatus = 'paid'): ServiceProviderSubscription
    {
        return ServiceProviderSubscription::create([
            'user_id' => $provider->id,
            'service_plan_id' => 1,
            'duration' => 1,
            'expiry_date' => now()->addMonth()->toDateString(),
            'subscription_status' => 'active',
            'payment_status' => $paymentStatus,
            'price' => $price,
            'subscription_number' => 'SUB-' . uniqid(),
            'offer_id' => 1,
        ]);
    }

    /** @test */
    public function subscription_of_499_produces_commission_of_49_90(): void
    {
        $referrer = $this->makeUser();
        $provider = $this->makeUser();
        $this->makeReferral($referrer, $provider);
        $subscription = $this->makeSubscription($provider, 499);

        (new ReferralCommissionService())->createCommissionForPaidSubscription($subscription);

        $commission = Commission::where('user_id', $referrer->id)->first();
        $this->assertNotNull($commission, 'Commission should have been created');
        $this->assertEquals(49.90, $commission->amount);
        $this->assertEquals(Commission::STATUS_PENDING, $commission->status);
    }

    /** @test */
    public function subscription_of_599_produces_commission_of_59_90(): void
    {
        // 599 = 499 (الباقة الذهبية) + 100 إضافات، مطابق لمثال متطلبات النص.
        $referrer = $this->makeUser();
        $provider = $this->makeUser();
        $this->makeReferral($referrer, $provider);
        $subscription = $this->makeSubscription($provider, 599);

        (new ReferralCommissionService())->createCommissionForPaidSubscription($subscription);

        $commission = Commission::where('user_id', $referrer->id)->first();
        $this->assertNotNull($commission);
        $this->assertEquals(59.90, $commission->amount);
    }

    /** @test */
    public function no_more_than_one_commission_is_created_for_the_first_subscription(): void
    {
        $referrer = $this->makeUser();
        $provider = $this->makeUser();
        $this->makeReferral($referrer, $provider);
        $subscription = $this->makeSubscription($provider, 499);

        $service = new ReferralCommissionService();
        $service->createCommissionForPaidSubscription($subscription);
        // استدعاء ثانٍ لنفس الاشتراك (محاكاة إعادة محاولة webhook من Moyasar).
        $service->createCommissionForPaidSubscription($subscription);

        $this->assertEquals(1, Commission::where('user_id', $referrer->id)->count());
    }

    /** @test */
    public function no_commission_is_created_for_a_second_subscription_by_the_same_referred_provider(): void
    {
        // "أول اشتراك فقط": اشتراك ثانٍ لنفس المزوّد المُحال يجب ألا يُنشئ عمولة.
        $referrer = $this->makeUser();
        $provider = $this->makeUser();
        $this->makeReferral($referrer, $provider);

        $firstSubscription = $this->makeSubscription($provider, 499);
        (new ReferralCommissionService())->createCommissionForPaidSubscription($firstSubscription);

        $secondSubscription = $this->makeSubscription($provider, 499);
        (new ReferralCommissionService())->createCommissionForPaidSubscription($secondSubscription);

        $this->assertEquals(1, Commission::where('user_id', $referrer->id)->count());
    }

    /** @test */
    public function commission_is_cancelled_on_refund(): void
    {
        $referrer = $this->makeUser();
        $provider = $this->makeUser();
        $this->makeReferral($referrer, $provider);
        $subscription = $this->makeSubscription($provider, 499);

        $service = new ReferralCommissionService();
        $service->createCommissionForPaidSubscription($subscription);

        $commission = Commission::where('user_id', $referrer->id)->first();
        $this->assertEquals(Commission::STATUS_PENDING, $commission->status);

        // محاكاة استرجاع الاشتراك.
        $subscription->payment_status = 'refunded';
        $subscription->save();

        $service->cancelCommissionForSubscription($subscription);

        $commission->refresh();
        $this->assertEquals(Commission::STATUS_CANCELLED, $commission->status);
    }

    /** @test */
    public function cancelling_an_available_commission_reverses_the_wallet_credit(): void
    {
        $referrer = $this->makeUser();
        $provider = $this->makeUser();
        $referral = $this->makeReferral($referrer, $provider, 'COMPLETED');

        $commission = Commission::create([
            'user_id' => $referrer->id,
            'referral_id' => $referral->id,
            'amount' => 49.90,
            'status' => Commission::STATUS_AVAILABLE,
        ]);

        WalletTransaction::create([
            'user_id' => $referrer->id,
            'transaction_id' => (string) Str::uuid(),
            'credit' => 49.90,
            'debit' => 0,
            'admin_bonus' => 0,
            'balance' => 49.90,
            'transaction_type' => 'referral_commission',
            'reference' => 'commission:' . $commission->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $subscription = $this->makeSubscription($provider, 499, 'refunded');

        (new ReferralCommissionService())->cancelCommissionForSubscription($subscription);

        $commission->refresh();
        $this->assertEquals(Commission::STATUS_CANCELLED, $commission->status);

        $lastBalance = (float) WalletTransaction::where('user_id', $referrer->id)->latest('id')->value('balance');
        $this->assertEquals(0.0, $lastBalance);
    }
}
