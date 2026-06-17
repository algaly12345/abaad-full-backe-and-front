<?php

namespace App\Http\Requests\Dashboard\Package;

use Illuminate\Foundation\Http\FormRequest;

class PackageStoreRequest extends FormRequest
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
             'package_name' => 'required|string',
             'price' => 'required|numeric',
             'tergat' => 'required|string',
             'validity' => 'required|numeric',
             'color' => 'required|string',
             'text' => 'required'
        ];
    }
}
