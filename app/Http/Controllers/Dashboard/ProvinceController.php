<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Province\ProvinceStoreRequest;
use App\Http\Requests\Dashboard\Province\ProvinceUpdateRequest;
use App\Models\Province;
use App\Models\Zone;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        $zones = Zone::query()->select('id', 'name')->get();

        
        if ($request->ajax()) {
            $data = Province::with('zone')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.provinces.action', compact('row'));
                    })
                    ->addColumn('zone_name', function ($row) {
                        return $row->zone->name;
                    })
                    ->addColumn('status', function ($row) {
                        return $row->status;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
     

        return view('dashboard.provinces.index', compact('zones'));
    }

    public function store(ProvinceStoreRequest $request)
    {
        Province::create([
            'name' => $request->name,
            'zone_id' => $request->zone_id
        ]);

        toastr()->success('بنجاح', 'تم حفظ البيانات');

        return back();
    }

    public function edit(Province $province)
    {
        $zones = Zone::query()->select('id', 'name')->get();
        return view('dashboard.provinces.edit', compact('province', 'zones'));
    }

    public function update(ProvinceUpdateRequest $request, Province $province)
    {
        $province->update([
            'name' => $request->name,
            'zone_id' => $request->zone_id
        ]);

        toastr()->success('بنجاح', 'تم تعديل البيانات');

        return to_route('provinces.index');
    }
}
