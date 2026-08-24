<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'service_type' => 'required',
            'offer_type' => 'required|in:discount,price',
            'service_price' => 'nullable|numeric|required_if:offer_type,price',
            'discount' => 'nullable|numeric|required_if:offer_type,discount',
            'description' => 'required|string',
            // عنوان تفصيلي حرّ اختياري (مثل "خميس مشيط - حي المروج") — أدق من
            // zones فقط، لا يُطلَب لأن العروض القديمة (والمزوّدين اللي ما يعرفون
            // حيّهم بالضبط) يجب أن تبقى قابلة للإنشاء بدونه.
            'address' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp',

            'subscription_duration' => 'required|integer|in:1,3,6,12',

            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'zones' => 'required|array|min:1',
            'zones.*' => 'exists:zones,id',

            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',

            // بيانات الهوية بيانات ضرورية (يُطلب من المزوّد استكمالها)، لكنها
            // لا تُحجَب بها عملية رفع إعلان الخدمة — يُسمح بإرسالها ناقصة مع
            // العرض نفسه، وتُستكمل/تُراجَع لاحقًا يدويًا (لوحة الأدمن) بدل
            // منع المستخدم من المتابعة في هذه اللحظة.
            'identity_type' => 'nullable|in:individual,company',
            'identity_number' => 'nullable|string',
            'freelance_membership_number' => 'nullable|string',
            'commercial_registration_no' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:20',
            'contact_type' => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان العرض مطلوب',
            'service_type.required' => 'نوع الخدمة مطلوب',
            'offer_type.required' => 'نوع العرض مطلوب',
            'description.required' => 'وصف الخدمة مطلوب',
            'image.required' => 'صورة العرض مطلوبة',
            'image.image' => 'الملف المرفوع يجب أن يكون صورة',
            'subscription_duration.in' => 'مدة الاشتراك غير صالحة',
            'categories.required' => 'يجب اختيار نوع عقار واحد على الأقل',
            'zones.required' => 'يجب اختيار منطقة واحدة على الأقل',
            'latitude.required' => 'يجب تحديد موقع الخدمة على الخارطة',
            'longitude.required' => 'يجب تحديد موقع الخدمة على الخارطة',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'خطأ في التحقق من البيانات المدخلة',
            'errors' => $validator->errors(),
        ], 422));
    }
}