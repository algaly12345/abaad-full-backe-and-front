<?php

namespace App\Http\Requests\Dashboard\ServiceProvider;

use Illuminate\Foundation\Http\FormRequest;

class ServiceProviderUpdateRequest extends FormRequest
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
            'name' => 'nullable|string',
            'phone' => 'required|unique:users,phone,'.$this->user->id,
            'email' => 'email|string|unique:users,email,'.$this->id,
            'identity_number' => 'nullable|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'password' =>'nullable|string',
            'address' => 'required|string',
            'zone_id' => 'required|exists:zones,id',
            'job' => 'required|string',
            'service_type' => 'required',
            'identity_type' => 'required'
        ];
    }
}
