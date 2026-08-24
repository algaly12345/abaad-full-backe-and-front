<?php

namespace App\Services;

use App\Models\Offer;
use App\Models\ServiceProviderSubscription;
use App\Models\ServiceType;
use App\Models\Category;
use App\Models\User;
use App\Models\Zone;
use App\Models\SubscriptionDurationDiscount;
use App\Models\SubscriptionPricingSetting;
use App\Helpers\FileUploder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ServiceProviderService
{
    /**
     * بيانات الإعداد لشاشة "إضافة خدمة داخل عقار"
     * (أنواع الخدمات، الأقسام، المناطق، إعدادات التسعير ونسب الخصم).
     */
    public function getSetupData(): array
    {
        return [
            'service_types' => ServiceType::select('id', 'name')->get(),
            'categories' => Category::select('id', 'name', 'name_ar')->get(),
            'zones' => Zone::select('id', 'name', 'name_ar')->where('status', 1)->get(),
            'pricing_settings' => SubscriptionPricingSetting::current(),
            'duration_discounts' => SubscriptionDurationDiscount::orderBy('duration_months')->get(),
        ];
    }

    /**
     * حساب السعر النهائي حسب آلية الاشتراك الجديدة:
     * السعر الشهري = الأساسي + (المناطق الزائدة عن الحد المشمول × سعر المنطقة الإضافية)
     *                        + (الأنواع الزائدة عن الحد المشمول × سعر النوع الإضافي)
     * الإجمالي قبل الخصم = السعر الشهري × المدة (بالأشهر)
     * الإجمالي النهائي = الإجمالي قبل الخصم − (نسبة الخصم حسب المدة × الإجمالي قبل الخصم)
     */
    public function calculatePrice(int $duration, int $zonesCount, int $categoriesCount): array
    {
        $settings = SubscriptionPricingSetting::current();

        $extraZones = max(0, $zonesCount - $settings->included_zones);
        $extraCategories = max(0, $categoriesCount - $settings->included_categories);

        $extraZonesCost = $extraZones * $settings->extra_zone_price;
        $extraCategoriesCost = $extraCategories * $settings->extra_category_price;

        $monthlyTotal = $settings->base_price + $extraZonesCost + $extraCategoriesCost;
        $subtotal = $monthlyTotal * $duration;

        $discountPercent = SubscriptionDurationDiscount::percentFor($duration);
        $discountAmount = $subtotal * $discountPercent / 100;
        $total = $subtotal - $discountAmount;

        return [
            'base_price' => round($settings->base_price, 2),
            'extra_zones' => $extraZones,
            'extra_zones_cost' => round($extraZonesCost, 2),
            'extra_categories' => $extraCategories,
            'extra_categories_cost' => round($extraCategoriesCost, 2),
            'monthly_total' => round($monthlyTotal, 2),
            'duration' => $duration,
            'subtotal_before_discount' => round($subtotal, 2),
            'discount_percent' => $discountPercent,
            'discount_amount' => round($discountAmount, 2),
            'total_price' => round($total, 2),
        ];
    }

    /**
     * يحدّث سجل service_providers الخاص بالمستخدم ببيانات الهوية (فرد/منشأة)
     * — مصدر الحقيقة الوحيد لهذه البيانات، يُستدعى فورياً من ProviderUpgradeScreen
     * (updateIdentity API) وأيضاً كتأكيد إضافي عند إنشاء أول عرض.
     */
    public function updateProviderIdentity(array $data, $user): void
    {
        $identityUpdates = ['identity_type' => $data['identity_type']];
        if ($data['identity_type'] === 'individual' && !empty($data['identity_number'])) {
            $identityUpdates['identity_number'] = $data['identity_number'];
        }
        if ($data['identity_type'] === 'individual' && !empty($data['freelance_membership_number'])) {
            $identityUpdates['freelance_membership_number'] = $data['freelance_membership_number'];
        }
        if ($data['identity_type'] === 'company' && !empty($data['commercial_registration_no'])) {
            $identityUpdates['commercial_registration_no'] = $data['commercial_registration_no'];
        }
        $user->provider?->update($identityUpdates);

        // إرسال بيانات الهوية (فرد/منشأة) وحده كافٍ ليصبح الحساب مزوّد خدمة
        // فعلياً فوراً — بلا انتظار إرسال عرض خدمة أو نجاح دفع. $user->update()
        // لا DB::table() حتى يمر التغيير عبر Eloquent فيُطلق UserObserver الذي
        // يُسنِد دور ProviderRole::PROVIDER تلقائياً.
        if (!$user->isProvider()) {
            $user->update(['user_type' => User::TYPE_PROVIDER]);
        }
    }

    /**
     * يحدّث بيانات عمل مزوّد الخدمة — تُستدعى من شاشة استكمال البيانات
     * (CompleteProviderProfileScreen) عند إضافة مزوّد الخدمة أول عرض له
     * وبياناته ناقصة. zone_id/latitude/longitude اختيارية (لا تجمعها هذه
     * الشاشة حاليًا) فتُحدَّث فقط إن وردت.
     */
    public function updateProviderBusinessInfo(array $data, $user): void
    {
        $user->provider?->update(array_intersect_key(
            $data,
            array_flip(['address', 'zone_id', 'latitude', 'longitude'])
        ));
    }

    /**
     * إنشاء العرض والاشتراك المالي، ثم توليد رابط دفع موقّع (Signed URL)
     * صالح لمدة محدودة، يستخدمه التطبيق مباشرة داخل WebView.
     */
    public function createOfferAndSubscription(array $data, $user, $imageFile): array
    {
        return DB::transaction(function () use ($data, $user, $imageFile) {
            $duration = (int) $data['subscription_duration'];
            $zonesCount = count($data['zones']);
            $categoriesCount = count($data['categories']);

            // يُحفَظ مرة واحدة داخل service_providers ليُقرَأ لاحقاً من التطبيق
            // فلا يُطلَب من المزوّد إعادة إدخاله في كل عرض جديد. عادة تصل هذه
            // الحقول محفوظة سلفاً (حُفظت فوراً من ProviderUpgradeScreen عبر
            // updateProviderIdentity()، وهي أيضاً نقطة الترقية إلى provider —
            // راجعها أعلاه)، فهذا مجرد تأكيد إضافي غير ضار.
            if (!empty($data['identity_type'])) {
                $this->updateProviderIdentity($data, $user);
            }

            $pricing = $this->calculatePrice($duration, $zonesCount, $categoriesCount);

            $serviceType = ServiceType::firstOrCreate(['name' => $data['service_type']]);

            $image = null;
            if ($imageFile) {
                $requestWrapper = new class($imageFile) {
                    public $image;
                    public function __construct($file) { $this->image = $file; }
                    public function has($key) { return true; }
                };
                $image = FileUploder::uploadOneImage($requestWrapper, 'service-providers');
                if ($image === false) {
                    // رمي استثناء هنا يُلغي كامل المعاملة (DB::transaction) فلا يُنشأ
                    // عرض أو اشتراك بصورة فاسدة — storeOfferAPI يلتقطه ويُعيد 500 واضح.
                    throw new \RuntimeException('فشل رفع صورة الخدمة، يرجى المحاولة لاحقًا');
                }
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
                'contact_phone' => $data['contact_phone'] ?? $user->phone ?? '',
                'contact_type' => $data['contact_type'] ?? 'phone',
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'address' => $data['address'] ?? null,
            ]);

            // status='accept' على الـ pivot هنا ضروري وليس تفصيلاً: هذا عمود
            // منفصل تمامًا عن Offer.status نفسه (الذي يتحكم بظهور العرض عمومًا
            // أو بقائه pending للمراجعة) — ServiceCatalogService يُحمّل علاقة
            // serviceProviders دائمًا بشرط wherePivot('status','accept') ليبني
            // مصفوفة 'providers' في ServiceOfferResource (اسم/هاتف/صورة/روابط
            // التواصل الاجتماعي). بدونها هنا تبقى تلك المصفوفة فارغة دائمًا —
            // لا تظهر بيانات المزوّد إطلاقًا بصرف النظر عن اعتماد الأدمن.
            $offer->serviceProviders()->attach($user->id, ['status' => 'accept']);
            $offer->categories()->attach($data['categories']);
            $offer->zones()->attach($data['zones']);
            $offer->updateOfferStatusToSended();

            $subscriptionNumber = 'SUB-' . strtoupper(uniqid());

            $subscription = ServiceProviderSubscription::create([
                'user_id' => $user->id,
                'duration' => $duration,
                'expiry_date' => $expiryDate,
                'subscription_status' => 'pending',
                'payment_status' => 'unpaid',
                'price' => $pricing['total_price'],
                'offer_id' => $offer->id,
                'subscription_number' => $subscriptionNumber,
                'number_of_ads' => 1,
                'number_of_categories' => $categoriesCount,
                'number_of_zone' => $zonesCount,
                'base_price' => $pricing['base_price'],
                'extra_zones_cost' => $pricing['extra_zones_cost'],
                'extra_categories_count' => $pricing['extra_categories'],
                'extra_categories_cost' => $pricing['extra_categories_cost'],
                'monthly_total' => $pricing['monthly_total'],
                'discount_percent' => $pricing['discount_percent'],
                'discount_amount' => $pricing['discount_amount'],
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
                'duration' => $duration,
                'expiry_date' => $expiryDate,
                'base_price' => $pricing['base_price'],
                'extra_zones' => $pricing['extra_zones'],
                'extra_zones_cost' => $pricing['extra_zones_cost'],
                'extra_categories' => $pricing['extra_categories'],
                'extra_categories_cost' => $pricing['extra_categories_cost'],
                'monthly_total' => $pricing['monthly_total'],
                'subtotal_before_discount' => $pricing['subtotal_before_discount'],
                'discount_percent' => $pricing['discount_percent'],
                'discount_amount' => $pricing['discount_amount'],
                'amount_to_pay' => $pricing['total_price'],
                'currency' => 'SAR',
                'payment_url' => $paymentUrl,
            ];
        });
    }
}