<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ServicePlan\ServicePlanStoreRequest;
use App\Http\Requests\Dashboard\ServicePlan\ServicePlanUpdateRequest;
use App\Models\ServicePlan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServicePlanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ServicePlan::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('dashboard.service-plans.action', compact('row'));
                })
                ->make(true);
        }

        return view('dashboard.service-plans.index');
    }

    public function create()
    {
        return view('dashboard.service-plans.create');
    }

    public function store(ServicePlanStoreRequest $request)
    {
        ServicePlan::create($request->validated());

        toastr()->success('بنجاح', 'تم حفظ الباقة');

        return to_route('service-plans.index');
    }

    public function edit(ServicePlan $servicePlan)
    {
        return view('dashboard.service-plans.edit', compact('servicePlan'));
    }

    public function update(ServicePlanUpdateRequest $request, ServicePlan $servicePlan)
    {
        $servicePlan->update($request->validated());

        toastr()->success('بنجاح', 'تم تعديل الباقة');

        return to_route('service-plans.index');
    }

    public function destroy(ServicePlan $servicePlan)
    {
        // منع حذف باقة مرتبطة باشتراكات فعلية حالية حتى لا تنكسر سجلات
        // الاشتراك القديمة (FK orphaning) في service_provider_subscriptions
        if ($servicePlan->providerSubscriptions()->exists()) {
            toastr()->error('لا يمكن حذف باقة مرتبطة باشتراكات حالية');

            return back();
        }

        $servicePlan->delete();

        toastr()->success('بنجاح', 'تم حذف الباقة');

        return to_route('service-plans.index');
    }
}