<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceOfferResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'image'         => $this->image ? asset('storage/app/public/' . $this->image) : null,
            'offer_type'    => $this->offer_type,
            'service_price' => $this->service_price !== null ? (float) $this->service_price : null,
            'discount'      => $this->discount !== null ? (float) $this->discount : null,
            'expiry_date'   => $this->expiry_date,
            'is_expired'    => $this->expiry_date ? $this->isExpired() : false,
            'status'        => $this->status,
            // معرّف مقدّم الخدمة الذي أنشأ العرض — يُستخدم في الفرونت لمقارنة الملكية
            // (مثل إظهار مفتاح تفعيل/إيقاف داخل لوحة "خدماتي")
            'owner_id'      => $this->offer_owner,

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

            // مزودو الخدمة الذين وافقوا فعليًا على هذا العرض (status = accept على الـpivot)
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
                    'image'     => $provider->image ? asset('storage/app/public/profile/' . $provider->image) : null,
                ]);
            }),

            'created_at' => $this->created_at,
        ];
    }
}