<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateOfferStatusRequest;
use App\Models\Offer;

class AdminOfferController extends Controller
{
    /**
     * قائمة الحالات الخمس الصالحة (القيمة + التسمية العربية) — حتى تبني
     * الداشبورد الخارجية قائمة الحالات ديناميكياً بدل تثبيتها يدوياً بالفرونت.
     */
    public function statuses()
    {
        $statuses = collect(OfferStatus::LIST)->map(fn ($value) => [
            'value' => $value,
            'label' => OfferStatus::LABELS[$value],
        ])->values();

        return response()->json([
            'success' => true,
            'data' => $statuses,
        ]);
    }

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
