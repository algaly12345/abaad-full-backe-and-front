@extends('layouts.front-end.app')

@section('title', translate('Add Real Estate'))


<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>



@section('content')
    <div class="container py-2 py-md-4 p-0 p-md-2 user-profile-container px-5px">
        <div class="row">
            @include('web-views.partials._profile-aside')

            <section class="col-lg-9 __customer-profile px-0">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                            <h5 class="font-bold m-0 fs-16">{{translate('Add a real estate offer')}}</h5>
                        </div>





                        <!-- Step 1 -->
                        <div id="step-1" class="step">
                            <!-- Filter Buttons -->
                        
                            {{-- <h5 class="mx-3">{{ translate('Step 1: Choose a Category') }}</h5> --}}
                        
                            <!-- رسالة التأكيد -->
                            <div class="alert alert-success text-center mx-3 mt-4" role="alert">
                                تم جلب البيانات من الهيئة بنجاح. اضغط على "التالي" لمواصلة إضافة عقارك.
                            </div>
                        
                            <!-- زر التالي -->
                            <div class="d-flex justify-content-center mt-3 mx-3">
                                <button type="button" id="next-step" class="btn btn-primary w-50" style="background-color: #001f3f !important;">
                                    {{ translate('Next') }}
                                </button>
                            </div>
                            
                        </div>
                        
                        <!-- تعريف فئة CSS مخصصة للون الكحلي -->
                    
                        
                        


                        <!-- Step 2 -->
                        <div id="step-2" class="step mx-2" style="display:none;">
                            <h5>{{ translate('Step 2: Add Real Estate Details') }}</h5>
                            <input type="hidden" name="category_id" id="category_id" value="">
                            <div class="row g-3">
                                <!-- Fields for Step 2 -->


                                     <div class="col-md-6">
                                    <label for="short_description" class="form-label">نوع العقار</label>
                                    <input type="text" class="form-control"  value="{{ session('propertyType')}}"  id="category_name" name="category_name" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="long_description" class="form-label">الغرض من الاعلان</label>
                                    <input type="text" class="form-control" value="{{ session('advertisementType')}}" id="advertisementType" name="advertisementType" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;" readonly>
                                </div>


                                <div class="col-md-6">
                                    <label for="short_description" class="form-label">{{ translate("Short Description") }}</label>
                                    <input type="text" class="form-control" id="short_description" name="short_description" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
                                </div>
                                <div class="col-md-6">
                                    <label for="long_description" class="form-label">{{ translate("Long Description") }}</label>
                                    <textarea class="form-control" id="long_description" name="long_description" rows="4" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;"></textarea>
                                </div>





                                <div class="col-md-6 d-flex flex-column gap-2">
                                    @if (session('propertyType') == 'ارض')
                                    <label for="price" class="form-label mb-0">سعر المتر</label>
                                @else
                                    <label for="price" class="form-label mb-0">السعر</label>
                                @endif
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="text" value=" {{ session('propertyPrice', '') }}" class="form-control me-2"readonly id="price" name="price" style="max-width: 150px; border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
                                        <!-- Negotiable buttons -->
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-primary negotiable-btn active" data-value="قابل للتفاوض">
                                                {{ translate('Negotiable') }}
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary negotiable-btn" data-value="غير قابل للتفاوض">
                                                {{ translate('Non-Negotiable') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="area" class="form-label mb-0">{{ translate('Area (m²)') }}</label>
                                    <input type="text" readonly class="form-control" value="{{ session('propertyArea')}}" id="area" name="area" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
                                </div>

                                @if (session('propertyType') == 'ارض')
                                 <div class="form-group col-md-6">
                                    <label for="total_price" class="form-label mb-0">{{ translate("Price") }} </label>
                                    <input type="text" readonly class="form-control" value="{{ session('propertyArea') *  session('propertyPrice', '')}}" id="total_price" name="total_price" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
                                </div>
                                @else

                                @endif


                                @if (session('propertyType') != 'ارض')

                                <div class="form-group col-md-6">
                                    <label for="building_area" class="form-label mb-0">{{ translate('Building Area (m²)') }}</label>
                                    <input type="text"  class="form-control" id="building_area" name="building_area" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
                                </div>


                                @else

                                @endif


{{--

                                <div class="form-group col-md-6">
                                    <label class="form-label mb-0 d-inline-block mr-2">{{ translate('Property Type')}}</label>
                                    <div id="property-type" class="d-inline-block">
                                        <button type="button" class="btn btn-outline-primary btn-sm property-btn" data-value="1">سكني</button>
                                        <button type="button" class="btn btn-outline-primary btn-sm property-btn" data-value="2">تجاري</button>
                                    </div>
                                    <input type="hidden" id="property_type" name="property_type" value="1"> <!-- Default value (Residential) -->



                                </div> --}}
                                
                                
                                
                                    

                                <div class="form-group col-md-6">
                                    <label for="property-type" class="form-label mb-0"">{{ translate('Property Type')}}</label>
                                    <input type="text"  readonly class="form-control"  value="{{ session('propertyType')}}" id="property_type" name="property-type" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
                                </div>


                            


                                @if (session('propertyType') != 'ارض')
                                <div class="form-group col-md-6">
                                    <label for="building_area" class="form-label mb-0">عمر العقار </label>
                                    <input type="text" class="form-control" id="property_age" readonly value="{{ session('propertyAge', '') }}" name="building_area" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
                                </div>

                                @else

                                @endif
                                
                                
                                
                                
                               
    <div class="form-group col-md-6">
        <label for="obligationsOnTheProperty" class="form-label mb-0">الالتزامات  </label>
        <input type="text" class="form-control" id="obligationsOnTheProperty" readonly value="{{ session('obligationsOnTheProperty', '') }}" name="obligationsOnTheProperty" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
    </div>

    <div class="form-group col-md-6">
        <label for="guaranteesAndTheirDuration" class="form-label mb-0">الضمانات </label>
        <input type="text" class="form-control" id="guaranteesAndTheirDuration" readonly value="{{ session('guaranteesAndTheirDuration', '') }}" name="guaranteesAndTheirDuration" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
    </div>

    <div class="form-group col-md-6">
        <label for="locationDescriptionOnMOJDeed" class="form-label mb-0">وصف العقار حسب الصك</label>
        <input type="text" class="form-control" id="locationDescriptionOnMOJDeed" readonly value="{{ session('locationDescriptionOnMOJDeed', '') }}" name="locationDescriptionOnMOJDeed" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
    </div>

 @if (session('propertyType') != 'ارض')
    <div class="form-group col-md-6">
        <label for="numberOfRooms" class="form-label mb-0">عدد الغرف</label>
        <input type="text" class="form-control" id="numberOfRooms" readonly value="{{ session('numberOfRooms', '') }}" name="numberOfRooms" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
    </div>
    
    @endif

    <div class="form-group col-md-6">
        <label for="mainLandUseTypeName" class="form-label mb-0">الاستخدام  </label>
        <input type="text" class="form-control" id="mainLandUseTypeName" readonly value="{{ session('mainLandUseTypeName', '') }}" name="mainLandUseTypeName" style="border: 2px solid #ccc; padding: 8px; border-radius: 5px;">
    </div>





                                @if (session('propertyType') != 'ارض')


                                <!-- Room fields -->
                                <div id="room-fields" class="col-12">
                                    <div class="row">
                                        <!-- Number of Rooms -->
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">عدد الغرف</label>
                                            <div id="num_rooms" class="d-flex flex-wrap gap-1">
                                                <button type="button" class="btn btn-outline-primary btn-sm active" data-value="0">0</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="1">1</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="2">2</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="3">3</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="4">4</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="5">5</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="6">6</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="7">7</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="8">8</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="9">9</button>
                                            </div>
                                        </div>

                                        <!-- Number of Kitchens -->
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">عدد المطابخ</label>
                                            <div id="num_kitchens" class="d-flex flex-wrap gap-1">
                                                <button type="button" class="btn btn-outline-primary btn-sm active" data-value="0">0</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="1">1</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="2">2</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="3">3</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="4">4</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="5">5</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="6">6</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="7">7</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="8">8</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="9">9</button>
                                            </div>
                                        </div>

                                        <!-- Number of Bathrooms -->
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">عدد الحمامات</label>
                                            <div id="num_bathrooms" class="d-flex flex-wrap gap-1">
                                                <button type="button" class="btn btn-outline-primary btn-sm active" data-value="0">0</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="1">1</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="2">2</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="3">3</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="4">4</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="5">5</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="6">6</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="7">7</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="8">8</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="9">9</button>
                                            </div>
                                        </div>

                                        <!-- Number of Living Rooms -->
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">عدد الصالات</label>
                                            <div id="num_living_rooms" class="d-flex flex-wrap gap-1">
                                                <button type="button" class="btn btn-outline-primary btn-sm active" data-value="0">0</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="1">1</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="2">2</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="3">3</button>
                                                <button type="button" class="  btn btn-outline-primary btn-sm" data-value="4">4</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="5">5</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="6">6</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="7">7</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="8">8</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="9">9</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @else

                            @endif
                            </div>


                            <div  id="features-list-option" class="container mt-4">
                                <label class="form-label">{{ translate('Facilities')}} </label>
                                <div class="d-flex flex-wrap gap-2" id="features-list">
                                    <!-- سيتم إضافة الأزرار هنا -->
                                </div>
                            </div>


                            <!-- HTML -->
                            <div  id="network-type"  class="col-md-12 mt-4">
                                <label class="form-label">{{ translate('Network Type') }}</label>
                                <div class="d-flex flex-wrap gap-2" id="network-type">
                                    <button type="button" class="btn btn-outline-secondary d-flex align-items-center network-btn" data-value="stc" data-name="STC">
                                        <i class="fas fa-signal"></i> <!-- أيقونة للإشارة -->
                                        <span class="ms-2">{{ translate('STC') }}</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary d-flex align-items-center network-btn" data-value="stc-4g" data-name="STC 4G">
                                        <i class="fas fa-wifi"></i> <!-- أيقونة لـ 4G -->
                                        <span class="ms-2">{{ translate('STC 4G') }}</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary d-flex align-items-center network-btn" data-value="mobily" data-name="Mobily">
                                        <i class="fas fa-signal"></i> <!-- أيقونة للإشارة -->
                                        <span class="ms-2">{{ translate('Mobily') }}</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary d-flex align-items-center network-btn" data-value="mobily-4g" data-name="Mobily 4G">
                                        <i class="fas fa-wifi"></i> <!-- أيقونة لـ 4G -->
                                        <span class="ms-2">{{ translate('Mobily 4G') }}</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary d-flex align-items-center network-btn" data-value="zain" data-name="Zain">
                                        <i class="fas fa-signal"></i> <!-- أيقونة للإشارة -->
                                        <span class="ms-2">{{ translate('Zain') }}</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary d-flex align-items-center network-btn" data-value="zain-4g" data-name="Zain 4G">
                                        <i class="fas fa-wifi"></i> <!-- أيقونة لـ 4G -->
                                        <span class="ms-2">{{ translate('Zain 4G') }}</span>
                                    </button>
                                </div>
                            </div>





                            <div class="d-flex justify-content-between mt-3">
                                <button type="button" id="prev-step" class="btn btn-secondary">{{ translate('Previous')}}</button>
                                <button type="button" id="next-step-2" class="btn btn-primary">{{translate("Next")}}</button>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div id="step-3" class="step mx-2" style="display:none;">

                            <h5>{{ translate('Step 3: Additional Details') }}</h5>
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="row">
{{--                                        <div class="col-md-4 col-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="input-label" for="choice_zones">{{ translate('select_zone')}}</label>--}}
{{--                                                <select name="zone_id" id="choice_zones" class="form-control js-select2-custom"--}}
{{--                                                        data-placeholder="">--}}
{{--                                                    <option value="" selected disabled></option>--}}
{{--                                                    @foreach (\App\Models\Zone::all() as $zone)--}}
{{--                                                        <option value="{{ $zone->id }}">--}}

{{--                                                            {{ app()->getLocale() === 'ar' ? $zone->name_ar : $zone->name }}--}}
{{--                                                        </option>--}}

{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}




                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="input-label" for="choice_zones">كود المنطقة </label>
                                                <input type="text" id="choice_zones" name="choice_zones" class="form-control"
                                                       placeholder="" value="{{ session('location_regionCode', '') }}" required readonly>


                                            </div>
                                        </div>


                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="input-label" for="choice_zones"> المنطقة </label>
                                                <input type="text" id="choice_zones" name="choice_zones" class="form-control"
                                                       placeholder="" value="{{ session('location_region', '') }}" required readonly>


                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="input-label" for="choice_zones">{{ translate('city')}}</label>
                                                <input type="text" id="city" name="city" class="form-control"
                                                       placeholder="" value="{{ session('location_city', '') }}" required readonly>


                                            </div>
                                        </div>


                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="input-label" for="choice_zones">رقم المدينة</label>
                                                <input type="text" id="location_cityCode" name="location_cityCode" class="form-control"
                                                       placeholder="" value="{{ session('location_cityCode', '') }}" required readonly>


                                            </div>
                                        </div>










                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                        <label class="input-label" for="choice_zones">الحي </label>

                                        <input type="text" id="districts" name="districts" class="form-control"
                                               placeholder="" value="{{ session('location_district', '') }}" required readonly>
                                       </div>
                                        </div>



                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                            <label class="input-label" for="choice_zones">الرمز البريدي </label>
                                        <input type="text" name="national_address" class="form-control" placeholder=""
                                               id="national_address" value="{{ session('location_postalCode', '') }}" required readonly>
                                        </div>
                                        </div>



                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                            <label class="input-label" for="choice_zones">العنوان </label>
                                        <input type="text" name="address" class="form-control" placeholder=""
                                               id="address"
                                               value="{{ session('location_region') ." -". session('location_city') . ' - ' . session('location_district') . '-' .' ' . session('location_street').'-' .'  ' . session('location_buildingNumber') }}"
                                               required readonly>
                                        </div>
                                        </div>


                                        <!--<div class="col-md-4 col-6">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label class="input-label" for="choice_zones">خط الطول  </label>-->
                                        <!--<input type="text" id="latitude" name="latitude" class="form-control"-->
                                        <!--       placeholder="Ex : -94.22213" value="{{ session('location_longitude', '') }}" required readonly>-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                        <!--<div class="col-md-4 col-6">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label class="input-label" for="choice_zones">خط العرض </label>-->
                                        <!--<input type="text" name="longitude" class="form-control" placeholder=""-->
                                        <!--       id="longitude" value="{{ session('location_longitude', '') }}" required readonly>-->
                                        <!--    </div>-->
                                        <!--</div>-->




                                         <input type="hidden" id="latitude" name="latitude" class="form-control"
                                               placeholder="Ex : -94.22213" value="{{ session('location_longitude', '') }}" required readonly>





                                           <input type="hidden" name="longitude" class="form-control" placeholder=""
                                               id="longitude" value="{{ session('location_longitude', '') }}" required readonly>






                                             <div class="col-md-4 col-6">
                                            <div class="form-group">
                                            <label class="input-label" for="choice_zones">عرض الشارع </label>
                                        <input type="text" name="streetWidth" class="form-control" placeholder=""
                                               id="streetWidth"
                                               value="{{ session('streetWidth') }}(متر)"
                                               required readonly>
                                        </div>
                                        </div>



                                            <div class="col-md-4 col-6">
                                            <div class="form-group">
                                            <label class="input-label" for="choice_zones"> واجهة العقار </label>
                                        <input type="text" name="propertyFace" class="form-control" placeholder=""
                                               id="propertyFace"
                                               value="{{ session('propertyFace') }}"
                                               required readonly>
                                        </div>
                                        </div>



                                              {{-- <div class="col-md-4 col-6">
                                            <div class="form-group">
                                            <label class="input-label" for="choice_zones">الواجة </label>
                                        <input type="text" name="propertyFace" class="form-control" placeholder=""
                                               id="propertyFace"
                                               value="{{ session('propertyFace') }}"
                                               required readonly>
                                        </div>
                                        </div> --}}


                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <label class="input-label" for="choice_zones">  الحد من جهة الشمال   </label>
                                        <input type="text" id="north_limit" name="north_limit" class="form-control"
                                               placeholder="Ex : -94.22213" value="{{ session('north_limit_name', '')." - ". session('north_limit_description') ." - ". session('north_limit_length_char')}}" required readonly>
                                            </div>
                                        </div>

                                      <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <label class="input-label" for="choice_zones">الحد من جهة الشرق   </label>
                                        <input type="text" id="east_limit" name="east_limit" class="form-control"
                                               placeholder="Ex : -94.22213" value="{{ session('east_limit_name', '')." - ". session('east_limit_description') ." - ". session('east_limit_length_char')}}" required readonly>
                                            </div>
                                        </div>



                                           <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <label class="input-label" for="choice_zones">الحد من جهة الغرب     </label>
                                        <input type="text" id="west_limit" name="west_limit" class="form-control"
                                               placeholder="Ex : -94.22213" value="{{ session('west_limit_name', '')." - ". session('west_limit_description') ." - ". session('west_limit_length_char')}}" required readonly>
                                            </div>
                                        </div>



                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <label class="input-label" for="choice_zones">الحد من جهة الجنوب     </label>
                                        <input type="text" id="south_limit" name="south_limit" class="form-control"
                                               placeholder="Ex : -94.22213" value="{{ session('south_limit_name', '')." - ". session('south_limit_description') ." - ". session('south_limit_length_char')}}" required readonly>
                                            </div>
                                        </div>



                                        {{-- <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <label class="input-label" for="choice_zones">الجهة     </label>
                                        <input type="text" id="propertyFace" name="propertyFace" class="form-control"
                                               placeholder="Ex : -94.22213" value="{{ session('propertyFace', '')}}" required readonly>
                                            </div>
                                        </div> --}}



                                        <!--<div class="col-md-4 col-6">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label class="input-label" for="choice_zones">عرض الشارع</label>-->
                                        <!--<input type="text" id="streetWidth" name="propertyFace" class="form-control"-->
                                        <!--       placeholder="Ex : -94.22213" value="{{ session('streetWidth', '')}}" required readonly>-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                    </div>

                                    <br>
                                    <input id="pac-input" class="controls rounded" style="height: 3em;width:fit-content;" title="{{__('messages.search_your_location_here')}}" type="text" placeholder="{{__('messages.search_here')}}"/>
                                    <div id="map"></div>

                                </div>



                            <!--        <div class="form-group">-->
                            <!--    <label>  عرض الشارع  </label>-->
                            <!--    <input type="text" id="titleDeedTypeName" class="form-control" readonly value="{{ session('streetWidth', '') }}">-->
                            <!--</div>-->
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <h4 class="card-title mb-4">صور العقار</h4>
                                        <div class="col-lg-8">
                                            <div class="form-group m-0">
                                                <div>
                                                    <div class="row" id="estate_imag"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <h4 class="card-title mb-4">صور المخطط</h4>
                                        <div class="col-lg-8">
                                            <div class="form-group m-0">
                                                <div>
                                                    <div class="row" id="planed_image"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <label for="additional_info">{{ translate('Additional Information') }}:</label>
                                <input type="text" id="additional_info" class="form-control">
                            </div> --}}
                            <div class="d-flex justify-content-between mt-3">
                                <button type="button" id="prev-step-2" class="btn btn-secondary">     {{ translate('Previous')}}</button>
                                <button type="button" id="next-step-3" class="btn btn-primary">     {{ translate('Next')}}</button>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div id="step-4" class="step" style="display:none;">
                            <h5>{{ translate('Step 4: Confirm Real Estate Details') }}</h5>


                            <div class="form-group">
                                <label>اسم المعلن </label>
                                <input type="text" id="user-name" class="form-control" readonly value="{{ session('advertiserName', '') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ translate('Phone Number') }}</label>
                                <input type="text" id="user-phone" class="form-control" readonly value="{{ session('phoneNumber', '') }}">
                            </div>






                            <div class="form-group">
                                <label> رقم ترخيص الإعلان</label>
                                <input type="text" id="adLicenseNumber" class="form-control" readonly value="{{ session('adLicenseNumber', '') }}">
                            </div>

                            <div class="form-group">
                                <label>تاريخ الترخيص</label>
                                <input type="text" id="creationDate" class="form-control" readonly value="{{ session('creationDate', '') }}">
                            </div>

                            <div class="form-group">
                                <label>تاريخ انتهاء الترخيص</label>
                                <input type="text" id="endDate" class="form-control" readonly value="{{ session('endDate', '') }}">
                            </div>



                            <div class="form-group">
                                <label>رقم وثيقة الملكية</label>
                                <input type="text" id="deedNumber" class="form-control" readonly value="{{ session('deedNumber', '') }}">
                            </div>



                            <div class="form-group">
                                <label>رقم رخصة فال </label>
                                <input type="text" id="brokerageAndMarketingLicenseNumber" class="form-control" readonly value="{{ session('brokerageAndMarketingLicenseNumber', '') }}">
                            </div>



                            <div class="form-group">
                                <label>نوع وثيقة الملكية/المنفعة  </label>
                                <input type="text" id="titleDeedTypeName" class="form-control" readonly value="{{ session('titleDeedTypeName', '') }}">
                            </div>

                            <input type="hidden" id="user_id" class="form-control" readonly value="{{ $user->id }}">


                            <!-- Type of advertiser -->
                            <!--<div class="form-group">-->
                            <!--    <label>{{ translate('Type of Advertiser') }}</label>-->
                            <!--    <div class="btn-group" role="group" aria-label="Type of Advertiser">-->
                            <!--        <button type="button" id="owner-btn" class="btn btn-outline-primary btn-sm">{{ translate('Owner') }}</button>-->
                            <!--        <button type="button" id="authorized-btn" class="btn btn-outline-secondary btn-sm">{{ translate('Authorized') }}</button>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <!-- Fields for Owner -->
                            <div id="owner-fields">

                                <div class="form-group">
                                    <label for="ad-number">رقم رخصة الإعلان</label>
                                    <input type="text" id="ad-number" class="form-control" readonly value="{{ session('adLicenseNumber', '') }}" placeholder="{{ translate('Enter ad number') }}">
                                </div>
                            </div>

                            <!-- Fields for Authorized -->
                            <div id="authorized-fields" style="display: none;">
                                <div class="form-group">
                                    <label for="authorization-number">{{ translate('Authorization Number') }}</label>
                                    <input type="text" id="authorization-number" class="form-control" placeholder="{{ translate('Enter authorization number') }}">
                                </div>

                                <div class="form-group">
                                    <label for="ad-number-authorized">رقم رخصة الإعلان</label
                                    <input type="text" id="ad-number-authorized" readonly class="form-control" value="{{ session('adLicenseNumber', '') }}"  placeholder="{{ translate('Enter ad number') }}">
                                </div>













                            </div>


                            <div class="form-group">
                                <label for="virtual-tour-link">{{ translate('Virtual Tour Link') }}</label>
                                <div class="input-group">
                                    <input type="text" id="virtual-tour-link" class="form-control" placeholder="{{ translate('Enter virtual tour link') }}">
                                    <div class="input-group-append">
                                        <button type="button" id="show-virtual-tour" class="btn btn-primary">{{ translate('Show Content') }}</button>
                                    </div>
                                </div>
                            </div>




                            <div class="d-flex justify-content-between mt-3">
                                <button type="button" id="prev-step-3" class="btn btn-secondary">{{ translate('Previous') }}</button>
                                <button type="button" id="submit-form" class="btn btn-success">{{ translate('Submit') }}</button>
                            </div>
                        </div>










                    </div>
                </div>
            </section>
        </div>
    </div>





    <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verificationModalLabel">{{ translate('Account Verification') }}</h5>
                    <!-- زر إغلاق الـ Modal -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ translate('Close') }}"></button>
                </div>
                <div class="modal-body">


                    <input type="hidden" id="user_id" class="form-control" readonly value="{{ $user->id }}">
                    <label for="identity_number" class="form-label">{{ translate('Enter Your ID Number') }}</label>
                    <input type="text" class="form-control" id="identity_number" placeholder="{{ translate('Enter ID Number') }}">

                    <div id="loadingIndicator" style="display: none;">
                        <p>{{ __('Loading...') }}</p>
                        <!-- يمكنك استخدام أيقونة تحميل هنا، على سبيل المثال -->
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">{{ __('Loading...') }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="verifyButton">{{ translate('Verify') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to display random value -->
    <div class="modal fade" id="randomValueModal" tabindex="-1" aria-labelledby="randomValueModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="randomValueModalLabel">{{ translate('Verification Result') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ translate('Close') }}"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <!-- دائرة لعرض الرقم بلون كحلي وحجم أصغر -->
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center"
                         style="width: 60px; height: 60px; font-size: 18px; background-color: #001f3f;">
                        <p id="randomValueText" class="mb-0"></p>


                    </div>















                    {{-- <p id="idNumber" class="mb-0"></p> --}}
                </div>



                <input type="hidden" id="idNumber" class="form-control">

                <input type="hidden" id="transId" class="form-control">

                <input type="hidden" id="user_id" class="form-control" value="{{$user->id}}">
                <div class="modal-footer">
                    <!-- زر تأكيد عريض وأقصر طولا -->
                    <button type="button" class="btn btn-success" id="confirmButton" style="width: 100%; height: 40px; font-size: 14px;">
                        {{ translate('Confirm') }}
                    </button>
                </div>
            </div>
        </div>
    </div>








    @push('script')
    
<script src="{{ asset('public/assets/front-end/vendor/jquery/dist/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('public/assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/front-end/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('public/assets/front-end/vendor/simplebar/dist/simplebar.min.js') }}"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="{{theme_asset(path: 'public/assets/front-end/js/spartan-multi-image-picker.js')}}"></script>
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <!-- SweetAlert2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        {{-- <script src="{{ asset('assets/admin/js/spartan-multi-image-picker.js') }}"></script> --}}
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

              <script src="{{asset('public/assets/front-end/js/spartan-multi-image-picker.js')}}"></script>
              <script src="{{ asset('public/assets/front-end/js/spartan-multi-image-picker.js') }}"></script>


  

        







        <script>





            $(document).ready(function() {




// Function to get a specific cookie by name
                function getCookie(name) {
                    let value = "; " + document.cookie;
                    let parts = value.split("; " + name + "=");
                    if (parts.length === 2) return parts.pop().split(";").shift();
                }

// When the verify button is clicked
                $('#verifyButton').click(function() {
                    let idNumber = $('#identity_number').val();
                    let userId = $('#user_id').val();
                    let token = getCookie('BearerToken'); // Get the token from cookies

                    // Show loading indicator
                    $('#loadingIndicator').show();

                    // Send AJAX request
                    $.ajax({
                        url: '{{ route("nafath-validation") }}',
                        type: 'POST',
                        data: {
                            id_number: idNumber,
                            user_id : userId
                        },
                        headers: {
                            'Authorization': 'Bearer ' + token,  // Authorization Bearer token
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // CSRF token
                        },
                        success: function(response) {
                            // Hide loading indicator
                            $('#loadingIndicator').hide();

                            // Extract the random value from the response
                            let randomValue = response.random;

                            let transId = response.transId;

                            // Set the random value in the second modal
                            $('#randomValueText').text( randomValue);

                            $('#transId').val( transId);

                            $('#idNumber').val( idNumber);


                            $('#user_id').val( userId);





                            // Hide the verification modal
                            $('#verificationModal').modal('hide');

                            // Show the random value modal
                            $('#randomValueModal').modal('show');
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            console.error('Error:', error);
                            $('#loadingIndicator').hide();  // Hide loading indicator on failure
                            alert('An error occurred: ' + xhr.responseJSON.message); // Show error message
                        }
                    });
                });



                $('#confirmButton').on('click', function() {

                    console.log("----------------------------------------------");
                    
                    // اجمع البيانات التي تريد إرسالها
                    var nationalId = $('#idNumber').val();
                    var transId = $('#transId').val();
                    var random = $('#randomValueText').text();
                    var user_id = $('#user_id').val();

                    $('#confirmButton').prop('disabled', true);
                    $('#loading').show();


                    $.ajax({
                        url: '{{ route("check-request-status") }}',
                        method: 'POST',
                        data: {
                            nationalId: nationalId,
                            transId: transId,
                            random: random,
                            user_id : user_id,
                            _token: '{{ csrf_token() }}' // إضافة CSRF token
                        },
                        success: function(response) {
                            $('#loading').hide();
                            $('#confirmButton').prop('disabled', false);
                            // التعامل مع الاستجابة الناجحة
                            if (response.message === 'COMPLETED') {
                                alert('تم التحقق بنجاح!');

                                location.reload(); //
                            } else {
                                alert('التحقق لم يكتمل بعد.');
                            }
                        },
                        error: function(xhr, status, error) {

                            $('#loading').hide();
                            $('#confirmButton').prop('disabled', false);
                            // التعامل مع الأخطاء
                            alert('حدث خطأ أثناء معالجة الطلب.');
                            console.log(xhr.responseText);
                        }
                    });
                });



            });













            function validateInput(input) {
                // إزالة أي أحرف غير رقمية من الإدخال
                input.value = input.value.replace(/[^\d]/g, '');
            }

            // إضافة حدث لزر إغلاق الـ Modal
            document.querySelector('.btn-secondary').addEventListener('click', function() {
                var verificationModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('verificationModal'));
                verificationModal.hide();
            });




            // وظيفة للتحقق من إدخال الأرقام فقط

        </script>



        <script>
            // Function to handle the selection and update the button styles
            function handleButtonSelection(containerId) {
                const container = document.getElementById(containerId);
                const buttons = container.querySelectorAll('button');

                buttons.forEach(button => {
                    button.addEventListener('click', function () {
                        // Remove active class from all buttons in the container
                        buttons.forEach(btn => btn.classList.remove('active'));

                        // Add active class to the clicked button
                        this.classList.add('active');
                    });
                });
            }

            // Initialize the button selection for each field
            handleButtonSelection('num_rooms');
            handleButtonSelection('num_kitchens');
            handleButtonSelection('num_bathrooms');
            handleButtonSelection('num_living_rooms');
        </script>

        <style>
            /* Style to indicate the selected button */
            .btn.active {
                background-color: #007bff;
                color: #fff;
                border-color: #007bff;
            }
        </style>




        <script>




            var validationMessages = {
                requiredFieldsTitle: "{{ __('messages.required_fields_title') }}",
                requiredFieldsOwner: "{{ __('messages.required_fields_owner') }}",
                requiredFieldsAuthorized: "{{ __('messages.required_fields_authorized') }}",
                confirmButtonText: "{{ __('messages.confirm_button_text') }}"
            };


            var globalCategoryId = null;

            $(document).ready(function() {
                // Initial data load when page is loaded
                loadCategories('all');

                // Filter functionality
                $('.filter-btn').on('click', function() {
                    $('.filter-btn').removeClass('active');
                    $(this).addClass('active');
                    var filter = $(this).attr('id').replace('filter-', '');
                    loadCategories(filter);
                });

                function loadCategories(filter) {
                    $.ajax({
                        url: '{{ route("categories.filter") }}',
                        method: 'GET',
                        data: { type: filter,
                            category_id: globalCategoryId // استخدام المتغير العام
                        },
                        success: function(data) {
                            var categoryContainer = $('#category-container');


                            categoryContainer.empty(); // Clear existing categories

                            data.forEach(function(category) {
                                var isArabic = '{{ app()->getLocale() }}' === 'ar';
                                var categoryName = isArabic ? category.name_ar : category.name;
                                var categoryItem = `<div class="col-md-4 category-item" data-type="${category.type}">
                                <div class="card category-card"
                                    data-category-id="${category.id}"
                                    data-category-type="${category.type}"
                                    data-category-position="${category.position}">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h6 class="card-title">${categoryName}</h6>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>`;

                                categoryContainer.append(categoryItem);
                                globalCategoryId=category.id;
                            });

                            // Check all categories after adding them to the DOM
                            checkCategoryPositions();
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to fetch categories:', error);
                        }
                    });
                }

                function checkCategoryPositions() {
                    // افترض أنك تقوم بقراءة قيمة position من عنصر فئة معين. تأكد من تعديل هذا الجزء بناءً على كيفية تحديد الفئة.
                    var categoryPosition = parseInt($('#category-id').data('category-position')); // تحقق من قيمة categoryPosition

                    if (isNaN(categoryPosition)) {
                        console.error('Invalid categoryPosition value');
                        return; // إذا كانت القيمة غير صالحة، نخرج من الدالة
                    }

                    // تحقق مما إذا كانت القيمة تساوي 5 وأخفِ الحقل بناءً على ذلك
                    if (categoryPosition === 5) {
                        $('#building_area').closest('.form-group').hide(); // إخفاء حقل مساحة البناء
                    } else {
                        $('#building_area').closest('.form-group').show(); // إظهار حقل مساحة البناء
                    }


                    if (categoryPosition === 5) {
                        $('#building_area').closest('.form-group').hide(); // إخفاء حقل مساحة البناء
                    } else {
                        $('#building_area').closest('.form-group').show(); // إظهار حقل مساحة البناء
                    }
                }







                $('#prev-step').on('click', function() {
                    $('#step-2').hide();
                    $('#step-1').show();
                    $('html, body').animate({ scrollTop: 0 }, 'slow'); // Scroll to top
                });
            });






            $(document).ready(function() {


                document.getElementById('show-virtual-tour').addEventListener('click', function() {
                    var tourLink = document.getElementById('virtual-tour-link').value;

                    if (tourLink) {
                        var dialog = document.createElement('div');
                        dialog.classList.add('modal', 'fade');
                        dialog.setAttribute('tabindex', '-1');
                        dialog.setAttribute('role', 'dialog');
                        dialog.setAttribute('aria-labelledby', 'virtualTourModalLabel');
                        dialog.setAttribute('aria-hidden', 'true');

                        dialog.innerHTML = `
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="virtualTourModalLabel">{{ translate('Virtual Tour') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm ml-2" id="maximize-btn">{{ translate('Maximize') }}</button>
                    </div>
                    <div class="modal-body">
                        <iframe src="${tourLink}" width="100%" height="400px" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                    </div>
                </div>
            </div>
        `;

                        document.body.appendChild(dialog);

                        // عرض الديلوق بعد إضافته إلى الـ DOM
                        $(dialog).modal('show');

                        // إزالة الديلوق من الـ DOM عند إغلاقه
                        $(dialog).on('hidden.bs.modal', function () {
                            $(this).remove();
                        });

                        // تكبير الديلوق عند الضغط على زر التكبير
                        dialog.querySelector('#maximize-btn').addEventListener('click', function() {
                            var modalDialog = dialog.querySelector('.modal-dialog');
                            modalDialog.classList.toggle('modal-lg'); // تكبير/تصغير الديلوق
                        });

                        // التأكد من إغلاق المودال باستخدام زر الإغلاق
                        dialog.querySelector('.close').addEventListener('click', function() {
                            $(dialog).modal('hide');
                        });

                        // التأكد من إغلاق المودال باستخدام زر الإغلاق في الفوتر
                        dialog.querySelector('.btn-secondary').addEventListener('click', function() {
                            $(dialog).modal('hide');
                        });

                    } else {
                        alert('{{ translate('Please enter a valid link.') }}');
                    }
                });




// Function to print selected room attributes
// function printSelectedAttributes() {
                const attributes = [];

                // Get the selected room numbers
                const numRooms = document.querySelector('#num_rooms .btn.active');
                if (numRooms) {
                    attributes.push({ name: "غرف نوم", number: numRooms.getAttribute('data-value') });
                }

                // Get the selected kitchen numbers
                const numKitchens = document.querySelector('#num_kitchens .btn.active');
                if (numKitchens) {
                    attributes.push({ name: "مطبخ", number: numKitchens.getAttribute('data-value') });
                }

                // Get the selected bathroom numbers
                const numBathrooms = document.querySelector('#num_bathrooms .btn.active');
                if (numBathrooms) {
                    attributes.push({ name: "حمام", number: numBathrooms.getAttribute('data-value') });
                }

                // Get the selected living room numbers
                const numLivingRooms = document.querySelector('#num_living_rooms .btn.active');
                if (numLivingRooms) {
                    attributes.push({ name: "صالات", number: numLivingRooms.getAttribute('data-value') });
                }

                // Print the selected attributes in JSON format
                console.log(JSON.stringify(attributes));
// }





                var propertyTypeValue;



                var selectedNetworkTypes = []; // Array to store selected network types

// Handle button click
                $('#network-type').on('click', '.network-btn', function() {
                    var button = $(this);
                    var name = button.attr('data-name');

                    // Toggle selected state
                    if (button.hasClass('btn-outline-secondary')) {
                        button.removeClass('btn-outline-secondary');
                        button.css({
                            'background-color': '#003366', // Navy color
                            'color': '#ffffff', // White text color
                            'border-color': '#003366' // Navy border color
                        });

                        // Add value to array if not already present
                        if (!selectedNetworkTypes.some(e => e.name === name)) {
                            selectedNetworkTypes.push({ name: name });
                        }
                    } else {
                        button.addClass('btn-outline-secondary');
                        button.css({
                            'background-color': '', // Reset background color
                            'color': '', // Reset text color
                            'border-color': '' // Reset border color
                        });

                        // Remove value from array
                        selectedNetworkTypes = selectedNetworkTypes.filter(function(item) {
                            return item.name !== name;
                        });
                    }
                });






                var selectedFeatures = []; // Array to store selected features
                var propertyTypeValue =1;

                // Fetch data from API
                $.ajax({
                    url: '{{ url('/api/v1/estate/get-advantages') }}', // Update with your API URL
                    method: 'GET',
                    success: function(data) {
                        var featuresList = $('#features-list');

                        // Create buttons based on data
                        $.each(data, function(index, feature) {
                            var button = $('<button>')
                                .addClass('btn btn-sm btn-outline-primary') // Button with initial style
                                .text(feature.name)
                                .attr('data-id', feature.id)
                                .attr('data-name', feature.name) // Add feature name to button
                                .on('click', function() {
                                    var featureId = $(this).attr('data-id');
                                    var featureName = $(this).attr('data-name');

                                    // Toggle selected state
                                    if ($(this).hasClass('btn-outline-primary')) {
                                        $(this).removeClass('btn-outline-primary');
                                        $(this).css({
                                            'background-color': '#003366', // Navy color
                                            'color': '#ffffff', // White text color
                                            'border-color': '#003366' // Navy border color
                                        });

                                        // Add value to array if not already present
                                        if (!selectedFeatures.some(e => e.name === featureName)) {
                                            selectedFeatures.push({ name: featureName });
                                        }
                                    } else {
                                        $(this).addClass('btn-outline-primary');
                                        $(this).css({
                                            'background-color': '', // Reset background color
                                            'color': '', // Reset text color
                                            'border-color': '' // Reset border color
                                        });

                                        // Remove value from array
                                        selectedFeatures = selectedFeatures.filter(function(item) {
                                            return item.name !== featureName;
                                        });
                                    }
                                });

                            // Add button to the list
                            featuresList.append(button);
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });






                // Additional code for step navigation
                const steps = {
                    1: $('#step-1'),
                    2: $('#step-2'),
                    3: $('#step-3'),
                    4: $('#step-4')
                };

                $('#next-step').on('click', function () {
                    if (validateStep1()) {
                        switchStep(1, 2);
                        console.log('Navigated to step 2');
                    }
                });

                $('#prev-step').on('click', function () {
                    switchStep(2, 1);
                    console.log('Navigated to step 1');
                });

                $('#next-step-2').on('click', function () {
                    if (validateStep2()) {
                        switchStep(2, 3);
                        console.log('Navigated to step 3');

                        // Print selected features to console
                        console.log('Selected Features:', JSON.stringify(selectedFeatures));

                        console.log('Selected Network Types:', JSON.stringify(selectedNetworkTypes));
                        console.log('Selected attributes Types:',JSON.stringify(attributes));


                    }
                });

                $('#prev-step-2').on('click', function () {
                    switchStep(3, 2);
                });

                $('#next-step-3').on('click', function () {
                    if (validateStep3()) {
                        switchStep(3, 4);
                        console.log('Navigated to step 4');
                    }
                });

                $('#prev-step-3').on('click', function () {
                    switchStep(4, 3);
                });

                function switchStep(fromStep, toStep) {
                    steps[fromStep].hide();
                    steps[toStep].show();
                }

                function validateStep1() {
                    // Validation logic for Step 1
                    return true;
                }

                function validateStep2() {
                    // Validation logic for Step 2
                    const shortDescription = $('#short_description').val().trim();
                    const price = $('#price').val().trim();
                    const area = $('#area').val().trim();



                    let emptyFields = [];

                    if (!shortDescription) {
                        emptyFields.push('{{ translate("Short Description") }}');
                    }
                    if (!price) {
                        emptyFields.push('{{ translate("Price") }}');
                    }
                    if (!area) {
                        emptyFields.push('{{ translate("Area (m²)") }}');
                    }

                    if (emptyFields.length > 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Incomplete Form',
                            text: 'Please fill in the following fields: ' + emptyFields.join(', '),
                            confirmButtonText: 'OK'
                        });

                        return false;
                    }

                    return true;
                }

                $(document).ready(function() {
                    // Initialize Spartan Multi Image Picker
                    $("#estate_imag").spartanMultiImagePicker({
                        fieldName: 'estate_image[]',  // The field name for images
                        maxCount: 10,  // Maximum number of images
                        rowHeight: '120px',
                        groupClassName: 'col-lg-2 col-md-4 col-sm-4 col-6',
                        maxFileSize: '',  // Optional: specify the maximum file size
                        placeholderImage: {
                            image: '{{ asset('assets/admin/img/400x400/img2.jpg') }}',  // Default placeholder image
                            width: '100%'
                        },
                        dropFileLabel: "Drop Here",  // Label text for file drop area
                        onAddRow: function(index, file) {
                            console.log('Image added:', index);
                        },
                        onRenderedPreview: function(index) {
                            console.log('Preview rendered:', index);
                        },
                        onRemoveRow: function(index) {
                            console.log('Image removed:', index);
                        },
                        onExtensionErr: function(index, file) {
                            toastr.error('{{ __('messages.please_only_input_png_or_jpg_type_file') }}', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        },
                        onSizeErr: function(index, file) {
                            toastr.error('{{ __('messages.file_size_too_big') }}', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    });



                    $("#planed_image").spartanMultiImagePicker({
                        fieldName: 'planned_image[]',  // The field name for planned images
                        maxCount: 10,  // Maximum number of images
                        rowHeight: '120px',
                        groupClassName: 'col-lg-2 col-md-4 col-sm-4 col-6',
                        maxFileSize: '',  // Optional: specify the maximum file size
                        placeholderImage: {
                            image: '{{ asset('assets/admin/img/400x400/img2.jpg') }}',  // Default placeholder image
                            width: '100%'
                        },
                        dropFileLabel: "Drop Here",  // Label text for file drop area
                        onAddRow: function(index, file) {
                            console.log('Image added:', index);
                        },
                        onRenderedPreview: function(index) {
                            console.log('Preview rendered:', index);
                        },
                        onRemoveRow: function(index) {
                            console.log('Image removed:', index);
                        },
                        onExtensionErr: function(index, file) {
                            toastr.error('{{ __('messages.please_only_input_png_or_jpg_type_file') }}', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        },
                        onSizeErr: function(index, file) {
                            toastr.error('{{ __('messages.file_size_too_big') }}', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    });







                    $(document).on('click', '.category-card', function() {
                        var categoryId = $(this).data('category-id');
                        var categoryType = $(this).data('category-type');
                        var categoryPosition = parseInt($(this).data('category-position')); // Convert position to an integer

                        console.log("Category Position on Click:", categoryPosition);
                        $('#category_id').val(categoryId); // Set the category_id in a hidden input field
                        $('#category-type').text(categoryType);








                        $('.category-card').removeClass('active'); // Remove active class from all cards
                        $(this).addClass('active'); // Add active class to clicked card


                        let accountVerification = {{ $user->account_verification }};





// التحقق إذا كانت القيمة تساوي 0
                        if (accountVerification === 0) {
                            // عرض الـ Modal للتحقق
                            var verificationModal = new bootstrap.Modal(document.getElementById('verificationModal'));
                            verificationModal.show();
                            return
                        }


                        document.getElementById('verifyButton').addEventListener('click', function() {
                            // احصل على رقم الهوية المدخل
                            let identityNumber = document.getElementById('identity_number').value;

                            // التحقق من رقم الهوية (يمكنك إضافة تحقق من الرقم هنا)
                            if (/^\d{10}$/.test(identityNumber)) {
                                // يمكنك هنا إضافة الكود لإرسال الرقم إلى الخادم للتحقق
                                console.log('Identity number entered:', identityNumber);
                                // إخفاء الـ Modal بعد التحقق
                                var verificationModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('verificationModal'));
                                verificationModal.hide();
                            } else {
                                alert('Please enter exactly 10 digits.');
                            }
                        });



                        // Check category position on click
                        if (categoryPosition === 5) {
                            $('#room-fields').hide(); // Hide room fields
                            $('#features-list-option').hide(); // Hide room fields


                            $('#building_area').closest('.form-group').hide();
                            $('#network-type').hide(); // Hide room fields
                        } else {
                            $('#room-fields').show(); // Show room fields
                            $('#network-type').show(); // Show room fields
                            $('#features-list-option').show(); // Show room fields
                            $('#building_area').closest('.form-group').show(); // Show building area field
                        }





                        $('#step-1').hide();
                        $('#step-2').show();
                        $('html, body').animate({ scrollTop: 0 }, 'slow'); // Scroll to top
                    });




                    document.querySelector('.btn-close').addEventListener('click', function() {
                        var verificationModal = bootstrap.Modal.getInstance(document.getElementById('verificationModal'));
                        verificationModal.hide();
                    });


                    function verifyIdentity() {
                        // احصل على رقم الهوية المدخل
                        let identityNumber = document.getElementById('identity_number').value;

                        // التحقق من رقم الهوية (يمكنك إضافة تحقق من الرقم هنا)
                        if (identityNumber) {
                            // يمكنك هنا إضافة الكود لإرسال الرقم إلى الخادم للتحقق
                            console.log('Identity number entered:', identityNumber);
                            // إخفاء الـ Modal بعد التحقق
                            var verificationModal = bootstrap.Modal.getInstance(document.getElementById('verificationModal'));
                            verificationModal.hide();
                        } else {
                            alert('Please enter your ID number.');
                        }
                    }




                    var selectedAdvertiserType = ''; // متغير عام لتخزين القيمة المختارة

                    $(document).ready(function() {
                        // Set default selection
                        $('#owner-btn').addClass('btn-primary');
                        $('#authorized-btn').addClass('btn-outline-secondary');
                        $('#authorized-fields').hide();
                        selectedAdvertiserType = 'مالك'; // القيمة الافتراضية تكون "مالك"

                        // Handle button clicks
                        $('#owner-btn').click(function() {
                            $(this).removeClass('btn-outline-primary').addClass('btn-primary');
                            $('#authorized-btn').removeClass('btn-primary').addClass('btn-outline-secondary');
                            $('#owner-fields').show();
                            $('#authorized-fields').hide();
                            selectedAdvertiserType = 'مالك'; // تحديث القيمة عند اختيار "مالك"
                        });

                        $('#authorized-btn').click(function() {
                            $(this).removeClass('btn-outline-secondary').addClass('btn-primary');
                            $('#owner-btn').removeClass('btn-primary').addClass('btn-outline-secondary');
                            $('#authorized-fields').show();
                            $('#owner-fields').hide();
                            selectedAdvertiserType = 'مفوض'; // تحديث القيمة عند اختيار "مفوض"
                        });
                    });

// يمكنك الآن استخدام selectedAdvertiserType في أي جزء آخر من الكود خارج $(document).ready)



                    var negotiableValue='قابل للتفاوض';
                    $('#property-type .property-btn[data-value="1"]').addClass('active btn-primary').removeClass('btn-outline-primary');

                    $('#property-type').on('click', '.property-btn', function() {
                        // Remove 'active' class and reset styles from all buttons
                        $('#property-type .property-btn').removeClass('active btn-primary').addClass('btn-outline-primary');

                        // Add 'active' class and apply styles to the clicked button
                        $(this).addClass('active btn-primary').removeClass('btn-outline-primary');

                        // Set the value of the 'property_type' field based on the clicked button
                        propertyTypeValue = $(this).data('value');
                        $('#property_type').val(propertyTypeValue);
                    });



                    $('.negotiable-btn').first().addClass('active').data('value', '1'); // Default to 'Negotiable'

                    $('.negotiable-btn').on('click', function() {
                        // Remove 'active' class from all buttons
                        $('.negotiable-btn').removeClass('active btn-primary btn-outline-secondary').addClass('btn-outline-secondary');

                        // Add 'active' class to the clicked button
                        $(this).addClass('active btn-primary').removeClass('btn-outline-secondary');

                        // Set the value of the 'negotiable' field based on the clicked button
                        negotiableValue = $(this).data('value');
                        $('#negotiable-switch').val(negotiableValue);
                    });








                    // Handle form submission
                    $('#submit-form').on('click', function(e) {
                        e.preventDefault(); // Prevent default form submission

                    console.log();
                    


                        console.log('Selected Advertiser Type: ' + selectedAdvertiserType);
                        // يمكنك هنا استخدام القيمة لتعيينها إلى حقل مخفي أو إرسالها مع النموذج
                        $('#advertiser_type_input').val(selectedAdvertiserType);

                        // Determine the type of advertiser
                        // let advertiserType = $('#owner-btn').hasClass('btn-primary') ? 'owner' : 'authorized';

                        // Validate required fields based on advertiser type
                        // if (advertiserType === 'owner') {

                        //     }
                        // } else if (advertiserType === 'authorized') {

                        // }

                        let attributes = []; // Array to collect room data
                        $('#num_rooms .btn.active').each(function() {
                            attributes.push({ name: "غرف نوم", number: $(this).data('value').toString() });
                        });
                        $('#num_kitchens .btn.active').each(function() {
                            attributes.push({ name: "مطبخ", number: $(this).data('value').toString() });
                        });
                        $('#num_bathrooms .btn.active').each(function() {
                            attributes.push({ name: "حمام", number: $(this).data('value').toString() });
                        });
                        $('#num_living_rooms .btn.active').each(function() {
                            attributes.push({ name: "صالات", number: $(this).data('value') .toString()});
                        });





                        // Prepare FormData to send to the server
                        const formData = new FormData();
                        formData.append('address', $('#address').val());
                        formData.append('national_address', $('#national_address').val());
                        formData.append('category_id', $('#category_id').val());
                        formData.append('other_advantages', JSON.stringify(selectedFeatures)); // Convert array to JSON string
                        formData.append('network_type', JSON.stringify(selectedNetworkTypes)); // Convert array to JSON string
                        formData.append('facilities', JSON.stringify(selectedNetworkTypes)); // Convert array to JSON string
                        formData.append('property', JSON.stringify(attributes)); // Convert array to JSON string
                        formData.append('property_type',  $('#property_type').val());
                        formData.append('short_description', $('#short_description').val());
                        formData.append('long_description', $('#long_description').val());
                        formData.append('price', $('#price').val());
                        formData.append('space', $('#area').val());
                        formData.append('build_space', $('#building_area').val());
                        formData.append('price_negotiation', negotiableValue);
                        formData.append('view', 1);
                        formData.append('user_id', $('#user_id').val());
                        formData.append('zone_id', $('#choice_zones').val());
                        formData.append('latitude', $('#latitude').val());
                        formData.append('longitude', $('#longitude').val());
                        formData.append('city', $('#city').val());
                        // formData.append('advertiser_type', advertiserType); // Add advertiser type to the data
                        // formData.append('ownership_type',  selectedAdvertiserType);


                        formData.append('total_price', $('#total_price').val());



                        formData.append('ar_path', $('#virtual-tour-link').val());


                        formData.append('creationDate', $('#creationDate').val());
                        formData.append('endDate', $('#endDate').val());
                        formData.append('deedNumber', $('#deedNumber').val());

                        formData.append('adLicenseNumber', $('#adLicenseNumber').val());

                        formData.append('titleDeedTypeName', $('#titleDeedTypeName').val());



                        formData.append('propertyFace', $('#propertyFace').val());

                        formData.append('streetWidth', $('#streetWidth').val());



                            formData.append('advertisementType', $('#advertisementType').val());

                        formData.append('category_name', $('#category_name').val());




                        formData.append('brokerageAndMarketingLicenseNumber', $('#brokerageAndMarketingLicenseNumber').val());




                        formData.append('age_estate', $('#property_age').val());



                             formData.append('north_limit', $('#north_limit').val());
                        formData.append('east_limit', $('#east_limit').val());
                        formData.append('west_limit', $('#west_limit').val());
                        formData.append('south_limit', $('#south_limit').val());




formData.append('obligationsOnTheProperty', $('#obligationsOnTheProperty').val());
formData.append('guaranteesAndTheirDuration', $('#guaranteesAndTheirDuration').val());
formData.append('locationDescriptionOnMOJDeed', $('#locationDescriptionOnMOJDeed').val());
formData.append('numberOfRooms', $('#numberOfRooms').val());
formData.append('mainLandUseTypeName', $('#mainLandUseTypeName').val());







                        // Add fields specific to advertiser type
                        // if (advertiserType === 'owner') {
                        //     formData.append('document_number', $('#document-number').val());
                        //     formData.append('ad_number', $('#ad-number').val());
                        // } else if (advertiserType === 'authorized') {
                        //     formData.append('authorization_number', $('#authorization-number').val());
                        //     formData.append('document_number_authorized', $('#document-number-authorized').val());
                        //     formData.append('ad_number', $('#ad-number-authorized').val());
                        // }

                        // Add images to FormData
                        $('input[name="estate_image[]"]').each(function(index, input) {
                            let files = $(input)[0].files;
                            if (files.length > 0) {
                                formData.append('estate_image[]', files[0]); // Use 'files[0]' to append each file
                            }
                        });

                        $('input[name="planned_image[]"]').each(function(index, input) {
                            let files = $(input)[0].files;
                            if (files.length > 0) {
                                formData.append('planned_image[]', files[0]); // Use 'files[0]' to append each file
                            }
                        });

                        // Show loading indicator
                        Swal.fire({
                            title: 'جارٍ الإرسال...',
                            text: 'يرجى الانتظار.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Send data to the server
                        $.ajax({
                            url: '{{ url("store-estate") }}',
                            type: 'POST',
                            data: formData,
                            processData: false, // Do not process data
                            contentType: false, // Do not set content type
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {

                                 console.log("Response from server:", response);

                                // عرض الاستجابة في تنبيه
                               // alert("Response received:\n" + JSON.stringify(response, null, 4));
                                Swal.close(); // Hide loading indicator
                                // if (response.success) {
                                // Show success dialog
                                Swal.fire({
                                    title: 'تمت عملية إضافة العقار بنجاح',
                                    html:  `
        <p>يمكنك الآن تحميل الفيديو الخاص بالعقار أدناه.</p>
        <p>كما يمكنك تحميل فيديو المنظور الجوي للعقار.</p>

        <label for="property-video" style="border: 2px dashed #ccc; padding: 20px; display: block; text-align: center; cursor: pointer;">
            <span id="property-video-label">اختر فيديو العقار</span>
            <video id="property-video-preview" style="display:none; width: 100%; max-width: 400px; margin-top: 10px;" controls></video>
        </label>
        <input type="file" id="property-video" name="property-video" accept="video/*" style="display: none;" onchange="previewVideo(event, 'property-video-preview', 'property-video-label')" />

        <br/><br/>

        <label for="aerial-view-video" style="border: 2px dashed #ccc; padding: 20px; display: block; text-align: center; cursor: pointer;">
            <span id="aerial-view-video-label">اختر فيديو المنظور الجوي</span>
            <video id="aerial-view-video-preview" style="display:none; width: 100%; max-width: 400px; margin-top: 10px;" controls></video>
        </label>
        <input type="file" id="aerial-view-video" name="aerial-view-video" accept="video/*" style="display: none;" onchange="previewVideo(event, 'aerial-view-video-preview', 'aerial-view-video-label')" />
    `,
                                    confirmButtonText: 'حسنًا',
                                    showCancelButton: true,
                                    cancelButtonText: 'إغلاق',
                                    didOpen: () => {
                                        document.getElementById('property-video').onchange = function(event) {
                                            previewVideo(event, 'property-video-preview', 'property-video-label');
                                        };
                                        document.getElementById('aerial-view-video').onchange = function(event) {
                                            previewVideo(event, 'aerial-view-video-preview', 'aerial-view-video-label');
                                        };

                                        function previewVideo(event, videoElementId, labelElementId) {
                                            var file = event.target.files[0];
                                            var videoElement = document.getElementById(videoElementId);
                                            var labelElement = document.getElementById(labelElementId);

                                            if (file) {
                                                var reader = new FileReader();

                                                reader.onload = function(e) {
                                                    videoElement.src = e.target.result;
                                                    videoElement.style.display = 'block'; // عرض عنصر الفيديو
                                                    labelElement.style.display = 'none'; // إخفاء نص التسمية
                                                };

                                                reader.readAsDataURL(file); // قراءة الملف وتحويله إلى URL يمكن للفيديو استخدامه
                                            }
                                        }
                                    },
                                    willClose: () => {
                                        // Redirect to the home page when Swal is closed
                                        window.location.href = '{{ url("/") }}'; // Adjust URL as necessary
                                    },
                                    preConfirm: () => {
                                        // Handle file uploads
                                        const propertyVideo = document.getElementById('property-video').files[0];
                                        const aerialViewVideo = document.getElementById('aerial-view-video').files[0];

                                        // Prepare FormData for video uploads
                                        const videoFormData = new FormData();
                                        if (propertyVideo) videoFormData.append('property_video', propertyVideo);
                                        if (aerialViewVideo) videoFormData.append('aerial_view_video', aerialViewVideo);

                                        // Send video data to the server
                                        if (videoFormData.has('property_video') || videoFormData.has('aerial_view_video')) {
                                            return $.ajax({
                                                url: '{{ url("upload-videos") }}',
                                                type: 'POST',
                                                data: videoFormData,
                                                processData: false,
                                                contentType: false,
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            }).then((videoResponse) => {
                                                if (videoResponse.success) {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'نجاح',
                                                        text: 'تم تحميل الفيديو بنجاح!',
                                                        confirmButtonText: 'حسنًا'
                                                    });
                                                    
                                                        window.location.href = '{{ url("/") }}'; // Adjust URL as necessary
                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'خطأ',
                                                        text: 'حدث خطأ أثناء تحميل الفيديو. حاول مرة أخرى.',
                                                        confirmButtonText: 'حسنًا'
                                                    });
                                                }
                                            }).catch((xhr) => {
                                                console.error('Error:', xhr.responseText);
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'خطأ',
                                                    text: 'حدث خطأ أثناء تحميل الفيديو. حاول مرة أخرى.\n' + xhr.responseText,
                                                    confirmButtonText: 'حسنًا'
                                                });
                                            });
                                        }
                                    }
                                });









// Function to preview selected video


                                // } else {
                                //     Swal.fire({
                                //         icon: 'error',
                                //         title: 'خطأ',
                                //         text: 'حدث خطأ أثناء إرسال التفاصيل. حاول مرة أخرى.',
                                //         confirmButtonText: 'حسنًا'
                                //     });
                                // }
                            }
                            ,
                            error: function(xhr, status, error) {
                                Swal.close(); // Hide loading indicator
                                console.error('Error:', error);
                                console.error('Error Details:', xhr.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'خطأ',
                                    text: 'حدث خطأ أثناء إرسال التفاصيل. حاول مرة أخرى.\n' + xhr.responseText,
                                    confirmButtonText: 'حسنًا'
                                });
                            }

                        });
                    });


                });



                function validateStep3() {
                    // التحقق من حقل المنطقة
                    const zoneId = $('#choice_zones').val();

                    const latitude = $('#latitude').val().trim();
                    const longitude = $('#longitude').val().trim();

                    // if (!zoneId) {
                    //     Swal.fire({
                    //         icon: 'warning',
                    //         title: 'اختيار المنطقة مطلوب',
                    //         text: 'يرجى اختيار منطقة قبل المتابعة إلى الخطوة التالية.',
                    //         confirmButtonText: 'حسناً'
                    //     });
                    //
                    //     return false;
                    // }

                    if (!latitude || !longitude) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'الإحداثيات مطلوبة',
                            text: 'يرجى التأكد من إدخال إحداثيات صحيحة لخط الطول وخط العرض.',
                            confirmButtonText: 'حسناً'
                        });

                        return false;
                    }

                    // إذا كانت كل التحققات صحيحة، أعد true
                    return true;
                }
            });



        </script>


        <style>
            .category-card {
                cursor: pointer;
                transition: background-color 0.3s;
                height: 50px; /* Adjust height as needed */
            }
            .category-card:hover {
                background-color: #f0f0f0;
            }
            .category-card.active {
                background-color: #007bff;
                color: white;
            }
            .card-body {
                padding: 10px; /* Adjust padding as needed */
            }
            .filter-btn.active {
                background-color: #007bff;
                color: white;
            }
            /* Responsive adjustments */
            .filter-btn {
                margin-bottom: 5px;
                flex: 1;
                background-color: #f0f0f0; /* Default button color */
            }
            .filter-btn:hover {
                background-color: #07169df0;
            }
            .step .row {
                margin-top: 20px;
            }
        </style>



        <

        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4&libraries=drawing,places&callback=initMap&v=3.45.8">
        </script>
        <script>



            // جلب الإحداثيات من الجلسة باستخدام Blade
            var latitude = {{ session('location_latitude', 24.7136) }}; // قيمة افتراضية للرياض
            var longitude = {{ session('location_longitude', 46.6753) }}; // قيمة افتراضية للرياض

            // تهيئة الخريطة
            function initMap() {
                var location = { lat: latitude, lng: longitude };

                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14, // مستوى التقريب
                    center: location
                });

                // إضافة علامة على الموقع
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }

            // استدعاء الدالة عند تحميل الصفحة
            window.onload = initMap;
        </script>



        

        <script>
            $('#reset_btn').click(function(){
                $('#viewer').attr('src','{{asset('assets/admin/img/900x400/img1.jpg')}}');
                $('#estate_imag').attr('src','{{asset('assets/admin/img/900x400/img1.jpg')}}');
            })

            $('#reset_btn').click(function(){
                $('#viewer').attr('src','{{asset('assets/admin/img/900x400/img1.jpg')}}');
                $('#planed_image').attr('src','{{asset('assets/admin/img/900x400/img1.jpg')}}');
            })
        </script>










        <style>
            #map {
                height: 350px;
            }

            @media only screen and (max-width: 768px) {

                /* For mobile phones: */
                #map {
                    height: 200px;
                }
            }

        </style>
    @endpush
@endsection
