@extends('layouts.admin')


@section('title','مزودين الخدمات')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
    <style>
        .anyClass {
            height:700px;
            overflow-y: scroll;
        }
    </style>
    <div class="anyClass">
<div class="card">
    <div class="card-body">

        <h4 class="card-title">أنشاء مزود خدمة</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form class="needs-validation" novalidate  action="{{ route('estate.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Bootstrap Validation - Normal</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">قسم الإعلان</label>
                                            <select  required name="category_id" class="form-control ">
                                                <option value="">---اختر القسم---</option>
                                                @foreach (\App\Models\Category::all() as $category)
                                                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom02">نوع الملكية</label>
                                            <select name="ownership_type" class="form-select" aria-label="Default select example">
                                                <option value="مالك">مالك </option>
                                                <option value="مفوض">مفوض</option>
                                            </select>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationTooltip02">الوصف المختصر</label>
                                        <div>
                                            <textarea name="short_description" required class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">وصف كامل </label>
                                        <div>
                                            <textarea name="long_description" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>


{{--                                <div class="row">--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="form-label" for="validationCustom03">City</label>--}}
{{--                                            <input type="text" class="form-control" id="validationCustom03"--}}
{{--                                                   placeholder="City" required>--}}
{{--                                            <div class="invalid-feedback">--}}
{{--                                                Please provide a valid city.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="form-label" for="validationCustom04">State</label>--}}
{{--                                            <input type="text" class="form-control" id="validationCustom04"--}}
{{--                                                   placeholder="State" required>--}}
{{--                                            <div class="invalid-feedback">--}}
{{--                                                Please provide a valid state.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="form-label" for="validationCustom05">Zip</label>--}}
{{--                                            <input type="text" class="form-control" id="validationCustom05"--}}
{{--                                                   placeholder="Zip" required>--}}
{{--                                            <div class="invalid-feedback">--}}
{{--                                                Please provide a valid zip.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Bootstrap Validation (Tooltips)</h4>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationTooltip01">السعر</label>
                                            <input name="price" type="text" class="form-control" required/>

                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationTooltip03">المساحة</label>
                                            <input type="text" name="space" class="form-control" id="validationTooltip03"
                                                   placeholder="بالمتر مربع" value="" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label"
                                                   for="validationTooltipUsername">نوع الإعلان</label>
                                            <div class="input-group">
                                                <select name="ad_type" class="form-select" aria-label="Default select example">
                                                    <option value="for_rent">لللإجار</option>
                                                    <option value="for_sell">للبيع</option>
                                                </select>
                                                <div class="invalid-tooltip">
                                                    Please choose a unique and valid username.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <h5 class="font-size-14 mb-4">تفاوض في السعر</h5>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="price_negotiation"
                                                       id="flexRadioDefault1" value="  قابل للتفاوض" checked>
                                                <label class="form-check-label"  for="flexRadioDefault1">
                                            قابل للتفاوض
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="غير قابل للتفاوض" type="radio" name="price_negotiation"
                                                       id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2" >
                                                    غير    قابل للتفاوض
                                                </label>
                                            </div>
                                        </div>
                                    </div>
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="mt-4 mt-lg-0">--}}
{{--                                            <h5 class="font-size-14 mb-4">Form radio right</h5>--}}
{{--                                            <div class="form-check-right mb-2">--}}
{{--                                                <input type="radio" id="customRadio1" name="customRadio"--}}
{{--                                                       class="form-check-input">--}}
{{--                                                <label class="form-check-label" for="customRadio1">Form Radio--}}
{{--                                                    Right</label>--}}
{{--                                            </div>--}}
{{--                                            <div>--}}
{{--                                                <div class="form-check-right">--}}
{{--                                                    <input type="radio" id="customRadio2" name="customRadio"--}}
{{--                                                           class="form-check-input" checked>--}}
{{--                                                    <label class="form-check-label" for="customRadio2">Form Radio--}}
{{--                                                        Checked Right</label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>


                        </div>
                    </div>
                    <!-- end card -->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="choice_zones">أختار المنطقه</label>
                                        <select  name="zone_id" id="choice_zones" required class="form-control js-select2-custom"
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

                <div class="row">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">تفاصيل العقار</h4>
                                <div class="mb-3">
                                    <label class="form-label">عمر العقار</label>
                                    <select name="age_estate" class="form-control select2">
                                        <option>اختر عمر العقار</option>


                                            <option value="سنة">سنة</option>
                                            <option value="سنتين">سنتين</option>
                                            <option value=" سنوان">3 سنوان</option>
                                            <option value="4 سنوات">4 سنوات</option>
                                            <option value=" سنوات">5 سنوات</option>
                                            <option value=" سنوات">6 سنوات</option>
                                            <option value="7 سنوات">7 سنوات</option>
                                            <option value="8 سنوات">8 سنوات</option>
                                            <option value="MS">9 سنوات</option>
                                            <option value="10 سنوات">10 سنوات</option>
                                            <option value="10+">10+</option>
                                            <option value="15+">15+</option>
                                            <option value="20+">20+</option>
                                            <option value="25+">25+</option>
                                            <option value="30+">30+</option>

                                    </select>
                                </div>


                                <div>
                                    <label class="form-label">اختر التغطية</label>

                                    <select class="select2 form-control select2-multiple" multiple="multiple"
                                            data-placeholder="Choose ...">

                                            <option value="CA">zain 4G</option>
                                            <option value="NV">zain 5G</option>
                                            <option value="OR">mobily 4G</option>
                                            <option value="WA">mobily 5G</option>

                                            <option value="OR">STC 4G</option>
                                            <option value="WA">STC 5G</option>

                                    </select>

                                </div>

                                <div>
                                    <label class="form-label">مزاياء اخرى</label>

                                    <select class="select2 form-control select2-multiple" multiple="multiple"
                                            data-placeholder="Choose ...">

                                            <option value="CA">التحكم بالتكيف</option>
                                            <option value="NV">الدخول الزكي</option>
                                            <option value="OR"> إطلالة بحرية</option>
                                            <option value="WA">التحكم بالإنارى</option>

                                            <option value="OR">التحكم بالستائر</option>
                                            <option value="WA">ممرات تكيف</option>

                                    </select>

                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationTooltip01">الواجهة الشمالية</label>
                                            <input type="number" class="form-control" id="validationTooltip01"
                                                   placeholder="بالمتر مربع" value="" >
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationTooltip04">الواجهة الشرقية</label>
                                            <input type="number" class="form-control" id="validationTooltip04"
                                                   placeholder="بالمتر مربع" value="" >
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationTooltip05">الواجهة الغربية</label>
                                            <input type="number" class="form-control" id="validationTooltip05"
                                                   placeholder="بالمتر مربع" value="" >
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationTooltip06">الواجهة الجنوبية</label>
                                            <input type="number" class="form-control" id="validationTooltip06"
                                                   placeholder="بالمتر مربع" value="" >
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">




                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">عدد الغرف </label>
                                        <input data-toggle="touchspin" name="room_number" type="text" value="0">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">عدد الحمامات </label>
                                        <input data-toggle="touchspin"  name="number_bathrooms" type="text" value="0">
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label">عدد الصالات </label>
                                        <input data-toggle="touchspin" name="number_lounges" type="text" value="0">
                                    </div>
                                    <div>
                                        <label class="form-label">Vertical button alignment:</label>
                                        <input id="demo_vertical" type="text" value="" name="demo_vertical">
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">تفاصيل العميل</h4>


                                <div class="mb-3">
                                    <label class="form-label">رقم جوال العميل </label>
                                    <input  id="employee_search"  maxlength="10"  value='{{old('phone')}}' required name="phone" type="text" class="form-control">
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">اسم العميل </label>
                                    <input required name="name" value='{{old('job_number')}}' id="job_number" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">العضوية</label>
                                    <select name="user_type" class="form-control select2">
                                        <option>العضوية</option>


                                        <option value="agent">مسوق عقاري</option>
                                        <option value="customer">عميل</option>


                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
                <!-- end col -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="invalidCheck"
                                       required>
                                <label class="form-check-label ms-1" for="invalidCheck">Agree to
                                    terms and conditions</label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-12">
                <button class="btn btn-primary form-control">حفظ</button>
            </div>
{{--            <button class="btn btn-primary" type="submit">حفظ</button>--}}
        </form>

    </div>
</div>
    </div>
@endsection


@section('scripts')
    <link rel="shortcut icon" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/img/flags.png" type="image/x-icon">
    <link rel="shortcut icon" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/img/flags@2x.png" type="image/x-icon">


    <script>
        $(document).on('ready', function() {
            @if (isset(auth('admin')->user()->zone_id))
            $('#choice_zones').trigger('change');
            @endif
            // INITIALIZATION OF SHOW PASSWORD
            // =======================================================
            $('.js-toggle-password').each(function() {
                new HSTogglePassword(this).init()
            });


            // INITIALIZATION OF FORM VALIDATION
            // =======================================================
            $('.js-validate').each(function() {
                $.HSCore.components.HSValidation.init($(this), {
                    rules: {
                        confirmPassword: {
                            equalTo: '#signupSrPassword'
                        }
                    }
                });
            });
        });
    </script>
    <script>
        function readURL(input, viewer) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#' + viewer).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this, 'viewer');
        });

        $("#coverImageUpload").change(function() {
            readURL(this, 'coverImageViewer');
        });
    </script>

    <script src="{{ asset('assets/admin/js/spartan-multi-image-picker.js') }}"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa4Ng7nNB5EkPqvcI1yaxcl8QE1Ja-tPA&libraries=drawing,places&callback=initMap&v=3.45.8">
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
                        var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+ coordinates['lat']+","+ coordinates['lng']+"&key=AIzaSyDa4Ng7nNB5EkPqvcI1yaxcl8QE1Ja-tPA&sensor=false&language=ar";
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
<script type="text/javascript">
    $(function() {
        $("#estate_imag").spartanMultiImagePicker({
            fieldName: 'estate_image[]',
            maxCount: 5,
            rowHeight: '120px',
            groupClassName: 'col-lg-2 col-md-4 col-sm-4 col-6',
            maxFileSize: '',
            placeholderImage: {
                image: '{{ asset('assets/admin/img/400x400/img2.jpg') }}',
                width: '100%'
            },
            dropFileLabel: "Drop Here",
            onAddRow: function(index, file) {

            },
            onRenderedPreview: function(index) {

            },
            onRemoveRow: function(index) {

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
    });
</script>
<script type="text/javascript">
    $(function() {
        $("#planed_image").spartanMultiImagePicker({
            fieldName: 'planed_image[]',
            maxCount: 5,
            rowHeight: '120px',
            groupClassName: 'col-lg-2 col-md-4 col-sm-4 col-6',
            maxFileSize: '',
            placeholderImage: {
                image: '{{ asset('assets/admin/img/400x400/img2.jpg') }}',
                width: '100%'
            },
            dropFileLabel: "Drop Here",
            onAddRow: function(index, file) {

            },
            onRenderedPreview: function(index) {

            },
            onRemoveRow: function(index) {

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
    });
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

<script type="text/javascript">


    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

        $( "#employee_search" ).autocomplete({
            source: function( request, response ) {
                console.log("omeromeromeomer")
                // Fetch data
                $.ajax({
                    url:"{{route('getEmployees')}}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                console.log(ui.item)
                // Set selection
                $('#employee_search').val(ui.item.label); // display the selected text
                $('#employeeid').val(ui.item.name);
                $('#job_number').val(ui.item.job_number); // save selected id to input
                return false;
            }
        });

    });
</script>



<link rel="shortcut icon" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/img/flags.png" type="image/x-icon">
<link rel="shortcut icon" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/img/flags@2x.png" type="image/x-icon">




@endsection
