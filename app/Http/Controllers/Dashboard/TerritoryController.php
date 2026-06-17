<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Territory\TerritoryStoreRequest;
use App\Http\Requests\Dashboard\Territory\TerritoryUpdateRequest;
use App\Models\Territory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TerritoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Territory::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.territories.action', compact('row'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboard.territories.index');
    }

    public function store(TerritoryStoreRequest $request)
    {
        Territory::create([
            'name' => $request->name
        ]);

        toastr()->success('بنجاح', 'تم حفظ البيانات');

        return back();
    }

    public function edit(Territory $territory)
    {
        return view('dashboard.territories.edit', compact('territory'));
    }

    public function update(TerritoryUpdateRequest $request, Territory $territory)
    {
        $territory->update([
            'name' => $request->name
        ]);

        toastr()->success('بنجاح', 'تم تعديل البيانات');
        return to_route('territories.index');
    }
}
