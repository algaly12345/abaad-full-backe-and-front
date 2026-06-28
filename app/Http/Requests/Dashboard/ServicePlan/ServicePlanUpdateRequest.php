<?php

namespace App\Http\Requests\Dashboard\ServicePlan;

use Illuminate\Foundation\Http\FormRequest;

class ServicePlanUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'number_of_ads' => 'required|integer|min:0',
            'number_of_zone' => 'required|integer|min:0',
            'number_of_categories' => 'required|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'distinctive_appearance' => 'nullable|boolean',
            'interactive_reports' => 'nullable|boolean',
            'crm' => 'nullable|boolean',
        ];
    }
}