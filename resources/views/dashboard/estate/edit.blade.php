@extends('layouts.admin')


@section('title','تعديل العرض')

@section('content')

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
        height:900px;
        overflow-y: scroll;
    }
</style>

<div class="anyClass">
<div class="card">
    <div class="card-body">

        <h4 class="card-title">تعديل البيانات</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form  class="needs-validation" novalidate action="{{ route('estate.update',$estates->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                            @if($categories && $categories -> count() > 0)
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{$category -> id }}"
                                                        @if($estates -> category_id == $category -> id  )  selected @endif
                                                    >{{$category -> name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom02">نوع الملكية</label>
                                        <select class="form-control" id="frm-status" name="ownership_type">
                                            <option value="مالك" {{ $estates->ownership_type== 'مالك' ? 'selected' : '' }}>مالك</option>
                                            <option value="مفوض" {{ $estates->ownership_type== 'مفوض'? 'selected' : '' }}>مفوض</option>
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
                                            <textarea name="short_description" required class="form-control" rows="3">{{$estates->short_description}}</textarea>
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
                                            <textarea name="long_description" class="form-control" rows="5">{{$estates->long_description}}</textarea>
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
                                        <input name="price" value="{{$estates->price}}" type="text" class="form-control" required/>

                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip03">المساحة</label>
                                        <input type="text" name="space"  class="form-control" id="validationTooltip03"
                                               placeholder="بالمتر مربع" value="{{$estates->space}}" required>
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
                                            <select class="form-control" id="frm-status" name="ad_type">
                                                <option value="for_rent" {{ $estates->for_rent== 'for_rent' ? 'selected' : '' }}>للإجار</option>
                                                <option value="مفوض" {{ $estates->for_sell== 'for_sell'? 'selected' : '' }}>للبيع  </option>
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
                                            <input class="form-check-input" type="radio" name="price_negotiation" value="قابل للتفاوض"
                                                   id="flexRadioDefault1" {{ $estates->price_negotiation== 'قابل للتفاوض' ? 'checked' : ''}}>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                قابل للتفاوض
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="price_negotiation"
                                                   id="flexRadioDefault2" value="غير قابل للتفاوض" {{ $estates->price_negotiation== 'غير قابل للتفاوض' ? 'checked' : ''}}>
                                            <label class="form-check-label" for="flexRadioDefault2" >
                                                غير قابل للتفاوض
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
                                        <select  name="zone_id" id="choice_zones"  onchange="get_zone_data(this.value)" required class="form-control js-select2-custom"
                                                 data-placeholder="">
                                            @foreach(\App\Models\Zone::get() as $zone)
                                                <option value="{{$zone->id}}" {{$zone->id == $estates->zone_id?'selected':''}}>{{$zone->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="latitude">خط الطول</label>
                                        <input type="text" id="latitude" name="latitude" class="form-control"
                                               placeholder="Ex : -94.22213" value="{{ $estates->latitude }}" required readonly>
                                    </div>


                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="longitude">خط العرض</label>
                                        <input type="text" name="longitude" class="form-control" placeholder=""
                                               id="longitude" value="{{ $estates->longitude }}" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="city">المدينة</label>
                                        <input type="text" id="city" name="city" class="form-control"
                                               placeholder="" value="{{$estates->city}}" required readonly>
                                    </div>


                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="districts">الحي</label>
                                        <input type="text" id="districts" name="districts" class="form-control"
                                               placeholder="" value="{{$estates->districts}}" required readonly>
                                    </div>


                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="address">العنوان</label>
                                        <input type="text" name="address" class="form-control" placeholder=""
                                               id="address" value="{{$estates->address}}" required readonly>
                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="national_address">العنوان الوطني</label>
                                        <input type="text" name="national_address" class="form-control" placeholder=""
                                               id="national_address" value="{{ $estates->national_address}}" required readonly>
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

                                        <option value="سنة" {{ $estates->age_estate== 'سنة' ? 'selected' : '' }}></option>
                                        <option value="سنتين" {{ $estates->age_estate== 'سنتين' ? 'selected' : '' }}></option>
                                        <option value="3 سنوان" {{ $estates->age_estate== '3 سنوات' ? 'selected' : '' }}>3 سنوات</option>
                                        <option value="4 سنوات" {{ $estates->age_estate== '4 سنوات' ? 'selected' : '' }}>4 سنوات</option>
                                        <option value="5 سنوات" {{ $estates->age_estate== '5 سنوات' ? 'selected' : '' }}>5 سنوات</option>
                                        <option value="6 سنوات" {{ $estates->age_estate== '6 سنوات' ? 'selected' : '' }}>6 سنوات</option>
                                        <option value="7 سنوات" {{ $estates->age_estate== '7 سنوات' ? 'selected' : '' }}>7 سنوات</option>
                                        <option value="8 سنوات" {{ $estates->age_estate== '8 سنوات' ? 'selected' : '' }}>8 سنوات</option>
                                        <option value="9 سنوات" {{ $estates->age_estate== '9 سنوات' ? 'selected' : '' }}>9 سنوات</option>
                                        <option value="10 سنوات" {{ $estates->age_estate== '10 سنوات' ? 'selected' : '' }}>10 سنوات</option>
                                        <option value="11 سنوات" {{ $estates->age_estate== '11 سنوات' ? 'selected' : '' }}>11 سنوات</option>
                                        <option value="15+" {{ $estates->age_estate== '15+' ? 'selected' : '' }}>15+</option>
                                        <option value="20+" {{ $estates->age_estate== '20+' ? 'selected' : '' }}></option>
                                        <option value="25+" {{ $estates->age_estate== '25+' ? 'selected' : '' }}>25+</option>
                                        <option value="30+" {{ $estates->age_estate== '30+' ? 'selected' : '' }}>30+</option>


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
                                    <input  id="employee_search"  maxlength="10"  value='{{$estates->users->phone}}' required name="phone" type="text" class="form-control">
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">اسم العميل </label>
                                    <input required name="name" value='{{$estates->users->name}}' id="job_number" type="text" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">مميزات</h4>


                                <div class="mb-3">
                                    <label class="form-label">رابط التجوال الإفتراضي</label>
                                    <input     value='{{$estates->ar_path}}'  name="ar_path" type="text" class="form-control">
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
        </form>
    </div>
</div>
</div>
@endsection


@section('scripts')

<script>
    $(".select-item").select2({
      tags: true
     });
</script>

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

    <script src="{{ asset('assets/js/spartan-multi-image-picker.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'identity_image[]',
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
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa4Ng7nNB5EkPqvcI1yaxcl8QE1Ja-tPA&callback=initMap&v=3.45.8"></script>
<script>
    let myLatlng = { lat: {{$estates->latitude}}, lng: {{$estates->longitude}} };
    const map = new google.maps.Map(document.getElementById("map"), {
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
        new google.maps.Marker({
            position: { lat: {{$estates->latitude}}, lng: {{$estates->longitude}} },
            map,
            title: "{{$estates->name}}",
        });
        infoWindow.open(map);
    }
    initMap();
    function get_zone_data(id)
    {
        $.get({
            url: '{{ url('/') }}/zone/get-coordinates/' + id,
            dataType: 'json',
            success: function (data) {
                if(zonePolygon)
                {
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
                map.setCenter(data.center);
                google.maps.event.addListener(zonePolygon, 'click', function (mapsMouseEvent) {
                    infoWindow.close();
                    // Create a new InfoWindow.
                    infoWindow = new google.maps.InfoWindow({
                        position: mapsMouseEvent.latLng,
                        content: JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
                    });
                    var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
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
    }
    $(document).on('ready', function (){
        var id = $('#choice_zones').val();
        $.get({
            url: '{{url('/')}}/admin/zone/get-coordinates/'+id,
            dataType: 'json',
            success: function (data) {
                if(zonePolygon)
                {
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
                google.maps.event.addListener(zonePolygon, 'click', function (mapsMouseEvent) {
                    infoWindow.close();
                    // Create a new InfoWindow.
                    infoWindow = new google.maps.InfoWindow({
                        position: mapsMouseEvent.latLng,
                        content: JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
                    });
                    var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                    var coordinates = JSON.parse(coordinates);

                    document.getElementById('latitude').value = coordinates['lat'];
                    document.getElementById('longitude').value = coordinates['lng'];
                    infoWindow.open(map);
                });
            },
        });
    });
    get_zone_data({{$estates->zone_id}});
</script>

@endsection
