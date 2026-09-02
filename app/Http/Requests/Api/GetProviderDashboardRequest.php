<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetProviderDashboardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'period'      => 'nullable|string|in:today,week,month,all,custom',
            'from'        => 'nullable|date|required_if:period,custom',
            'to'          => 'nullable|date|required_if:period,custom|after_or_equal:from',
            'granularity' => 'nullable|string|in:day,month',
        ];
    }

    protected function failedValidation(ValidatorContract $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => 'error',
            'message' => 'بيانات الفلترة غير صحيحة',
            'errors'  => $validator->errors(),
        ], 422));
    }
}
