<?php

namespace App\Http\Requests\Dashboard\Agent;

use Illuminate\Foundation\Http\FormRequest;

class AgentUpdateRequest extends FormRequest
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
            'email' => 'email|string|unique:users,email,'.$this->user->id,
            'password' => 'nullable|string',
            'ref_code' => 'nullable|string',
            'ideintity' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'commercial_registerion_no' => 'required',
            'zone_id' => 'required|exists:zones,id',
            'agent_type' => 'required'
        ];
    }
}
