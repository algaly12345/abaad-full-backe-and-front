<?php

namespace App\Http\Requests\Dashboard\Agent;

use Illuminate\Foundation\Http\FormRequest;

class AgentStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|string|unique:users,email',
            'password' => 'required|string',
            'ref_code' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'zone_id' => 'required|exists:zones,id',
            'agent_type' => 'required',
        ];
    }

    // [
    //     'name',
    //     'email',
    //     'phone',
    //     'password',
    //     'ref_code',
    //     'is_active',
    //     'user_type',
    //     'is_phone_verified_at',
    //     'cm_firebase_token'
    // ]
}
