<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Zone\ZoneStoreRequest;
use App\Http\Requests\Dashboard\Zone\ZoneUpdateRequest;
use App\Models\Territory;
use App\Models\Zone;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ZoneController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Zone::with('territory')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.zones.action', compact('row'));
                    })
                    ->addColumn('territory', function ($row) {
                        return $row->territory?->name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
       
        

        // dd($zones->count());

       
   
        return view('dashboard.zones.index');
    }

    public function create()
    {
        $territories = Territory::query()->select('id', 'name')->get();

        return view('dashboard.zones.create', compact('territories'));
    }

    public function store(ZoneStoreRequest $request)
    {
        // Zone::create([
        //     'name' => $request->name,
        //     'territory_id' => $request->territory_id,
        //     'coordinates' => $request->coordinates
        // ]);

        $value = $request->coordinates;

        foreach (explode('),(', trim($value, '()')) as $index=>$single_array) {
            if ($index == 0) {
                $lastcord = explode(',', $single_array);
            }
            $coords = explode(',', $single_array);
            $polygon[] = new Point($coords[0], $coords[1]);
        }
 
        $polygon[] = new Point($lastcord[0], $lastcord[1]);
        $zone = new Zone();
        $zone->name = $request->name;
        $zone->territory_id = $request->territory_id;
       
        $zone->coordinates = new Polygon([new LineString($polygon)]);
        $zone->save();

        // dd($zone);
       
        toastr()->success('بنجاح', 'تم حفظ البيانات');
        return to_route('zones.index');
    }


    public function edit(Zone $zone)
    {
        $territories = Territory::query()->select('id', 'name')->get();
        return view('dashboard.zones.edit', compact('zone', 'territories'));
    }

    public function update(ZoneUpdateRequest $request, Zone $zone)
    {
        if (!$request->has('coordinates')) {
            $value = $request->coordinates;

            foreach (explode('),(', trim($value, '()')) as $index=>$single_array) {
                if ($index == 0) {
                    $lastcord = explode(',', $single_array);
                }
                $coords = explode(',', $single_array);
                $polygon[] = new Point($coords[0], $coords[1]);
            }
    
            $polygon[] = new Point($lastcord[0], $lastcord[1]);
            $zone->coordinates = new Polygon([new LineString($polygon)]);
        }
 
        $zone->name = $request->name;
        $zone->territory_id = $request->territory_id;
        $zone->save();
        toastr()->success('بنجاح', 'تم تعديل البيانات');
        return to_route('zones.index');
    }


    public function getCoordinates($id)
    {
        $zone=Zone::selectRaw("*,ST_AsText(ST_Centroid(`coordinates`)) as center")->findOrFail($id);
        // dd($zone->coordinates[0][0]);
        $data = Helpers::format_coordiantes($zone->coordinates[0]);
        $center = (object)['lat'=>(float)trim(explode(' ', $zone->center)[1], 'POINT()'), 'lng'=>(float)trim(explode(' ', $zone->center)[0], 'POINT()')];
        return response()->json(['coordinates'=>$data, 'center'=>$center]);
    }
}
