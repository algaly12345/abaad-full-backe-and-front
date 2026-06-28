<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetReportChartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'period' => 'nullable|string|in:day,week,month',
            'count' => 'nullable|integer|min:1|max:60',
        ];
    }

    protected function failedValidation(ValidatorContract $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'بيانات الفلترة غير صحيحة',
            'errors' => $validator->errors(),
        ], 422));
    }
}
