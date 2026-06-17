<?php

namespace App\Http\Requests\Web;

use App\Traits\CalculatorTrait;
use App\Traits\RecaptchaTrait;
use App\Traits\ResponseHandler;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class CustomerProfileUpdateRequest extends FormRequest
{
    // use RecaptchaTrait;
    // use CalculatorTrait, ResponseHandler;

    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',


            'image' => 'mimes:jpg,jpeg,png,webp,gif,bmp,tif,tiff',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => translate('name_is_required'),
            'email.required' => translate('email_number_is_required'),
            'email.unique' => translate('email_number_already_has_been_taken'),

            'image.mimes' => translate('The_image_type_must_be') . '.jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff,.webp',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $numericPhoneValue = preg_replace('/[^0-9]/', '', $this['phone']);
                $numericLength = strlen($numericPhoneValue);
                if ($numericLength < 4) {
                    $validator->errors()->add(
                        'phone.min', translate('The_phone_number_must_be_at_least_4_characters')
                    );
                }

                if ($numericLength > 20) {
                    $validator->errors()->add(
                        'phone.max', translate('The_phone_number_may_not_be_greater_than_20_characters')
                    );
                }

                if ($this['password'] && !empty($this['password']) && empty($this['confirm_password'])) {
                    $validator->errors()->add(
                        'confirm_password.required', translate('confirm_password_is_required')
                    );
                } elseif ($this['confirm_password'] && !empty($this['confirm_password']) && empty($this['password'])) {
                    $validator->errors()->add(
                        'password.required', translate('password_is_required')
                    );
                } elseif ($this['password'] != $this['confirm_password']) {
                    $validator->errors()->add(
                        'password.same:confirm_password', translate('passwords_must_match_with_confirm_password')
                    );
                }

            }
        ];
    }
}
