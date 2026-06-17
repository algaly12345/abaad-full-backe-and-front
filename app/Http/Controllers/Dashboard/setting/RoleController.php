<?php

namespace App\Http\Controllers\Dashboard\setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Setting\RoleStoreRequest;
use App\Http\Requests\Dashboard\Setting\RoleUpdateRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        
        if($request->ajax()){
            $data = Role::with('permissions')->get();

            return DataTables::of($data)
                   ->addIndexColumn()
                   ->addColumn('permissions',function($row){
                     return collect($row->permissions->pluck('name'))->implode(',');
                   })
                   ->addColumn('action',function($row){
                    return view('dashboard.settings.roles.action',compact('row'));
                   })->make(true);

        }
        
        return view('dashboard.settings.roles.index');
    }
    public function create()
    {
        $permissions = Permission::all();

        return view('dashboard.settings.roles.create', compact('permissions'));
    }

    public function store(RoleStoreRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'admin'
        ]);
        $role->syncPermissions($request->selectedPermissions);

        return to_route('roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('dashboard.settings.roles.edit', compact('role', 'permissions'));
    }

    public function update(Role $role, RoleUpdateRequest $request)
    {
        $role->update([
           'name' => $request->name
        ]);

        $role->syncPermissions($request->selectedPermissions);

        return to_route('roles.index');
    }
}
