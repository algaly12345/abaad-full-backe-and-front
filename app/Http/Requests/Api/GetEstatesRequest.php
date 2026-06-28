<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * فلاتر شاشة "تصفح/بحث العقارات" المُحسّنة الجديدة (EstateSearchController).
 * مستقل تمامًا عن مسارات app\Helpers\EstateLogic القديمة، ولا يؤثر عليها.
 */
class GetEstatesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'nullable|integer|exists:categories,id',
            'zone_id' => 'nullable|integer|exists:zones,id',
            'city' => 'nullable|string|max:191',
            'districts' => 'nullable|string|max:191',
            'space' => 'nullable|string|max:191',
            'advertisement_type' => 'nullable|string|max:50',
            'user_id' => 'nullable|integer|exists:users,id',
            'ar_path' => 'nullable|in:0,1',
            'keyword' => 'nullable|string|max:191',

            // حدود الخريطة (Map bounds) — تُستخدم معًا أو لا تُستخدم على الإطلاق
            'north_east_lat' => 'nullable|numeric|required_with:north_east_lng,south_west_lat,south_west_lng',
            'north_east_lng' => 'nullable|numeric|required_with:north_east_lat,south_west_lat,south_west_lng',
            'south_west_lat' => 'nullable|numeric|required_with:north_east_lat,north_east_lng,south_west_lng',
            'south_west_lng' => 'nullable|numeric|required_with:north_east_lat,north_east_lng,south_west_lat',

            // فلتر "القريب مني" — lat/lng/radius_km
            'lat' => 'nullable|numeric|between:-90,90|required_with:lng',
            'lng' => 'nullable|numeric|between:-180,180|required_with:lat',
            'radius_km' => 'nullable|numeric|min:0.5|max:100',

            'sort_by' => 'nullable|string|in:latest,oldest,price_asc,price_desc,most_viewed,nearest',
            'per_page' => 'nullable|integer|min:1|max:50',
            'page' => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.exists' => 'القسم المحدد غير موجود',
            'zone_id.exists' => 'المنطقة المحددة غير موجودة',
            'user_id.exists' => 'المستخدم المحدد غير موجود',
            'lat.required_with' => 'يجب إرسال lng و lat معًا',
            'lng.required_with' => 'يجب إرسال lng و lat معًا',
        ];
    }

    protected function failedValidation(ValidatorContract $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'بيانات الفلترة غير صحيحة',
            'errors' => $validator->errors(),
        ], 422));
    }
}
