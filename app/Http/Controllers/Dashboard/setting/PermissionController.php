<?php

namespace App\Http\Controllers\Dashboard\setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Setting\PermissionStoreRequest;
use App\Http\Requests\Dashboard\Setting\PermissionUpdateRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        
        
        if($request->ajax()){
            
            $data = Permission::all();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                return view('dashboard.settings.permissions.action',compact('row'));
            })->make(true);
        }

        return view('dashboard.settings.permissions.index');
    }

    public function store(PermissionStoreRequest $request)
    {
        Permission::create(['name' => $request->name,'guard_name' => 'admin']);

        return back();
    }

    public function edit(Permission $permission)
    {
        return view('dashboard.settings.permissions.edit', compact('permission'));
    }

    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        $permission->update([
            'name' => $request->name
        ]);

        return to_route('permissions.index');
    }
}
