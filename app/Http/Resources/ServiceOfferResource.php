<?php

namespace App\Http\Resources;

use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceOfferResource extends JsonResource
{
    // يُخزَّن مرة واحدة لكل طلب حتى لا تتكرر قراءة business_settings لكل عرض
    // عند عرض قائمة (تجنّب N+1 query غير ضروري).
    private static ?string $cachedR2BaseUrl = null;

    private function r2BaseUrl(): string
    {
        if (self::$cachedR2BaseUrl === null) {
            self::$cachedR2BaseUrl = rtrim((string) Helpers::get_business_settings('r2_public_url'), '/');
        }

        return self::$cachedR2BaseUrl;
    }

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            // يُخزَّن المسار النسبي كاملاً (مجلد+اسم) في قاعدة البيانات، بدون نطاق/رابط
            // كامل — الصور القديمة تحت offers/ والجديدة تحت service-providers/، وكل
            // سجل يحمل مجلده الفعلي فلا حاجة لأي تخمين هنا. النطاق نفسه يأتي من
            // business_settings (r2_public_url) بدل .env مباشرة.
            'image'         => $this->offerImagePath() ? $this->r2BaseUrl() . '/' . $this->offerImagePath() : null,
            'offer_type'    => $this->offer_type,
            'service_price' => $this->service_price !== null ? (float) $this->service_price : null,
            'discount'      => $this->discount !== null ? (float) $this->discount : null,
            'discount_type' => $this->discount_type,
            'formatted_discount' => $this->formatted_discount,
            'latitude'      => $this->latitude !== null ? (float) $this->latitude : null,
            'longitude'     => $this->longitude !== null ? (float) $this->longitude : null,
            // عنوان تفصيلي حرّ اختياري (مثل "خميس مشيط - حي المروج") — أدق من
            // zones فقط، يُترك null على العروض القديمة قبل إضافة هذا الحقل.
            'address'       => $this->address,
            'expiry_date'   => $this->expiry_date,
            'is_expired'    => $this->expiry_date ? $this->isExpired() : false,
            'status'        => $this->status,
            'owner_id'      => $this->offer_owner,
            // حالة الدفع/رقم الاشتراك — لا يُكشَفان إلا لمالك العرض نفسه (isOwnedBy)،
            // فلا يرى مستخدم آخر أن عرضاً معيناً غير مدفوع أو رقم اشتراكه.
            // ملاحظة: $request->user() بلا تحديد الحارس (guard) يستخدم الحارس
            // الافتراضي 'web' (جلسة)، بينما توكن التطبيق يُصادَق عبر حارس 'api'
            // — فكان يرجع null دائماً حتى لصاحب العرض نفسه، فتبقى هذه الحقول
            // null دوماً ولا يظهر زر "ادفع الآن" أبداً (نفس نمط بقية هذا الملف
            // وServiceCatalogController اللذين يحدّدان 'api' صراحةً).
            'payment_status'      => $this->isOwnedBy($request->user('api'))
                ? $this->whenLoaded('latestSubscription', fn () => $this->latestSubscription?->payment_status)
                : null,
            'subscription_number' => $this->isOwnedBy($request->user('api'))
                ? $this->whenLoaded('latestSubscription', fn () => $this->latestSubscription?->subscription_number)
                : null,
            // عمود ديناميكي (addSelect) يُضاف فقط عند إرسال latitude/longitude —
            // راجع ServiceCatalogService::applyDistanceSelection(). يبقى null بدونه.
            'distance_km'   => $this->distance_km !== null ? (float) $this->distance_km : null,

            'service_type'  => $this->whenLoaded('serviceType', function () {
                return $this->serviceType ? [
                    'id'   => $this->serviceType->id,
                    'name' => $this->serviceType->name,
                ] : null;
            }),

            'categories' => $this->whenLoaded('categories', function () {
                return $this->categories->map(fn ($category) => [
                    'id'      => $category->id,
                    'name'    => $category->name,
                    'name_ar' => $category->name_ar,
                ]);
            }),

            'zones' => $this->whenLoaded('zones', function () {
                return $this->zones->map(fn ($zone) => [
                    'id'      => $zone->id,
                    'name'    => $zone->name,
                    'name_ar' => $zone->name_ar,
                ]);
            }),

            'providers' => $this->whenLoaded('serviceProviders', function () {
                return $this->serviceProviders->map(fn ($provider) => [
                    'id'        => $provider->id,
                    'name'      => $provider->name,
                    'phone'     => $provider->phone,
                    'snapchat'  => $provider->snapchat,
                    'instagram' => $provider->instagram,
                    'website'   => $provider->website,
                    'tiktok'    => $provider->tiktok,
                    'twitter'   => $provider->twitter,
                    'youtube'   => $provider->youtube,
                    'image'     => $provider->image ? $this->r2BaseUrl() . '/profile/' . $provider->image : null,
                ]);
            }),

            'created_at' => $this->created_at,
        ];
    }
}