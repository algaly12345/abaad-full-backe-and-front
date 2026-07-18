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
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',

            'service_plan_id' => 'required|exists:service_plans,id',
            'subscription_duration' => 'required|integer|in:1,3,6,12',

            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'zones' => 'required|array|min:1',
            'zones.*' => 'exists:zones,id',

            'identity_type' => 'nullable|in:individual,company',
            'identity_number' => 'nullable|required_if:identity_type,individual|string',
            'commercial_registration_no' => 'nullable|required_if:identity_type,company|string',
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
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت',
            'service_plan_id.required' => 'الباقة المطلوبة غير صالحة',
            'service_plan_id.exists' => 'الباقة المحددة غير موجودة',
            'subscription_duration.in' => 'مدة الاشتراك غير صالحة',
            'categories.required' => 'يجب اختيار نوع عقار واحد على الأقل',
            'zones.required' => 'يجب اختيار منطقة واحدة على الأقل',
        ];
    }

    /**
     * قاعدة تحقق إضافية تطابق منطق الواجهة بالجافاسكريبت:
     * عدد الأقسام المختارة لا يجب أن يتجاوز الحد المسموح في الباقة.
     * (المناطق مسموح تجاوزها مع رسوم إضافية، يُحسب في ServiceProviderService)
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $plan = \App\Models\ServicePlan::find($this->input('service_plan_id'));
            if (!$plan) {
                return;
            }

            $categoriesCount = count($this->input('categories', []));
            $allowedCategories = (int) ($plan->number_of_categories ?? 0);

            if ($allowedCategories > 0 && $categoriesCount > $allowedCategories) {
                $validator->errors()->add(
                    'categories',
                    'باقتك تسمح باختيار ' . $allowedCategories . ' نوع عقار فقط'
                );
            }
        });
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