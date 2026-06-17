<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Package\PackageStoreRequest;
use App\Http\Requests\Dashboard\Package\PackageUpdateRequest;
use App\Models\SubscriptionPackages;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubscriptionPackages::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('color', function ($row) {
                        return $row->getColor();
                    })
                    ->addColumn('action', function ($row) {
                        return view('dashboard.packages.action', compact('row'));
                    })
                   
                    ->rawColumns(['action'])
                    ->make(true);
        }
        

        return view('dashboard.packages.index');
    }
    public function create()
    {
        return view('dashboard.packages.create');
    }

    public function store(PackageStoreRequest $request)
    {
        SubscriptionPackages::create([
            'package_name' => $request->package_name,
            'price' => $request->price,
            'tergat' => $request->tergat,
            'validity' => $request->validity,
            'color' => $request->color,
            'text' => $request->text
        ]);

        toastr()->success('بنجاح', 'تم حفظ البيانات');

        return to_route('packages.index');
    }

    public function edit(SubscriptionPackages $package)
    {
        return view('dashboard.packages.edit', compact('package'));
    }

    public function update(SubscriptionPackages $package, PackageUpdateRequest $request)
    {
        $package->update([
            'package_name' => $request->package_name,
            'price' => $request->price,
            'tergat' => $request->tergat,
            'validity' => $request->validity,
            'color' => $request->color,
            'text' => $request->text
        ]);

        toastr()->success('بنجاح', 'تم تعديل البيانات');

        return to_route('packages.index');
    }
}
