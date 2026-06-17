<?php

namespace App\Http\Requests\Dashboard\Province;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceStoreRequest extends FormRequest
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
            'name' => 'required',
            'zone_id' => 'required|exists:zones,id'
        ];
    }
}
