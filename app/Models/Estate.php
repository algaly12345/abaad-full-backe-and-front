<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    use HasFactory;


    protected $casts = [
        'id' => 'integer',
        'short_description' => 'string',
        'long_description' => 'string',
        'city'=>'string',

        'address' => 'string',
        'property' => 'string',
        'category_id'=>'integer',
        'price'=>'string',
        'status'=>'string',
        'view'=>'int',
        'zone_id'=>'integer',
        'ownership_type'=>'string',
        'space'=>'string',
        'districts'=>'string',
        'network_type'=>'string',
        'service_offers'=>'string',
        'qr'=>'string',
        'ar_path'=>'string',
        'latitude'=>'string',
        'longitude'=>'string',
        'vendor_id'=>'integer',
        'territory_id'=>'integer',
        'age_estate'=>'string',
        'floors'=>'integer',

        'advertiser_no'=>'integer',
        'user_id'=>'integer',
        'ad_number'=>'integer',
        'price_negotiation'=>'string',
        'other_advantages'=>'string',
        'interface'=>'string',
        'street_space'=>'string',
        'build_space'=>'string',
        'estate_id'=>'integer',
        'video_url'=>'string',
        "estate_type"=>'string',
        'authorization_number'=>'string',
        'document_number'=>'string',
        'ad_license_number'=>'string',
        
        
        "total_price"=>'string',

        "category_name"=>'string',

        "creation_date"=>'string',
        'end_date'=>'string',
         'identityـorـunified'=>'string',
        'adLicense_number'=>'string',
        'brokerageAndMarketingLicenseNumber'=>'string',
         'titleDeedTypeName'=>'string',
          
          
         'postal_code'=>'string',
         'plan_number'=>'string',
         
         
         'obligationsOnTheProperty'=>'string',
         'guaranteesAndTheirDuration'=>'string',
         'locationDescriptionOnMOJDeed'=>'string',
         'numberOfRooms'=>'string',
         'mainLandUseTypeName'=>'string',
           'landNumber'=>'string',
           
          'adLicenseUrl'=>'string',
          
          
          
          'advertiserName'=>'string',
           'phoneNumber'=>'string',
           
          'isValid'=>'string',
        
    ];
    
    
    
    protected $fillable = [
        'images', // Add 'images' to the fillable attributes
        'planned',
          'deed_number',
    'creation_date',
    'titleDeedTypeName',
    'end_date',
    'property_type',
    'total_price',
     'propertyUtilities',
    ];
    
    
      public function user()
    {
        return $this->hasOne(User::class,'user_id','id');
    }
    public function serviceOffer()
    {
        return $this->hasOne(ServiceOffer::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

  

    public function images()
    {
        return $this -> hasMany(EstateImage::class, 'estate_id', 'id');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class)->where('status', '=', 'accept');
    }

    function service_offers(){
        return $this->belongsToMany(Offer::class);
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id')->select(array('id','name', 'email','membership_type','advertiser_no','phone','image'));
    }
    
    
    public function userad()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function zones()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
    public function scopeSearchResults($query)
    {
        return $query->where('status', 'active')
            ->when(request()->filled('search'), function($query) {
                $query->where(function($query) {
                    $search = request()->input('search');
                    $query->where('short_description', 'LIKE', "%$search%")
                        ->orWhere('national_address', 'LIKE', "%$search%")
                        ->orWhere('address', 'LIKE', "%$search%");
                });
            })
            ->when(request()->filled('category'), function($query) {
                $query->whereHas('categories', function($query) {
                    $query->where('id', request()->input('category'));
                });
            });
    }
    
    
    public function agent()
{
    return $this->hasOne(Agent::class, 'user_id', 'user_id');
}

    /*
    |--------------------------------------------------------------------------
    | Scopes جديدة لتحسين الأداء والفلترة والبحث (Performance / Filtering /
    | Search) — تُستخدم حصريًا من App\Services\EstateCatalogService والمسارات
    | الجديدة (EstateSearchController). لا تؤثر على أي كود قديم، ولا يستخدمها
    | أي كنترولر قديم حاليًا.
    |--------------------------------------------------------------------------
    | كل scope هنا "آمن للاستدعاء غير المشروط": إن مُرِّرت له قيمة فاضية/null
    | فهو لا يضيف أي شرط WHERE (عبر when() الداخلي)، فيمكن استدعاء كل الفلاتر
    | تباعًا في بناء استعلام واحد دون أي شروط if/else خارجية متكررة.
    */

    public function scopeFilterByCategory($query, $categoryId)
    {
        return $query->when($categoryId, fn ($q) => $q->where('category_id', $categoryId));
    }

    public function scopeFilterByZone($query, $zoneId)
    {
        return $query->when($zoneId, fn ($q) => $q->where('zone_id', $zoneId));
    }

    public function scopeFilterByCity($query, $city)
    {
        return $query->when($city, fn ($q) => $q->where('city', $city));
    }

    /**
     * فلتر الحي، بنفس منطق التطبيع الموجود تاريخيًا في
     * App\Helpers\EstateLogic::get_estate(): إزالة كلمة "حي" من النص المُدخل
     * والمقارنة بكلا الشكلين، لأن المستخدمين يكتبون أحيانًا "حي النرجس"
     * وأحيانًا "النرجس" فقط للإشارة لنفس الحي.
     */
    public function scopeFilterByDistrict($query, $district)
    {
        return $query->when($district, function ($q) use ($district) {
            $normalized = trim(str_replace('حي', '', $district));

            $q->where(function ($sub) use ($district, $normalized) {
                $sub->where('districts', 'LIKE', "%{$district}%")
                    ->orWhere('districts', 'LIKE', "%{$normalized}%");
            });
        });
    }

    public function scopeFilterBySpace($query, $space)
    {
        return $query->when($space, fn ($q) => $q->where('space', $space));
    }

    public function scopeFilterByAdvertisementType($query, $type)
    {
        return $query->when($type && $type !== 'all', fn ($q) => $q->where('advertisement_type', $type));
    }

    public function scopeFilterByUser($query, $userId)
    {
        return $query->when($userId, fn ($q) => $q->where('user_id', $userId));
    }

    public function scopeOnlyWithArView($query, $flag = null)
    {
        return $query->when($flag, fn ($q) => $q->whereNotNull('ar_path')->where('ar_path', '!=', ''));
    }

    /**
     * فلترة العقارات الواقعة ضمن حدود مستطيل خريطة (شمال شرق / جنوب غرب)،
     * تُستخدم عند تحريك/تصغير/تكبير الخريطة في تطبيق الموبايل لجلب العقارات
     * الظاهرة في إطار العرض الحالي فقط.
     */
    public function scopeWithinMapBounds($query, $neLat, $neLng, $swLat, $swLng)
    {
        if (empty($neLat) || empty($neLng) || empty($swLat) || empty($swLng)) {
            return $query;
        }

        return $query->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereBetween('latitude', [(float) $swLat, (float) $neLat])
            ->whereBetween('longitude', [(float) $swLng, (float) $neLng]);
    }

    /**
     * فلتر "العقارات القريبة" باستخدام صيغة Haversine لحساب المسافة بالكيلومتر
     * مباشرة داخل الاستعلام (SQL)، أسرع بكثير من جلب كل الصفوف وحساب المسافة
     * لكل واحدة منها بحلقة PHP كما كانت بعض المسارات القديمة تفعل ضمنيًا.
     * يُرجع عمودًا إضافيًا distance_km على كل صف، ويُرتّب تلقائيًا من الأقرب.
     */
    public function scopeNearby($query, $lat, $lng, $radiusKm = 10)
    {
        if (empty($lat) || empty($lng)) {
            return $query;
        }

        $haversine = '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))))';

        return $query->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->selectRaw("estates.*, {$haversine} as distance_km", [$lat, $lng, $lat])
            ->whereRaw("{$haversine} <= ?", [$lat, $lng, $lat, $radiusKm])
            ->orderBy('distance_km');
    }

    /**
     * نفس شرط صلاحية الإعلان المستخدم تاريخيًا في EstateLogic
     * (end_date نص بصيغة d/m/Y يُحوَّل بـ STR_TO_DATE)، مع فرق سلوك مقصود
     * ومُوثَّق: العقارات التي لم يُحدَّد لها end_date أصلًا (NULL أو فاضي)
     * تبقى ظاهرة هنا، بعكس الشرط القديم STR_TO_DATE(NULL, '%d/%m/%Y') الذي
     * يُقيَّم دائمًا إلى NULL في SQL (أي false ضمنيًا)، فيُخفي هذه العقارات
     * بالكامل من النتائج بصمت — وهي عادةً العقارات الأقدم التي أُضيفت قبل
     * ربط نظام الباقات/التراخيص بتاريخ انتهاء صريح. إن كان مطلوبًا تطابق تام
     * مع السلوك القديم (إخفاء هذه العقارات أيضًا)، يكفي حذف شرطي
     * whereNull/where('end_date','') أدناه.
     */
    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('end_date')
                ->orWhere('end_date', '')
                ->orWhereRaw("STR_TO_DATE(end_date, '%d/%m/%Y') >= CURDATE()");
        });
    }

    public function scopeSearchKeyword($query, $term)
    {
        return $query->when($term, function ($q) use ($term) {
            $q->where(function ($sub) use ($term) {
                $sub->where('short_description', 'LIKE', "%{$term}%")
                    ->orWhere('national_address', 'LIKE', "%{$term}%")
                    ->orWhere('address', 'LIKE', "%{$term}%")
                    ->orWhere('city', 'LIKE', "%{$term}%")
                    ->orWhere('category_name', 'LIKE', "%{$term}%");
            });
        });
    }
}
