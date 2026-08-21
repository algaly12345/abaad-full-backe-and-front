<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateOfferStatusRequest;
use App\Models\Offer;

class AdminOfferController extends Controller
{
    /**
     * تغيير حالة عرض خدمة من داشبورد الإدارة الخارجي.
     * الحفظ عبر save() (وليس تحديث مباشر بالـ query builder) حتى يُطلق
     * OfferObserver::updated() الذي يُبطل كاش الكتالوج ويُرسل إشعار Push
     * لمزوّدي الخدمة تلقائياً عند تغيّر الحالة.
     */
    public function updateStatus(UpdateOfferStatusRequest $request, Offer $offer)
    {
        $offer->status = $request->validated()['status'];
        $offer->save();

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث حالة العرض بنجاح',
            'data' => [
                'id'     => $offer->id,
                'status' => $offer->status,
                'label'  => OfferStatus::LABELS[$offer->status] ?? $offer->status,
            ],
        ]);
    }
}
