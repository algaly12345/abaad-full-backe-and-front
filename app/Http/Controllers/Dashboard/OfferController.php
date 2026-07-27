<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\FileUploder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Offer\OfferStoreRequest;
use App\Http\Requests\Dashboard\Offer\OfferUpdateRequest;
use App\Models\Category;
use App\Models\Offer;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * إدارة عروض الإدارة (offer_owner = 'all'): عروض/صفقات تُنشئها الإدارة وتُرسل
 * لاحقًا لمزودي الخدمة المؤهلين (حسب نوع الخدمة والمنطقة) عبر
 * OfferOperationController::sendedOffer.
 *
 * ⚠️ هذا الملف كان يحتوي سابقًا (بالخطأ) على namespace
 * App\Http\Controllers\Dashboard\serviceProvider بنفس اسم الكلاس الموجود
 * فعليًا في app/Http/Controllers/Dashboard/serviceProvider/OfferController.php،
 * مما كان يسبب "Cannot redeclare class" عند تحميل أي route. تم استبداله بالكامل.
 */
class OfferController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Offer::where('offer_owner', 'all')
                ->with(['categories:id,name', 'serviceType:id,name'])
                ->latest()
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('service_type', function ($row) {
                    return $row->serviceType?->name ?? '-';
                })
                ->addColumn('formatted_discount', function ($row) {
                    return $row->offer_type === 'price'
                        ? number_format((float) $row->service_price, 2) . ' ريال'
                        : ($row->formatted_discount ?? '-');
                })
                ->addColumn('sent_status', function ($row) {
                    return $row->sended_at ? 'تم الإرسال' : 'لم يتم الإرسال';
                })
                ->addColumn('action', function ($row) {
                    return view('dashboard.offers.action', compact('row'));
                })
                ->make(true);
        }

        return view('dashboard.offers.index');
    }

    public function create()
    {
        $serviceTypes = ServiceType::select('id', 'name')->get();
        $categories = Category::select('id', 'name', 'name_ar')->get();

        return view('dashboard.offers.create', compact('serviceTypes', 'categories'));
    }

    public function store(OfferStoreRequest $request)
    {
        $serviceTypeId = $this->resolveServiceTypeId($request->service_type);

        $image = null;
        if ($request->hasFile('image')) {
            $image = FileUploder::uploadOneImage($request, 'offers');
        }

        $offer = Offer::create([
            'title' => $request->title,
            'description' => $request->description,
            'expiry_date' => $request->expiry_date,
            'offer_type' => $request->offer_type,
            'service_price' => $request->service_price,
            'discount' => $request->discount,
            'discount_type' => $request->discount_type,
            'service_type_id' => $serviceTypeId,
            'offer_owner' => 'all',
            'image' => $image,
            // عرض إدارة تم إنشاؤه مباشرة من الإدارة، لا يحتاج مراجعة كعروض المزودين
            'status' => 'accept',
        ]);

        $offer->categories()->attach($request->categories);

        toastr()->success('بنجاح', 'تم إنشاء العرض، يمكنك الآن إرساله لمزودي الخدمة');

        return to_route('offers.index');
    }

    public function edit(Offer $offer)
    {
        $serviceTypes = ServiceType::select('id', 'name')->get();
        $categories = Category::select('id', 'name', 'name_ar')->get();
        $offer->load('categories');

        return view('dashboard.offers.edit', compact('offer', 'serviceTypes', 'categories'));
    }

    public function update(OfferUpdateRequest $request, Offer $offer)
    {
        $image = $offer->image;
        if ($request->hasFile('image')) {
            $image = FileUploder::uploadOneImage($request, 'offers');
        }

        $offer->update([
            'title' => $request->title,
            'description' => $request->description,
            'expiry_date' => $request->expiry_date,
            'offer_type' => $request->offer_type,
            'service_price' => $request->service_price,
            'discount' => $request->discount,
            'discount_type' => $request->discount_type,
            'image' => $image,
        ]);

        $offer->categories()->sync($request->categories);

        toastr()->success('بنجاح', 'تم تعديل العرض');

        return to_route('offers.index');
    }

    /**
     * تفعيل/إلغاء تفعيل عرض من قِبل الإدارة، بصلاحية مطلقة بدون شرط ملكية
     * (الإدارة تستطيع إيقاف أي عرض، بعكس toggleStatus الخاص بمزود الخدمة نفسه
     * الموجود في Dashboard\serviceProvider\OfferController).
     */
    public function toggleStatus(Offer $offer)
    {
        $offer->status = $offer->status === 'cancelled' ? 'accept' : 'cancelled';
        $offer->save();

        toastr()->success(
            'بنجاح',
            $offer->status === 'accept' ? 'تم تفعيل العرض' : 'تم إلغاء تفعيل العرض'
        );

        return back();
    }

    private function resolveServiceTypeId($serviceType): int
    {
        $existing = ServiceType::where('id', $serviceType)->first();

        if ($existing) {
            return $existing->id;
        }

        return ServiceType::create(['name' => $serviceType])->id;
    }
}