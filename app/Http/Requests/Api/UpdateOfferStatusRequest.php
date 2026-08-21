<?php

namespace App\Http\Requests\Api;

use App\Enums\OfferStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateOfferStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:' . implode(',', OfferStatus::LIST)],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'حالة العرض مطلوبة',
            'status.in'        => 'حالة العرض غير صالحة',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
            'errors'  => $validator->errors(),
        ], 422));
    }
}
