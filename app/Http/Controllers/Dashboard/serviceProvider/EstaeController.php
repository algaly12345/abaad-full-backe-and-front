<?php

namespace App\Http\Controllers\Dashboard\serviceProvider;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Estate;
use App\Models\Offer;
use App\Models\ServiceType;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstaeController extends Controller
{
    public function index(Request $request)
    {
        $query = Estate::query();
        if ($request->has('zone_id') && $request->filled('zone_id') && $request->input('zone_id') != null) {
            $query->where('zone_id', $request->zone_id);
            
        }

        $query->with('images');
        $zones = Zone::all();
        $estaes = $query->get();

        return view('service-provider.estaes.index', compact('estaes', 'zones'));
    }

    

}
