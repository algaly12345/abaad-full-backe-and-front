<?php

namespace App\Http\Requests\Dashboard\Zone;

use Illuminate\Foundation\Http\FormRequest;

class ZoneUpdateRequest extends FormRequest
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
            'territory_id' => 'required|exists:territories,id',
            'coordinates' => 'sometimes'
        ];
    }
}
