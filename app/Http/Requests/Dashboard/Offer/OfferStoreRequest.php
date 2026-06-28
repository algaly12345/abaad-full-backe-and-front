<?php

namespace App\Http\Requests\Dashboard\Offer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class OfferStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'service_type' => 'required',
            'offer_type' => 'required|in:discount,price',
            'service_price' => 'nullable|numeric|min:0|required_if:offer_type,price',
            'discount_type' => 'nullable|in:percentage,fixed|required_if:offer_type,discount',
            'discount' => 'nullable|numeric|min:0|required_if:offer_type,discount',
            'expiry_date' => 'required|date',
            'description' => 'required',
            'categories' => 'required',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            if (
                $this->discount_type === 'percentage'
                && $this->discount !== null
                && (float) $this->discount > 100
            ) {
                $validator->errors()->add('discount', 'نسبة الخصم يجب ألا تتجاوز 100%.');
            }
        });
    }
}