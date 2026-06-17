<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\Zone;
use App\Notifications\OfferNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\DataTables;

class OfferOperationController extends Controller
{
    public function sendOfferPage(Offer $offer)
    {
        $zones = Zone::query()->select('id', 'name')->get();
        return view('dashboard.offers.send-offer', compact('offer', 'zones'));
    }

    public function sendedOffer(Request $request, Offer $offer)
    {
        $request->validate([
            'zone_id' => 'required|exists:zones,id'
        ]);

        DB::beginTransaction();
        try {
            $query = User::query();

            $query->where('zone_id', $request->zone_id);
            $query->whereHas('provider', function ($q) use ($offer) {
                $q->where('service_type_id', $offer->service_type_id);
            });
            // $query->where('service_type_id', $offer->service_type_id);
            $users = $query->get();

          

            $offer->serviceProviders()->attach($users->pluck('id'));
            $offer->updateOfferStatusToSended();

            Notification::send($users, new OfferNotification($offer));
            DB::commit();
            toastr()->success('بنجاح', 'تم أرسال العرض');
            return to_route('offers.index');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function getOffersSent(Request $request)
    {
        if ($request->ajax()) {
            $data = Offer::sent()->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.offers.action', compact('row'));
                    })
                    ->addColumn('offer_status', function ($row) {
                        return $row->isSended();
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('dashboard.offers.offers-sent');
    }
}
