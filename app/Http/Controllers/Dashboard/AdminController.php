<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\AdminStoreRequest;
use App\Http\Requests\Dashboard\Admin\AdminUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
       

         if($request->ajax()){
            $data =  Admin::all();

            return DataTables::of($data)->addIndexColumn()
             ->addColumn('action',function($row){
                return view('dashboard.admins.action',compact('row'));
             })->make(true);
         }

        return view('dashboard.admins.index');
    }

    public function create()
    {
        $roles = Role::all();

        return view('dashboard.admins.create', compact('roles'));
    }

    public function store(AdminStoreRequest $request)
    {
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ]);

        $admin->syncRoles($request->selectedRoles);
        toastr()->success('بنجاح', 'تم حفظ البيانات');
        return to_route('admins.index');
    }


    public function edit(Admin $admin)
    {
        $roles = Role::all();

        return view('dashboard.admins.edit', compact('admin', 'roles'));
    }


    public function update(AdminUpdateRequest $request, Admin $admin)
    {
        $admin->update([
         'name' => $request->name,
         'phone' => $request->phone,
         'password' => $request->password ? Hash::make($request->password) : $admin->password,
         'email' => $request->email
        ]);

        $admin->syncRoles($request->selectedRoles);

        toastr()->success('بنجاح', 'تم تعديل البيانات');

        return to_route('admins.index');
    }
}
