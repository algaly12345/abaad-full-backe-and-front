<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * فلاتر شاشة "كل الخدمات داخل العقارات".
 * تدعم القيم كمصفوفة (category_id[]=1&category_id[]=2) أو نص مفصول بفواصل (category_id=1,2).
 * يُستخدم هذا الطلب في كل من index() و myServices() داخل ServiceCatalogController.
 */
class GetServicesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id'        => 'nullable|array',
            'category_id.*'      => 'integer|exists:categories,id',

            'zone_id'             => 'nullable|array',
            'zone_id.*'           => 'integer|exists:zones,id',

            'service_type_id'     => 'nullable|array',
            'service_type_id.*'   => 'integer|exists:service_types,id',

            // فلتر "مزود الخدمة": يعرض فقط الخدمات التي وافق عليها مزود/مزودو خدمة محددون
            'provider_id'         => 'nullable|array',
            'provider_id.*'       => 'integer|exists:users,id',

            'offer_type'          => 'nullable|string|in:discount,price',

            'min_price'           => 'nullable|numeric|min:0',
            'max_price'           => 'nullable|numeric|min:0|gte:min_price',

            'min_discount'        => 'nullable|numeric|min:0|max:100',
            'max_discount'        => 'nullable|numeric|min:0|max:100|gte:min_discount',

            'search'              => 'nullable|string|max:150',

            'sort_by'             => 'nullable|string|in:latest,oldest,price_asc,price_desc,discount_desc,expiry_soon',

            'only_active'         => 'nullable|boolean',

            // محجوز للتوافق مع إصدارات تطبيق قديمة، غير مستخدم فعليًا الآن:
            // مسار "خدماتي" أصبح له Route/Controller-method مستقل: GET /services/my-services
            'my_services'         => 'nullable|boolean',

            'per_page'            => 'nullable|integer|min:1|max:50',
            'page'                => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.*.exists'      => 'أحد الأقسام المحددة غير موجود',
            'zone_id.*.exists'          => 'أحد المناطق المحددة غير موجودة',
            'service_type_id.*.exists' => 'أحد أنواع الخدمات المحددة غير موجود',
            'provider_id.*.exists'      => 'أحد مزودي الخدمة المحددين غير موجود',
            'max_price.gte'             => 'أقصى سعر يجب أن يكون أكبر من أو يساوي أقل سعر',
            'max_discount.gte'          => 'أقصى نسبة خصم يجب أن تكون أكبر من أو تساوي أقل نسبة خصم',
        ];
    }

    /**
     * يحوّل category_id / zone_id / service_type_id / provider_id من نص مفصول بفواصل
     * إلى مصفوفة قبل التحقق، حتى تعمل الفلترة سواء أرسل العميل array أو CSV string.
     */
    protected function prepareForValidation(): void
    {
        foreach (['category_id', 'zone_id', 'service_type_id', 'provider_id'] as $field) {
            if ($this->has($field) && !is_array($this->input($field))) {
                $value = array_filter(explode(',', (string) $this->input($field)), fn ($v) => $v !== '');
                $this->merge([$field => array_values($value)]);
            }
        }
    }

    protected function failedValidation(ValidatorContract $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => 'error',
            'message' => 'بيانات الفلترة غير صحيحة',
            'errors'  => $validator->errors(),
        ], 422));
    }
}