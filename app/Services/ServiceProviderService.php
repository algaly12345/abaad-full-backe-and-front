<?php

namespace App\Services;

use App\Models\Offer;
use App\Models\ServicePlan;
use App\Models\ServiceProviderSubscription;
use App\Models\ServiceType;
use App\Models\Category;
use App\Models\Zone;
use App\Helpers\FileUploder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ServiceProviderService
{
    /** الرسوم الإضافية لكل منطقة تتجاوز حد الباقة — مطابق لواجهة الويب. */
    const EXTRA_ZONE_COST = 50;

    /**
     * بيانات الإعداد لشاشة "إضافة خدمة داخل عقار"
     * (أنواع الخدمات، الأقسام، المناطق، الباقات).
     */
    public function getSetupData(): array
    {
        return [
            'service_types' => ServiceType::select('id', 'name')->get(),
            'categories' => Category::select('id', 'name', 'name_ar')->get(),
            'zones' => Zone::select('id', 'name', 'name_ar')->where('status', 1)->get(),
            'service_plans' => ServicePlan::all(),
        ];
    }

    /**
     * حساب السعر النهائي مطابق تماماً لمنطق الواجهة:
     * الإجمالي = (سعر الباقة × عدد الأشهر) + (عدد المناطق الزائدة عن حد الباقة × 50 ريال)
     */
    public function calculatePrice(ServicePlan $plan, int $duration, int $zonesSelected): array
    {
        $allowedZones = (int) ($plan->number_of_zone ?? 0);
        $extraZones = max(0, $zonesSelected - $allowedZones);
        $extraCost = $extraZones * self::EXTRA_ZONE_COST;

        $basePrice = (float) $plan->price * $duration;
        $total = $basePrice + $extraCost;

        return [
            'base_price' => round($basePrice, 2),
            'extra_zones' => $extraZones,
            'extra_zones_cost' => round($extraCost, 2),
            'total_price' => round($total, 2),
        ];
    }

    /**
     * إنشاء العرض والاشتراك المالي، ثم توليد رابط دفع موقّع (Signed URL)
     * صالح لمدة محدودة، يستخدمه التطبيق مباشرة داخل WebView.
     */
    public function createOfferAndSubscription(array $data, $user, $imageFile): array
    {
        return DB::transaction(function () use ($data, $user, $imageFile) {
            $plan = ServicePlan::findOrFail($data['service_plan_id']);
            $duration = (int) $data['subscription_duration'];
            $zonesCount = count($data['zones']);

            // يُحفَظ مرة واحدة داخل service_providers ليُقرَأ لاحقاً من التطبيق
            // فلا يُطلَب من المزوّد إعادة إدخاله في كل عرض جديد.
            if (!empty($data['identity_type'])) {
                $identityUpdates = ['identity_type' => $data['identity_type']];
                if ($data['identity_type'] === 'individual' && !empty($data['identity_number'])) {
                    $identityUpdates['identity_number'] = $data['identity_number'];
                }
                if ($data['identity_type'] === 'company' && !empty($data['commercial_registration_no'])) {
                    $identityUpdates['commercial_registration_no'] = $data['commercial_registration_no'];
                }
                $user->provider?->update($identityUpdates);
            }

            $pricing = $this->calculatePrice($plan, $duration, $zonesCount);

            $serviceType = ServiceType::firstOrCreate(['name' => $data['service_type']]);

            $image = null;
            if ($imageFile) {
                $requestWrapper = new class($imageFile) {
                    public $image;
                    public function __construct($file) { $this->image = $file; }
                    public function has($key) { return true; }
                };
                $image = FileUploder::uploadOneImage($requestWrapper, 'offers');
            }

            $expiryDate = Carbon::now()->addMonths($duration)->format('Y-m-d');

            $offer = Offer::create([
                'title' => $data['title'],
                'expiry_date' => $expiryDate,
                'service_price' => $data['service_price'] ?? null,
                'description' => $data['description'],
                'discount' => $data['discount'] ?? null,
                'offer_type' => $data['offer_type'],
                'service_type_id' => $serviceType->id,
                'offer_owner' => 'me',
                'image' => $image,
                'phone_provider' => $user->phone ?? '',
            ]);

            $offer->serviceProviders()->attach($user->id);
            $offer->categories()->attach($data['categories']);
            $offer->zones()->attach($data['zones']);
            $offer->updateOfferStatusToSended();

            $subscriptionNumber = 'SUB-' . strtoupper(uniqid());

            $subscription = ServiceProviderSubscription::create([
                'user_id' => $user->id,
                'service_plan_id' => $plan->id,
                'duration' => $duration,
                'expiry_date' => $expiryDate,
                'subscription_status' => 'pending',
                'payment_status' => 'unpaid',
                'price' => $pricing['total_price'],
                'offer_id' => $offer->id,
                'subscription_number' => $subscriptionNumber,
                'number_of_ads' => $plan->number_of_ads ?? 0,
                'number_of_categories' => count($data['categories']),
                'number_of_zone' => $zonesCount,
            ]);

            // رابط دفع موقّع رقمياً وصالح لمدة ساعتين فقط — هذا الرابط
            // هو ما يفتحه تطبيق الأندرويد داخل WebView مخصص.
            $paymentUrl = URL::temporarySignedRoute(
                'payment.provider-subscription.show',
                now()->addHours(2),
                ['subscription' => $subscription->id]
            );

            return [
                'offer_id' => $offer->id,
                'subscription_id' => $subscription->id,
                'subscription_number' => $subscriptionNumber,
                'plan_name' => $plan->name,
                'duration' => $duration,
                'expiry_date' => $expiryDate,
                'base_price' => $pricing['base_price'],
                'extra_zones' => $pricing['extra_zones'],
                'extra_zones_cost' => $pricing['extra_zones_cost'],
                'amount_to_pay' => $pricing['total_price'],
                'currency' => 'SAR',
                'payment_url' => $paymentUrl,
            ];
        });
    }
}