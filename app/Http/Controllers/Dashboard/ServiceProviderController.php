<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\FileUploder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ServiceProvider\ServiceProviderStoreRequest;
use App\Http\Requests\Dashboard\ServiceProvider\ServiceProviderUpdateRequest;
use App\Models\ServiceProvider;
use App\Models\ServiceType;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class ServiceProviderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =  User::Providers()->with('zone', 'provider')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.service-providers.action', compact('row'));
                    })
                    ->addColumn('status', function ($row) {
                        return $row->getStatus();
                    })
                    ->addColumn('zone_name', function ($row) {
                        return $row->zone->name;
                    })
                    ->addColumn('job', function ($row) {
                        return $row->provider->job;
                    })
                    ->addColumn('address', function ($row) {
                        return $row->provider->address;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    
        return view('dashboard.service-providers.index');
    }
    public function create()
    {
        $zones = Zone::query()->select('id', 'name')->get();

        $serviceTypes = ServiceType::query()->select('id', 'name')->get();
        return view('dashboard.service-providers.create', compact('zones', 'serviceTypes'));
    }

    public function store(ServiceProviderStoreRequest $request)
    {
        $check_service_type_exists = ServiceType::where('id', $request->service_type)->first();
        $serviceType = new ServiceType();
        $service_type_id = null;

        if (!isset($check_service_type_exists)) {
            $serviceType->name = $request->service_type;
            $serviceType->save();
            $service_type_id = $serviceType->id;
        } else {
            $service_type_id = $request->service_type;
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'ref_code' => $request->ref_code,
                'ideintity' => $request->ideintity,
                'license' => $request->license,
                'commercial_registerion_no' => $request->commercial_registerion_no,
                'phone' => $request->phone,
                'user_type' => 'provider',
                'zone_id' => $request->zone_id
            ]);
            $image = null;
            if ($request->has('image')) {
                $image = FileUploder::uploadOneImage($request, 'service-providers');
            }

            $user->provider()->create([
                'job' => $request->job,
                'address' => $request->address,
                'service_type_id' => $service_type_id,
                'image' => $image,
                'identity_number' => $request->identity_number,
                'identity_type' => $request->identity_type,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'commercial_registration_no' => $request->commercial_registration_no
            ]);
            DB::commit();
            toastr()->success('بنجاح', 'تم حفظ البيانات');

            return to_route('service-providers.index');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function edit(User $user)
    {
        $zones = Zone::query()->select('id', 'name')->get();
        $serviceTypes = ServiceType::query()->select('id', 'name')->get();
        return view('dashboard.service-providers.edit', compact('user', 'zones', 'serviceTypes'));
    }

  

    public function update(ServiceProviderUpdateRequest $request, User $user)
    {
        $check_service_type_exists = ServiceType::where('id', $request->service_type)->first();
        $serviceType = new ServiceType();
        $service_type_id = null;

        if (!isset($check_service_type_exists)) {
            $serviceType->name = $request->service_type;
            $serviceType->save();
            $service_type_id = $serviceType->id;
        } else {
            $service_type_id = $request->service_type;
        }
        DB::beginTransaction();

        try {
            $image = null;
            if ($request->has('image')) {
                $image = FileUploder::uploadOneImage($request, 'service-providers');
            } else {
                $image = $user->provider->image;
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>  $request->password ? Hash::make($request->password) : $user->password,
                'ref_code' => $request->ref_code,
                'ideintity' => $request->ideintity,
                'license' => $request->license,
                'commercial_registerion_no' => $request->commercial_registerion_no,
                'phone' => $request->phone,
                'user_type' => 'provider',
                'zone_id' => $request->zone_id
            ]);

            $user->provider()->update([
                'job' => $request->job,
                'address' => $request->address,
                'service_type_id' => $service_type_id,
                'image' => $image,
                'identity_number' => $request->identity_number,
                'identity_type' => $request->identity_type,
                'commercial_registration_no' => $request->commercial_registration_no,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]);
            DB::commit();
            toastr()->success('بنجاح', 'تم تعديل البيانات');
            return to_route('service-providers.index');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
