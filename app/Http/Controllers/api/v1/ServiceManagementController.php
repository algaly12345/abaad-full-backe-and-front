<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreServiceRequest;
use App\Http\Requests\Api\UpdateServiceRequest;
use App\Models\Offer;
use App\Models\ServiceType;
use App\Services\ServiceCatalogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceManagementController extends Controller
{
    private const AUTH_GUARD = 'api';

    public function store(StoreServiceRequest $request): JsonResponse
    {
        $user = $request->user(self::AUTH_GUARD);

        $serviceTypeId = $this->resolveServiceTypeId($request->validated('service_type'));

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('offers', 'public');
        }

        $offer = Offer::create([
            'title'           => $request->validated('title'),
            'description'     => $request->validated('description'),
            'offer_type'       => $request->validated('offer_type'),
            'service_price'   => $request->validated('service_price'),
            'discount'        => $request->validated('discount'),
            'discount_type'   => $request->validated('discount_type'),
            'expiry_date'     => $request->validated('expiry_date'),
            'service_type_id' => $serviceTypeId,
            'offer_owner'     => $user->id,
            'phone_provider'  => $user->phone,
            'image'           => $image,
            'status'          => 'pending',
        ]);

        $offer->categories()->attach($request->validated('categories'));

        if ($request->filled('zones')) {
            $offer->zones()->attach($request->validated('zones'));
        }

        // مهم: بدون هذا الربط لن تظهر صورة/هاتف/سوشيال مزود الخدمة في الكتالوج العام
        // (الكود الموجود في ServiceOfferResource وفلتر provider_id يعتمدان على serviceProviders())
        $offer->serviceProviders()->attach($user->id, ['status' => 'accept']);

        ServiceCatalogService::flushCache();

        $offer->load(['categories', 'zones', 'serviceType']);

        return response()->json([
            'status'  => 'success',
            'message' => 'تم إنشاء الخدمة بنجاح، وهي الآن قيد مراجعة الإدارة',
            'data'    => new \App\Http\Resources\ServiceOfferResource($offer),
        ], 201);
    }

    public function update(UpdateServiceRequest $request, int $id): JsonResponse
    {
        $user = $request->user(self::AUTH_GUARD);

        $offer = Offer::find($id);

        if (!$offer) {
            return response()->json([
                'status'  => 'error',
                'message' => 'الخدمة غير موجودة',
            ], 404);
        }

        if (!$offer->isOwnedBy($user)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'غير مصرح لك بتعديل هذه الخدمة',
            ], 403);
        }

        $serviceTypeId = $this->resolveServiceTypeId($request->validated('service_type'));

        $image = $offer->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('offers', 'public');
        }

        $offer->update([
            'title'           => $request->validated('title'),
            'description'     => $request->validated('description'),
            'offer_type'      => $request->validated('offer_type'),
            'service_price'   => $request->validated('service_price'),
            'discount'        => $request->validated('discount'),
            'discount_type'   => $request->validated('discount_type'),
            'expiry_date'     => $request->validated('expiry_date'),
            'service_type_id' => $serviceTypeId,
            'image'           => $image,
        ]);

        $offer->categories()->sync($request->validated('categories'));
        $offer->zones()->sync($request->validated('zones') ?? []);

        ServiceCatalogService::flushCache();

        $offer->load(['categories', 'zones', 'serviceType']);

        return response()->json([
            'status'  => 'success',
            'message' => 'تم تعديل الخدمة بنجاح',
            'data'    => new \App\Http\Resources\ServiceOfferResource($offer),
        ], 200);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $user = $request->user(self::AUTH_GUARD);

        $offer = Offer::find($id);

        if (!$offer) {
            return response()->json([
                'status'  => 'error',
                'message' => 'الخدمة غير موجودة',
            ], 404);
        }

        if (!$offer->isOwnedBy($user)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'غير مصرح لك بحذف هذه الخدمة',
            ], 403);
        }

        $offer->categories()->detach();
        $offer->zones()->detach();
        $offer->serviceProviders()->detach();
        $offer->delete();

        ServiceCatalogService::flushCache();

        return response()->json([
            'status'  => 'success',
            'message' => 'تم حذف الخدمة بنجاح',
        ], 200);
    }

    private function resolveServiceTypeId(string $serviceTypeName): int
    {
        return ServiceType::firstOrCreate(['name' => $serviceTypeName])->id;
    }
}