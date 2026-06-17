<?php

namespace App\Http\Requests\Dashboard\Offer;

use Illuminate\Foundation\Http\FormRequest;

class OfferStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'service_type' => 'required',
            'service_price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'expiry_date' => 'required|date',
            'description' => 'required',
            'categories' => 'required'
        ];
    }
}
