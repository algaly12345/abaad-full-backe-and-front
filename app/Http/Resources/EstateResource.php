<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * تمثيل API نظيف لموديل Estate، يحل محل البناء اليدوي الضخم الموجود في
 * App\Helpers\EstateLogic::estate_data_formatting() — لكن فقط للمسارات
 * الجديدة التي تستخدم EstateCatalogService/EstateSearchController. المسارات
 * القديمة تستمر باستخدام EstateLogic كما هي (لا تغيير عليها) لتفادي كسر أي
 * تطبيق موبايل يعتمد على شكل الحقول القديم.
 */
class EstateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'ad_number' => $this->ad_number,
            'title' => trim(($this->category_name ?? $this->category?->name) . '-' . $this->city . '-' . $this->districts, '-'),
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'address' => $this->address,
            'city' => $this->city,
            'districts' => $this->districts,
            'space' => $this->space,
            'price' => $this->price,
            'price_negotiation' => $this->price_negotiation,
            'advertisement_type' => $this->advertisement_type,
            'status' => $this->status,
            'view' => (int) $this->view,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            // distance_km تظهر فقط عند استخدام فلتر "القريب مني" (scopeNearby)
            'distance_km' => $this->when(isset($this->distance_km), fn () => round((float) $this->distance_km, 2)),
            'images' => $this->when($this->images, fn () => json_decode($this->images)),
            'ar_path' => $this->ar_path,
            'video_url' => $this->video_url,
            'created_at' => optional($this->created_at)->toIso8601String(),
            'category' => $this->whenLoaded('category', fn () => [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'name_ar' => $this->category->name_ar,
            ]),
            'zone' => $this->whenLoaded('zone', fn () => [
                'id' => $this->zone->id,
                'name' => $this->zone->name,
                'name_ar' => $this->zone->name_ar,
            ]),
            'owner' => $this->whenLoaded('users', fn () => [
                'id' => $this->users?->id,
                'name' => $this->users?->name,
                'phone' => $this->users?->phone,
                'image' => $this->users?->image,
            ]),
        ];
    }
}
