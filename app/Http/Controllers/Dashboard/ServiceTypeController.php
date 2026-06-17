<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ServiceType\ServiceTypeStoreRequest;
use App\Http\Requests\Dashboard\ServiceType\ServiceTypeUpdateRequest;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ServiceTypeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ServiceType::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.service-types.action', compact('row'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('dashboard.service-types.index');
    }
   

    public function store(ServiceTypeStoreRequest $request)
    {
        ServiceType::create([
            'name' => $request->name
        ]);

        toastr()->success('بنجاح', 'تم حفظ البيانات');
        return back();
    }


    public function edit(ServiceType $serviceType)
    {
        return view('dashboard.service-types.edit', compact('serviceType'));
    }

    public function update(ServiceType $serviceType, ServiceTypeUpdateRequest $request)
    {
        $serviceType->update([
            'name' => $request->name
        ]);

        toastr()->success('بنجاح', 'تم تعديل البيانات');

        return to_route('service-types.index');
    }
}
