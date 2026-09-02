<?php

namespace App\Services;

use App\Models\Offer;
use App\Models\OfferView;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * يسجّل مشاهدة عرض خدمة واحدة (فتح صفحة التفاصيل) بشكل مُزال منه التكرار:
 * صف واحد لكل مُشاهِد فريد في اليوم (الفهرس الفريد في جدول offer_views).
 *
 * يُستدعى من ServiceCatalogController::show(). أي فشل هنا يُبتلع (report فقط)
 * حتى لا تنكسر استجابة تفاصيل الخدمة بسبب التتبّع.
 */
class OfferViewRecorder
{
    public function record(Offer $offer, ?User $viewer, Request $request): void
    {
        try {
            // عروض الإدارة الداخلية (broadcast) لا تخص أي مزوّد فلا معنى لتتبّعها.
            if ($offer->offer_owner === 'all') {
                return;
            }

            // لا نحتسب مشاهدة المالك لعرضه نفسه.
            if ($viewer && $offer->isOwnedBy($viewer)) {
                return;
            }

            $viewerHash = $viewer
                ? 'u:' . $viewer->id
                : hash('sha256', $request->ip() . '|' . (string) $request->userAgent());

            OfferView::query()->insertOrIgnore([
                'offer_id' => $offer->id,
                'user_id' => $viewer?->id,
                'viewer_hash' => $viewerHash,
                'viewed_date' => Carbon::now()->toDateString(),
                'created_at' => Carbon::now(),
            ]);
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
