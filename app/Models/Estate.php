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
        //  return $this->hasOne('App\Picture', 'id', 'user_id')->where('picture_status', 1)->where('user_status',1)->first();

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
        //  return $this->hasOne('App\Picture', 'id', 'user_id')->where('picture_status', 1)->where('user_status',1)->first();
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
}
