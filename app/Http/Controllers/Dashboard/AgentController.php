<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\FileUploder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Agent\AgentStoreRequest;
use App\Http\Requests\Dashboard\Agent\AgentUpdateRequest;
use App\Models\Agent;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::Agents()->with('agent')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.agents.action', compact('row'));
                    })
                    ->addColumn('commercial_registerion_no', function ($row) {
                        if ($row->agent) {
                            return $row->agent->commercial_registerion_no;
                        } else {
                            return 'لايوجد';
                        }
                    })->addColumn('ideintity', function ($row) {
                        if ($row->agent) {
                            return $row->agent->identity;
                        } else {
                            return 'لايوجد';
                        }
                    })->addColumn('status', function ($row) {
                        return $row->getStatus();
                    })
                     ->addColumn('zone', function ($row) {
                         return $row->zone->name;
                     })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        // $users = User::Agents()->with('agent')->get();
        $title = 'المسوقين العقارين';
        return view('dashboard.agents.index', compact('title'));
    }

    public function create()
    {
        $zones = Zone::query()->select('id', 'name')->get();
        return view('dashboard.agents.create', compact('zones'));
    }

    public function store(AgentStoreRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'ref_code' => $request->ref_code,
                'phone' => $request->phone,
                'user_type' => 'agent',
                'zone_id' => $request->zone_id
            ]);

            $image = null;
            if ($request->has('image')) {
                $image =  FileUploder::uploadOneImage($request, 'agents');
            }

            $user->agent()->create([

                'image' => $image,
                'commercial_registerion_no' => $request->commercial_registerion_no,
                'agent_type' => $request->agent_type,
                'membership_type' => 'agent',
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'identity' => $request->ideintity
            ]);


            DB::commit();
            toastr()->success('بنجاح', 'تم حفظ البيانات');
            return to_route('agents.index');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function edit(User $user)
    {
        $zones = Zone::query()->select('id', 'name')->get();
        return view('dashboard.agents.edit', compact('user', 'zones'));
    }



    public function update(AgentUpdateRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->has('password') ? Hash::make($request->password) : $user->password,
                'ref_code' => $request->ref_code,
                'ideintity' => $request->ideintity,
                'commercial_registerion_no' => $request->commercial_registerion_no,
                'phone' => $request->phone,
                'user_type' => 'agent',
                'zone_id' => $request->zone_id
            ]);

            $image = null;
            if ($request->has('image')) {
                $image =  FileUploder::uploadOneImage($request, 'agents');
            } else {
                $image = $user->agent->image;
            }

            $user->agent()->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'identity' => $request->ideintity,
                'image' => $image,
                'commercial_registerion_no' => $request->commercial_registerion_no,
                'agent_type' => $request->agent_type,
                'membership_type' => 'agent'
            ]);
            DB::commit();
            toastr()->success('بنجاح', 'تم حفظ البيانات');
            return to_route('agents.index');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function getRealEstateOfficesAgents(Request $request)
    {
        if ($request->ajax()) {
            $data = User::RealEstateOffices()->with('agent')->get();
            
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.agents.action', compact('row'));
                    })
                    ->addColumn('commercial_registerion_no', function ($row) {
                        if ($row->agent) {
                            return $row->agent->commercial_registerion_no;
                        } else {
                            return 'لايوجد';
                        }
                    })->addColumn('ideintity', function ($row) {
                        if ($row->agent) {
                            return $row->agent->ideintity;
                        } else {
                            return 'لايوجد';
                        }
                    })->addColumn('status', function ($row) {
                        return $row->getStatus();
                    })
                    ->addColumn('zone', function ($row) {
                        return $row->zone->name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'المكاتب العقارية';

        return view('dashboard.agents.index', compact('title'));
    }

    public function getRealEstateCompaniesAgents(Request $request)
    {
        if ($request->ajax()) {
            $data = User::RealEstateCompanies()->with('agent')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.agents.action', compact('row'));
                    })
                    ->addColumn('commercial_registerion_no', function ($row) {
                        if ($row->agent) {
                            return $row->agent->commercial_registerion_no;
                        } else {
                            return 'لايوجد';
                        }
                    })->addColumn('ideintity', function ($row) {
                        if ($row->agent) {
                            return $row->agent->ideintity;
                        } else {
                            return 'لايوجد';
                        }
                    })->addColumn('status', function ($row) {
                        return $row->getStatus();
                    })
                    ->addColumn('zone', function ($row) {
                        return $row->zone->name;
                    })
                     
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'الشركات العقارية';

        return view('dashboard.agents.index', compact('title'));
    }
    public function getIndividualsAgents(Request $request)
    {
        if ($request->ajax()) {
            $data =User::Individuals()->with('agent')->get();
            
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('dashboard.agents.action', compact('row'));
                    })
                    ->addColumn('commercial_registerion_no', function ($row) {
                        if ($row->agent) {
                            return $row->agent->commercial_registerion_no;
                        } else {
                            return 'لايوجد';
                        }
                    })->addColumn('ideintity', function ($row) {
                        if ($row->agent) {
                            return $row->agent->ideintity;
                        } else {
                            return 'لايوجد';
                        }
                    })->addColumn('status', function ($row) {
                        return $row->getStatus();
                    })->addColumn('zone', function ($row) {
                        return $row->zone->name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'افراد';

        return view('dashboard.agents.index', compact('title'));
    }
}
