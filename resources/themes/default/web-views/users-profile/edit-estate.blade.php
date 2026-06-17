@extends('layouts.front-end.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', translate('Add Real Estate'))
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                                <div class="mb-3 d-flex justify-content-center gap-3 flex-wrap">
                                    <button id="filter-all" class="btn filter-btn active">{{ translate('All') }}</button>
                                    <button id="filter-rent" class="btn filter-btn">{{ translate('For Rent') }}</button>
                                    <button id="filter-sale" class="btn filter-btn">{{ translate('For Sale') }}</button>
                                </div>
                                <h5>{{ translate('Step 1: Choose a Category') }}</h5>
                                <div class="row g-3" id="category-container">
                                    @foreach($categories as $category)
                                        <div class="col-md-4 category-item" data-type="{{ $category->type }}">
                                            <div class="card category-card" data-category-id="{{ $category->id }}">
                                                <div class="card-body d-flex justify-content-between align-items-center">
                                                    <h6 class="card-title">{{ $category->name }}</h6>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                        <polyline points="12 5 19 12 12 19"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" id="next-step" class="btn btn-primary">{{ translate('Next')}}</button>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div id="step-2" class="step" style="display:none;">
                                <h5>{{ translate('Step 2: Add Real Estate Details') }}</h5>
                                <input type="hidden" name="category_id" id="category_id" value="">
                                <div class="row g-3">
                                    <!-- Fields for Step 2 -->
                                    <div class="col-md-6">
                                        <label for="short_description" class="form-label">{{translate("Short Description")}}</label>
                                        <input type="text" class="form-control" id="short_description" name="short_description">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="long_description" class="form-label">{{translate("Long Description")}}</label>
                                        <input type="text" class="form-control" id="long_description" name="long_description" >
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city" required>
                                    </div> --}}
                                    <div class="col-md-6 d-flex flex-column gap-2">
                                        <label for="price" class="form-label mb-0">{{translate("Price")}}</label>
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="text" class="form-control me-2" id="price" name="price" style="max-width: 150px;">
                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-sm btn-primary negotiable-btn active" data-value="1">
                                                    {{ translate('Negotiable') }}
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary negotiable-btn" data-value="0">
                                                    {{ translate('Non-Negotiable') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="area" class="form-label mb-0">{{ translate('Area (m²)')}}</label>
                                        <input type="text" class="form-control" id="area" name="area">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="building_area" class="form-label mb-0">{{ translate('Building Area (m²)')}}</label>
                                        <input type="text" class="form-control" id="building_area" name="building_area">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label mb-0 d-inline-block mr-2">{{ translate('Property Type')}}</label>
                                        <div id="property-type" class="d-inline-block">
                                            <button type="button" class="btn btn-outline-primary btn-sm property-btn" data-value="1">سكني</button>
                                            <button type="button" class="btn btn-outline-primary btn-sm property-btn" data-value="2">تجاري</button>
                                        </div>
                                        <input type="hidden" id="property_type" name="property_type" value="1"> <!-- Default value (Residential) -->
                                    </div>







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
                                </div>


                                <div class="container mt-4">
                                    <label class="form-label">{{ translate('Facilities')}} </label>
                                    <div class="d-flex flex-wrap gap-2" id="features-list">
                                        <!-- سيتم إضافة الأزرار هنا -->
                                    </div>
                                </div>


                               <!-- HTML -->
<div class="col-md-12 mt-4">
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
                            <div id="step-3" class="step" style="display:none;">
                                <h5>{{ translate('Step 3: Additional Details') }}</h5>
                                <div class="row">
                                    <div class="col-lg-12">

                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label class="input-label" for="choice_zones">أختار المنطقه</label>
                                                        <select name="zone_id" id="choice_zones" class="form-control js-select2-custom"
                                                                data-placeholder="">
                                                            <option value="" selected disabled></option>
                                                            @foreach (\App\Models\Zone::all() as $zone)
                                                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label class="input-label" for="latitude">خط الطول</label>
                                                        <input type="text" id="latitude" name="latitude" class="form-control"
                                                               placeholder="Ex : -94.22213" value="{{ old('latitude') }}" required readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label class="input-label" for="longitude">خط العرض</label>
                                                        <input type="text" name="longitude" class="form-control" placeholder=""
                                                               id="longitude" value="{{ old('longitude') }}" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label class="input-label" for="city">المدينة</label>
                                                        <input type="text" id="city" name="city" class="form-control"
                                                               placeholder="" value="{{ old('city') }}" required readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label class="input-label" for="districts">الحي</label>
                                                        <input type="text" id="districts" name="districts" class="form-control"
                                                               placeholder="" value="{{ old('districts') }}" required readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label class="input-label" for="address">العنوان</label>
                                                        <input type="text" name="address" class="form-control" placeholder=""
                                                               id="address" value="{{ old('address') }}" required readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label class="input-label" for="national_address">العنوان الوطني</label>
                                                        <input type="text" name="national_address" class="form-control" placeholder=""
                                                               id="national_address" value="{{ old('national_address') }}" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <input id="pac-input" class="controls rounded" style="height: 3em;width:fit-content;" title="{{__('messages.search_your_location_here')}}" type="text" placeholder="{{__('messages.search_here')}}"/>
                                            <div id="map"></div>

                                    </div>
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

                                <div class="form-group">
                                    <label for="additional_info">{{ translate('Additional Information') }}:</label>
                                    <input type="text" id="additional_info" class="form-control">
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" id="prev-step-2" class="btn btn-secondary">     {{ translate('Previous')}}</button>
                                    <button type="button" id="next-step-3" class="btn btn-primary">     {{ translate('Next')}}</button>
                                </div>
                            </div>

                            <!-- Step 4 -->
                            <div id="step-4" class="step" style="display:none;">
                                <h5>{{ translate('Step 4: Confirm Real Estate Details') }}</h5>


                                <div class="form-group">
                                    <label>{{ translate('Logged-in User') }}</label>
                                    <input type="text" id="user-name" class="form-control" readonly value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Phone Number') }}</label>
                                    <input type="text" id="user-phone" class="form-control" readonly value="{{ $user->phone }}">
                                </div>


                                <input type="text" id="user_id" class="form-control" readonly value="{{ $user->id }}">


                                <!-- Type of advertiser -->
                                <div class="form-group">
                                    <label>{{ translate('Type of Advertiser') }}</label>
                                    <div class="btn-group" role="group" aria-label="Type of Advertiser">
                                        <button type="button" id="owner-btn" class="btn btn-outline-primary btn-sm">{{ translate('Owner') }}</button>
                                        <button type="button" id="authorized-btn" class="btn btn-outline-secondary btn-sm">{{ translate('Authorized') }}</button>
                                    </div>
                                </div>

                                <!-- Fields for Owner -->
                                <div id="owner-fields">
                                    <div class="form-group">
                                        <label for="document-number">{{ translate('Document Number') }}</label>
                                        <input type="text" id="document-number" class="form-control" placeholder="{{ translate('Enter document number') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ad-number">{{ translate('Ad Number') }}</label>
                                        <input type="text" id="ad-number" class="form-control" placeholder="{{ translate('Enter ad number') }}">
                                    </div>
                                </div>

                                <!-- Fields for Authorized -->
                                <div id="authorized-fields" style="display: none;">
                                    <div class="form-group">
                                        <label for="authorization-number">{{ translate('Authorization Number') }}</label>
                                        <input type="text" id="authorization-number" class="form-control" placeholder="{{ translate('Enter authorization number') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="document-number-authorized">{{ translate('Document Number') }}</label>
                                        <input type="text" id="document-number-authorized" class="form-control" placeholder="{{ translate('Enter document number') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ad-number-authorized">{{ translate('Ad Number') }}</label>
                                        <input type="text" id="ad-number-authorized" class="form-control" placeholder="{{ translate('Enter ad number') }}">
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

    @push('script')

<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>








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



<script src="{{ asset('assets/js/spartan-multi-image-picker.js') }}"></script>
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
}







            $('#prev-step').on('click', function() {
                $('#step-2').hide();
                $('#step-1').show();
                $('html, body').animate({ scrollTop: 0 }, 'slow'); // Scroll to top
            });
        });







$(document).ready(function() {



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



$(document).ready(function() {
    // Set default selection
    $('#owner-btn').addClass('btn-primary');
    $('#authorized-btn').addClass('btn-outline-secondary');
    $('#authorized-fields').hide();

    // Handle button clicks
    $('#owner-btn').click(function() {
        $(this).removeClass('btn-outline-primary').addClass('btn-primary');
        $('#authorized-btn').removeClass('btn-primary').addClass('btn-outline-secondary');
        $('#owner-fields').show();
        $('#authorized-fields').hide();
    });

    $('#authorized-btn').click(function() {
        $(this).removeClass('btn-outline-secondary').addClass('btn-primary');
        $('#owner-btn').removeClass('btn-primary').addClass('btn-outline-secondary');
        $('#authorized-fields').show();
        $('#owner-fields').hide();
    });
});



var propertyTypeValue;
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
        maxCount: 5,  // Maximum number of images
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
        maxCount: 5,  // Maximum number of images
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

    alert(categoryId);

    $('.category-card').removeClass('active'); // Remove active class from all cards
    $(this).addClass('active'); // Add active class to clicked card

    // Check category position on click
    if (categoryPosition === 5) {
        $('#room-fields').hide(); // Hide room fields
        $('#building_area').closest('.form-group').hide();
    } else {
        $('#room-fields').show(); // Show room fields
        $('#building_area').closest('.form-group').show(); // Show building area field
    }

    $('#step-1').hide();
    $('#step-2').show();
    $('html, body').animate({ scrollTop: 0 }, 'slow'); // Scroll to top
});



    // Handle form submission
    $('#submit-form').on('click', function(e) {
    e.preventDefault(); // Prevent default form submission

    // Determine the type of advertiser
    let advertiserType = $('#owner-btn').hasClass('btn-primary') ? 'owner' : 'authorized';

    // Validate required fields based on advertiser type
    if (advertiserType === 'owner') {
        if (!$('#document-number').val() || !$('#ad-number').val()) {
            Swal.fire({
                icon: 'warning',
                title: 'حقول مطلوبة',
                text: 'يرجى ملء جميع الحقول للمعلن "مالك".',
                confirmButtonText: 'حسنًا'
            });
            return; // Stop execution if fields are not filled
        }
    } else if (advertiserType === 'authorized') {
        if (!$('#authorization-number').val() || !$('#document-number-authorized').val() || !$('#ad-number-authorized').val()) {
            Swal.fire({
                icon: 'warning',
                title: 'حقول مطلوبة',
                text: 'يرجى ملء جميع الحقول للمعلن "مفوض".',
                confirmButtonText: 'حسنًا'
            });
            return; // Stop execution if fields are not filled
        }
    }

    let attributes = []; // Array to collect room data
    $('#num_rooms .btn.active').each(function() {
        attributes.push({ name: "غرف نوم", number: $(this).data('value') });
    });
    $('#num_kitchens .btn.active').each(function() {
        attributes.push({ name: "مطبخ", number: $(this).data('value') });
    });
    $('#num_bathrooms .btn.active').each(function() {
        attributes.push({ name: "حمام", number: $(this).data('value') });
    });
    $('#num_living_rooms .btn.active').each(function() {
        attributes.push({ name: "صالات", number: $(this).data('value') });
    });

    // Prepare FormData to send to the server
    const formData = new FormData();
    formData.append('address', $('#address').val());
    formData.append('national_address', $('#national_address').val());
    formData.append('category_id', $('#category_id').val());
    formData.append('facilities', JSON.stringify(selectedFeatures)); // Convert array to JSON string
    formData.append('network_type', JSON.stringify(selectedNetworkTypes)); // Convert array to JSON string
    formData.append('property', JSON.stringify(attributes)); // Convert array to JSON string
    formData.append('estate_type', propertyTypeValue);
    formData.append('short_description', $('#short_description').val());
    formData.append('long_description', $('#long_description').val());
    formData.append('price', $('#price').val());
    formData.append('space', $('#area').val());
    formData.append('build_space', $('#building_area').val());
    formData.append('price_negotiation', $('.negotiable-btn.active').data('value'));
    formData.append('view', 1);
    formData.append('user_id', $('#user_id').val());
    formData.append('zone_id', $('#choice_zones').val());
    formData.append('latitude', $('#latitude').val());
    formData.append('longitude', $('#longitude').val());
    formData.append('advertiser_type', advertiserType); // Add advertiser type to the data

    // Add fields specific to advertiser type
    if (advertiserType === 'owner') {
        formData.append('document_number', $('#document-number').val());
        formData.append('ad_number', $('#ad-number').val());
    } else if (advertiserType === 'authorized') {
        formData.append('authorization_number', $('#authorization-number').val());
        formData.append('document_number_authorized', $('#document-number-authorized').val());
        formData.append('ad_number_authorized', $('#ad-number-authorized').val());
    }

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
    Swal.close(); // Hide loading indicator
    // if (response.success) {
        // Show success dialog
        Swal.fire({
    title: 'تمت عملية إضافة العقار بنجاح',
    html: `
        <p>يمكنك الآن تحميل الفيديو الخاص بالعقار أدناه.</p>
        <p>كما يمكنك تحميل فيديو المنظور الجوي للعقار.</p>
        <input type="file" id="property-video" name="property-video" accept="video/*" onchange="previewVideo(event, 'property-video-preview')" />
        <br/><br/>
        <video id="property-video-preview" style="display:none; width: 100%; max-width: 400px;" controls></video>
        <br/><br/>
        <input type="file" id="aerial-view-video" name="aerial-view-video" accept="video/*" onchange="previewVideo(event, 'aerial-view-video-preview')" />
        <br/><br/>
        <video id="aerial-view-video-preview" style="display:none; width: 100%; max-width: 400px;" controls></video>
    `,
    confirmButtonText: 'حسنًا',
    showCancelButton: true,
    cancelButtonText: 'إغلاق',
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
                url: '{{ url("upload-videos") }}', // Adjust URL as necessary
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
function previewVideo(event, previewId) {
    const file = event.target.files[0];
    const preview = document.getElementById(previewId);

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}

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

    if (!zoneId) {
        Swal.fire({
            icon: 'warning',
            title: 'اختيار المنطقة مطلوب',
            text: 'يرجى اختيار منطقة قبل المتابعة إلى الخطوة التالية.',
            confirmButtonText: 'حسناً'
        });

        return false;
    }

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



<script src="{{ asset('assets/admin/js/spartan-multi-image-picker.js') }}"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4&libraries=drawing,places&callback=initMap&v=3.45.8">
    </script>
    <script>

        let myLatlng = {
            lat: {{ '23.757989' }},
            lng: {{ '90.360587' }}
        };
        let map = new google.maps.Map(document.getElementById("map"), {
            zoom: 13,
            center: myLatlng,
        });
        var zonePolygon = null;
        let infoWindow = new google.maps.InfoWindow({
            content: "Click the map to get Lat/Lng!",
            position: myLatlng,
        });
        var bounds = new google.maps.LatLngBounds();

        function initMap() {
            // Create the initial InfoWindow.
            infoWindow.open(map);
            //get current location block
            infoWindow = new google.maps.InfoWindow();
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        myLatlng = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        infoWindow.setPosition(myLatlng);
                        infoWindow.setContent("Location found.");
                        infoWindow.open(map);
                        map.setCenter(myLatlng);
                    },
                    () => {
                        handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
            //-----end block------
            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            let markers = [];
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                });
                map.fitBounds(bounds);
            });
        }
        initMap();

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation ?
                "Error: The Geolocation service failed." :
                "Error: Your browser doesn't support geolocation."
            );
            infoWindow.open(map);
        }
        $('#choice_zones').on('change', function() {
            var id = $(this).val();
            $.get({
                url: '{{ url('/') }}/zone/get-coordinates/' + id,
                dataType: 'json',
                success: function(data) {
                    if (zonePolygon) {
                        zonePolygon.setMap(null);
                    }
                    zonePolygon = new google.maps.Polygon({
                        paths: data.coordinates,
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: 'white',
                        fillOpacity: 0,
                    });
                    zonePolygon.setMap(map);
                    zonePolygon.getPaths().forEach(function(path) {
                        path.forEach(function(latlng) {
                            bounds.extend(latlng);
                            map.fitBounds(bounds);
                        });
                    });
                    map.setCenter(data.center);
                    google.maps.event.addListener(zonePolygon, 'click', function(mapsMouseEvent) {
                        infoWindow.close();
                        // Create a new InfoWindow.
                        infoWindow = new google.maps.InfoWindow({
                            position: mapsMouseEvent.latLng,
                            content: JSON.stringify(mapsMouseEvent.latLng.toJSON(),
                                null, 2),
                        });
                        var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null,
                            2);
                        var coordinates = JSON.parse(coordinates);

                        document.getElementById('latitude').value = coordinates['lat'];
                        document.getElementById('longitude').value = coordinates['lng'];
                        infoWindow.open(map);
                        var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+ coordinates['lat']+","+ coordinates['lng']+"&key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4&sensor=false&language=ar";
                        $.get(url, function(data) {
                            var results = data.results;
                            if (data.status === 'OK')
                            {
                                //console.log(JSON.stringify(results));
                                if (results[0])
                                {
                                    var city = "";
                                    var state = "";
                                    var country = "";
                                    var zipcode = "";
                                    var district = "";
                                    var national_address='';

                                    var address_components = results[0].address_components;

                                    for (var i = 0; i < address_components.length; i++)
                                    {
                                        if (address_components[i].types[0] === "administrative_area_level_1" && address_components[i].types[1] === "political") {
                                            state = address_components[i].long_name;
                                        }
                                        if (address_components[i].types[0] === "locality" && address_components[i].types[1] === "political" ) {
                                            city = address_components[i].long_name;
                                        }

                                        if (address_components[i].types[0] === "postal_code" && zipcode == "") {
                                            zipcode = address_components[i].long_name;

                                        }

                                        if (address_components[i].types[0] === "country") {
                                            country = address_components[i].long_name;

                                        }
                                        if (address_components[i].types[0] === "political" && address_components[i].types[1] === "sublocality"&& address_components[i].types[2] === "sublocality_level_1") {
                                            district = address_components[i].long_name;
                                        }
                                        if (address_components[i].types[0] === "premise" ) {
                                            national_address = address_components[i].long_name;
                                        }
                                    }
                                    var address = {
                                        "city": city,
                                        "state": state,
                                        "country": country,
                                        "zipcode": zipcode,
                                    };
                                    document.getElementById('city').value=city;
                                    document.getElementById('districts').value=district;
                                    document.getElementById('address').value=results[0].formatted_address;
                                    document.getElementById('national_address').value=national_address;
                                    console.log(address);
                                }
                                else
                                {
                                    window.alert('No results found');
                                }
                            }
                            else
                            {
                                window.alert('Geocoder failed due to: ' + status);

                            }
                        });
                    });
                },
            });
        });
    </script>



<script src="{{ asset('assets/js/spartan-multi-image-picker.js') }}"></script>
<

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
