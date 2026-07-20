<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ServiceOfferResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'image'         => $this->image ? Storage::disk('public')->url($this->image) : null,
            'offer_type'    => $this->offer_type,
            'service_price' => $this->service_price !== null ? (float) $this->service_price : null,
            'discount'      => $this->discount !== null ? (float) $this->discount : null,
            'discount_type' => $this->discount_type,
            'formatted_discount' => $this->formatted_discount,
            'expiry_date'   => $this->expiry_date,
            'is_expired'    => $this->expiry_date ? $this->isExpired() : false,
            'status'        => $this->status,
            'owner_id'      => $this->offer_owner,
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
                    'image'     => $provider->image ? Storage::disk('public')->url('profile/' . $provider->image) : null,
                ]);
            }),

            'created_at' => $this->created_at,
        ];
    }
}