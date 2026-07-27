<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreServicePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'                   => 'required|string|max:255',
            'description'            => 'nullable|string',
            'price'                  => 'required|numeric|min:0',
            'number_of_ads'          => 'required|integer|min:0',
            'number_of_zone'         => 'required|integer|min:0',
            'number_of_categories'   => 'required|integer|min:0',
            'start_date'             => 'nullable|date',
            'end_date'               => 'nullable|date|after_or_equal:start_date',
            'distinctive_appearance' => 'nullable|boolean',
            'interactive_reports'    => 'nullable|boolean',
            'crm'                    => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'                 => 'اسم الباقة مطلوب',
            'price.required'                => 'سعر الباقة مطلوب',
            'number_of_ads.required'        => 'عدد الإعلانات المسموح بها مطلوب',
            'number_of_zone.required'       => 'عدد المناطق المسموح بها مطلوب',
            'number_of_categories.required' => 'عدد الأقسام المسموح بها مطلوب',
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