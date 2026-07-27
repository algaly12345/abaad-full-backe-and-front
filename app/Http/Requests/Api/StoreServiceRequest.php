<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'offer_type'   => 'required|in:discount,price',

            'service_price' => 'nullable|numeric|min:0|required_if:offer_type,price',

            'discount_type' => 'nullable|in:percentage,fixed|required_if:offer_type,discount',
            'discount'      => [
                'nullable',
                'numeric',
                'min:0',
                'required_if:offer_type,discount',
                function ($attribute, $value, $fail) {
                    if ($value !== null && $this->input('discount_type') === 'percentage' && $value > 100) {
                        $fail('نسبة الخصم يجب ألا تتجاوز 100%.');
                    }
                },
            ],

            'description' => 'required|string',
            'expiry_date' => 'required|date|after_or_equal:today',
            'image'       => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',

            'categories'   => 'required|array|min:1',
            'categories.*' => 'integer|exists:categories,id',
            'zones'        => 'nullable|array',
            'zones.*'      => 'integer|exists:zones,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'             => 'عنوان الخدمة مطلوب',
            'service_type.required'      => 'نوع الخدمة مطلوب',
            'offer_type.required'        => 'نوع العرض مطلوب (discount أو price)',
            'service_price.required_if'  => 'السعر مطلوب عندما يكون نوع العرض سعر مباشر',
            'discount.required_if'       => 'قيمة الخصم مطلوبة عندما يكون نوع العرض خصم',
            'discount_type.required_if'  => 'نوع الخصم (نسبة/مبلغ ثابت) مطلوب عندما يكون نوع العرض خصم',
            'description.required'       => 'وصف الخدمة مطلوب',
            'expiry_date.required'       => 'تاريخ انتهاء الخدمة مطلوب',
            'image.required'             => 'صورة الخدمة مطلوبة',
            'categories.required'        => 'يجب اختيار قسم واحد على الأقل',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => 'error',
            'message' => 'بيانات غير صحيحة',
            'errors'  => $validator->errors(),
        ], 422));
    }
}