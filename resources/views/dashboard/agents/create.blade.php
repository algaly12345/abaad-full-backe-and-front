@extends('layouts.admin')


@section('title','المسوقين')

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

<div class="card" >
    <div class="card-body">

        <h4 class="card-title">أنشاء مسوق جديد</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('agents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-6">

                    <div class="mb-3">
                        <label class="form-label">أسم  المسوق</label>
                        @error('name')

                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">

                            <input type="text" name="name" class="form-control"/ >

                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">كلمة المرور</label>
                        @error('password')

                        <span class="error-message">
                            {{ $message }}
                        </span>
                         @enderror
                    <div class="input-group">

                            <input type="password" name="password" class="form-control"/ >

                        </div>
                        <!-- input-group -->
                    </div>


                    {{-- this vue area --}}
                    <div id="app">
                        <div class="mb-3">
                            <label class="form-label">نوع المسوق</label>
                            @error('name')

                            <span class="error-message">
                                {{ $message }}
                            </span>
                       @enderror
                            <div class="input-group">


                                <select name="agent_type"  class="form-control" id="" @change="selectAgentType($event)">
                                     <option value=""></option>
                                    <option value="مكتب عقاري">
                                        مكتب عقاري
                                    </option>
                                    <option value="شركة عقارية">
                                         شركة عقارية
                                    </option>
                                    <option value="فرد">
                                          فرد
                                    </option>
                                </select>
                            </div>

                            <!-- input-group -->
                        </div>
                        <div class="mb-3" v-if="officeOrInstitution">
                            <label class="form-label">رقم السجل التجاري </label>
                            @error('commercial_registerion_no')

                            <span class="error-message">
                                {{ $message }}
                            </span>
                             @enderror
                        <div class="input-group">

                                <input type="text" name="commercial_registerion_no" class="form-control"/ >

                            </div>
                            <!-- input-group -->
                        </div>

                        <div class="mb-3" v-if="individual">
                            <label class="form-label">رقم الهوية</label>
                            @error('ideintity')

                            <span class="error-message">
                                {{ $message }}
                            </span>
                       @enderror
                            <div class="input-group">

                                <input type="text" name="ideintity" class="form-control"/ >

                            </div>
                            <!-- input-group -->
                        </div>
                    </div>






                    <div class="mb-3">
                        <label class="form-label">الصورة </label>
                        @error('image')

                        <span class="error-message">
                            {{ $message }}
                        </span>
                         @enderror
                    <div class="input-group">

                            <input type="file" name="image" class="form-control"/ >

                        </div>
                        <!-- input-group -->
                    </div>


                </div>

                <div class="col-lg-6">



                    <div class="mb-3">
                        <label class="form-label">رقم الجوال</label>
                        @error('phone')

                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">

                            <input type="tel" name="phone" class="form-control"/ >

                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">البريد الالكتروني</label>
                        @error('email')

                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">

                            <input type="text" name="email" class="form-control"/ >

                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="choice_zones">أختار المنطقه</label>
                                <select name="zone_id" id="choice_zones" required class="form-control js-select2-custom"
                                    data-placeholder=""">
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
                                <input type="text" name="longitude" class="form-control" placeholder="Ex : 103.344322"
                                    id="longitude" value="{{ old('longitude') }}" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 mt-4">
                        <input id="pac-input" class="controls rounded" style="height: 3em;width:fit-content;" title="{{__('messages.search_your_location_here')}}" type="text" placeholder="{{__('messages.search_here')}}"/>
                        <div id="map"></div>
                    </div>










                </div>


            </div>
            <button class="btn btn-primary btn-lg" type="submit">حفظ</button>
        </form>
    </div>
</div>

@endsection



@section('scripts')

<script>
    new Vue({
        el:'#app',
        data:{
            officeOrInstitution:false,
            individual:false
        },

        methods:{
            selectAgentType(event){
               if(event.target.value == 'مكتب عقاري' ||event.target.value == 'شركة عقارية'){
                this.officeOrInstitution = true
                this.individual = false
               }else{
                this.individual = true
                this.officeOrInstitution = false
               }
            }
        }

    })
</script>


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

    <script src="{{ asset('assets/admin/js/spartan-multi-image-picker.js') }}"></script>
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
                    });
                },
            });
        });
    </script>


@endsection
