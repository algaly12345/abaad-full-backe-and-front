<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Category;
use App\Models\Estate;
use App\Models\Offer;
use App\Models\ServicePlan;
use App\Models\ServiceProviderSubscription;
use App\Models\ServiceType;
use App\Models\Zone;
use App\Shop;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Helpers\FileUploder;
class OfferWizardController extends Controller
{
    public function stepOne()
    {
        $categories   = Category::all();
        $zones        = Zone::all();
        $servicePlans = ServicePlan::all();

        return view('website.offers.step-one', compact(
            'categories',
            'zones',
            'servicePlans'
        ));
    }

    public function stepOneStore(Request $request)
    {
        $request->validate([
            'categories' => 'required|array|min:1',
            'zones' => 'required|array|min:1',
            'service_plan_id' => 'required|exists:service_plans,id',
            'subscription_duration' => 'required|integer|in:1,3,6,12',
            'package_price' => 'required|numeric|min:0',
            'expiry_date' => 'required|date',
            'number_of_ads' => 'required|integer|min:0',
            'number_of_categories' => 'required|integer|min:0',
            'number_of_zone' => 'required|integer|min:0',
        ], [
            'categories.required' => 'يرجى اختيار نوع عقار واحد على الأقل',
            'zones.required' => 'يرجى اختيار منطقة واحدة على الأقل',
            'service_plan_id.required' => 'يرجى اختيار باقة',
        ]);

        $selectedCategoryIds = [];
        $selectedCategoryNames = [];
        $selectedZoneIds = [];
        $selectedZoneNames = [];

        if ($request->filled('selected_category_ids')) {
            $selectedCategoryIds = json_decode($request->selected_category_ids, true) ?? [];
        } else {
            $selectedCategoryIds = $request->categories ?? [];
        }

        if ($request->filled('selected_category_names')) {
            $selectedCategoryNames = json_decode($request->selected_category_names, true) ?? [];
        }

        if ($request->filled('selected_zone_ids')) {
            $selectedZoneIds = json_decode($request->selected_zone_ids, true) ?? [];
        } else {
            $selectedZoneIds = $request->zones ?? [];
        }

        if ($request->filled('selected_zone_names')) {
            $selectedZoneNames = json_decode($request->selected_zone_names, true) ?? [];
        }

        Session::put('offer_step_one', [
            'categories' => $request->categories,
            'zones' => $request->zones,

            'selected_category_ids' => $selectedCategoryIds,
            'selected_category_names' => $selectedCategoryNames,

            'selected_zone_ids' => $selectedZoneIds,
            'selected_zone_names' => $selectedZoneNames,

            'service_plan_id' => $request->service_plan_id,
            'subscription_duration' => $request->subscription_duration,
            'package_price' => $request->package_price,
            'expiry_date' => $request->expiry_date,
            'number_of_ads' => $request->number_of_ads,
            'number_of_categories' => $request->number_of_categories,
            'number_of_zone' => $request->number_of_zone,
        ]);

        return redirect()->route('website.offers.step-two');
    }

    public function stepTwo()
    {
        if (!Session::has('offer_step_one')) {
            return redirect()->route('website.offers.step-one')
                ->with('error', 'ابدأ أولًا من الصفحة الأولى');
        }

        $serviceTypes = ServiceType::all();
        $stepOne = Session::get('offer_step_one');

        return view('website.offers.step-two', compact('serviceTypes', 'stepOne'));
    }

    public function stepTwoStore(Request $request)
    {
        if (!Session::has('offer_step_one')) {
            return redirect()->route('website.offers.step-one')
                ->with('error', 'انتهت الجلسة، يرجى البدء من جديد');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'service_type' => 'required',
            'offer_type' => 'required|in:discount,price',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
            'service_price' => 'nullable|numeric|min:0|required_if:offer_type,price',
            'discount_type' => 'nullable|in:percentage,fixed|required_if:offer_type,discount',
            'discount' => ['nullable', 'numeric', 'min:0', 'required_if:offer_type,discount', function ($attribute, $value, $fail) use ($request) {
                if ($value !== null && $request->discount_type === 'percentage' && (float) $value > 100) {
                    $fail('نسبة الخصم يجب ألا تتجاوز 100%.');
                }
            }],
        ], [
            'title.required' => 'اسم الخدمة أو عنوان العرض مطلوب',
            'service_type.required' => 'يرجى اختيار نوع الخدمة',
            'offer_type.required' => 'يرجى اختيار نوع العرض',
            'description.required' => 'الوصف مطلوب',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('temp/offers', 'public');
        }

        Session::put('offer_step_two', [
            'title' => $request->title,
            'service_type' => $request->service_type,
            'offer_type' => $request->offer_type,
            'service_price' => $request->service_price,
            'discount' => $request->discount,
            'discount_type' => $request->discount_type,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('website.offers.step-three');
    }

    public function stepThree()
    {
        if (!Session::has('offer_step_one') || !Session::has('offer_step_two')) {
            return redirect()->route('website.offers.step-one')
                ->with('error', 'يرجى إكمال الخطوات السابقة أولاً');
        }

        $stepOne = Session::get('offer_step_one');
        $stepTwo = Session::get('offer_step_two');

        return view('website.offers.step-three', compact('stepOne', 'stepTwo'));
    }

    public function stepThreeStore(Request $request)
    {
        if (!Session::has('offer_step_one') || !Session::has('offer_step_two')) {
            return redirect()->route('website.offers.step-one')
                ->with('error', 'انتهت الجلسة، يرجى البدء من جديد');
        }

        $request->validate([
            'provider_name' => 'required|string|max:255',
            'provider_email' => 'required|email|max:255',
            'provider_phone' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20',
            'provider_company' => 'nullable|string|max:255',
            'provider_commercial_name' => 'nullable|string|max:255',
            'terms_accepted' => 'required|accepted',
        ], [
            'provider_name.required' => 'الاسم الرسمي مطلوب',
            'provider_email.required' => 'البريد الإلكتروني مطلوب',
            'provider_email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'provider_phone.required' => 'رقم الجوال مطلوب',
            'provider_phone.regex' => 'يرجى إدخال رقم جوال صحيح',
            'terms_accepted.required' => 'يجب الموافقة على الشروط والأحكام',
            'terms_accepted.accepted' => 'يجب الموافقة على الشروط والأحكام',
        ]);

        $stepOne = Session::get('offer_step_one');
        $stepTwo = Session::get('offer_step_two');

        $finalData = array_merge($stepOne, $stepTwo, [
            'provider_name' => $request->provider_name,
            'provider_email' => $request->provider_email,
            'provider_phone' => $request->provider_phone,
            'provider_company' => $request->provider_company,
            'provider_commercial_name' => $request->provider_commercial_name,
            'terms_accepted' => $request->terms_accepted,
        ]);

        Session::put('offer_wizard', $finalData);

        return redirect()->route('website.offers.preview');
    }

    public function preview()
    {
        $data = Session::get('offer_wizard');

        if (!$data) {
            return redirect()->route('website.offers.step-one')
                ->with('error', 'لا توجد بيانات محفوظة');
        }

        return view('website.offers.preview', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'service_type' => 'required',
            'offer_type' => 'required|in:discount,price',
            'service_price' => 'nullable|numeric|min:0|required_if:offer_type,price',
            'discount_type' => 'nullable|in:percentage,fixed|required_if:offer_type,discount',
            'discount' => ['nullable', 'numeric', 'min:0', 'required_if:offer_type,discount', function ($attribute, $value, $fail) use ($request) {
                if ($value !== null && $request->discount_type === 'percentage' && (float) $value > 100) {
                    $fail('نسبة الخصم يجب ألا تتجاوز 100%.');
                }
            }],
            'expiry_date' => 'required',
            'description' => 'required',
            'categories' => 'required',
            'zones' => 'required',
            'image' => 'required'
        ]);

        $check_service_type_exists = ServiceType::where('id', $request->service_type)->first();
        $service_type_id = null;

        if (!isset($check_service_type_exists)) {
            $serviceType = ServiceType::create(['name' => $request->service_type]);
            $service_type_id = $serviceType->id;
        } else {
            $service_type_id = $request->service_type;
        }

        $image = null;

        if ($request->hasFile('image')) {
            $image = FileUploder::uploadOneImage($request, 'offers');
        } elseif ($request->filled('image') && is_string($request->image)) {
            $tempPath = $request->image;

            if (str_contains($tempPath, 'temp/')) {
                $newPath = str_replace('temp/', '', $tempPath);

                if (Storage::disk('public')->exists($tempPath)) {
                    Storage::disk('public')->move($tempPath, $newPath);
                    $image = $newPath;
                } else {
                    $image = $tempPath;
                }
            } else {
                $image = $tempPath;
            }
        }

        $rawPhone = $request->provider_phone;

        $cleanPhone = preg_replace('/[^0-9]/', '', $rawPhone);

        if (str_starts_with($cleanPhone, '966')) {
            $finalPhone = '+' . $cleanPhone;
        } elseif (str_starts_with($cleanPhone, '0')) {
            $finalPhone = '+966' . substr($cleanPhone, 1);
        } else {
            $finalPhone = '+966' . $cleanPhone;
        }

        $user = User::where('phone', $finalPhone)->first();

        if (!$user) {
            $user = User::create([
                'name' => $request->provider_name,
                'email' => $request->provider_email,
                'phone' => $finalPhone,
                'is_active' => 1,
                'password' => bcrypt("1234567"),
                'zone_id' => "3",
                'user_type' => 'provider',
                'membership_type' => "3434",
            ]);

            $user->provider()->create([
                'job' => 'مزود خدمة',
                'address' => $request->provider_company ?? 'غير محدد',
                'service_type_id' => $service_type_id,
                'image' => 'def.png',
                'identity_number' => 'pending',
                'identity_type' => 'national_id',
                'latitude' => '0',
                'longitude' => '0',
                'commercial_registration_no' => $request->provider_commercial_name ?? 'pending'
            ]);
        }

        $userId = $user->id;

        $offer = Offer::create([
            'title' => $request->title,
            'expiry_date' => $request->expiry_date,
            'service_price' => $request->service_price,
            'description' => $request->description,
            'discount' => $request->discount,
            'discount_type' => $request->discount_type,
            'offer_type' => $request->offer_type,
            'service_type_id' => $service_type_id,
            'offer_owner' => 'me',
            'image' => $image,
            'phone_provider' => $finalPhone
        ]);

        $offer->serviceProviders()->attach($userId);

        $offer->categories()->attach($request->categories);
        $offer->zones()->attach($request->zones);
        $offer->updateOfferStatusToSended();

        $subscription_number = 'SUB-' . strtoupper(uniqid());

        ServiceProviderSubscription::create([
            'user_id' => $userId,
            'service_plan_id' => $request->service_plan_id,
            'duration' => $request->subscription_duration,
            'expiry_date' => $request->expiry_date,
            'subscription_status' => 'pending',
            'payment_status' => 'unpaid',
            'price' => $request->package_price,
            'offer_id' => $offer->id,
            'subscription_number' => $subscription_number,
            'created_at' => now(),
            'updated_at' => now(),
            'number_of_ads' => $request->number_of_ads,
            'number_of_zone' => $request->number_of_zone,
            'number_of_categories' => $request->number_of_categories,
        ]);

        Session::forget(['offer_step_one', 'offer_step_two', 'offer_wizard']);
        Session::put('package_price', $request->package_price);

        auth()->guard('user')->login($user);

        toastr()->success('تم حفظ البيانات بنجاح', 'نجاح');

        return redirect()->route('service-provider.estaes.payment', [
            'offer_id' => $offer->id,
            'price' => $request->package_price,
            'subscription_number' => $subscription_number
        ]);
    }
}