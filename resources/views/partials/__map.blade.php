@section('scripts')
{{-- AIzaSyATIrJEGnTxKsXhTUl3Jl4ocA403iOyNYM --}}
<script src="https://maps.googleapis.com/maps/api/js?key={{\App\Models\BusinessSetting::where(['type' => 'map_api_key'])->first()}}"></script>
<script>
    function status_form_alert(id, message, e) {
        e.preventDefault();
        Swal.fire({
            title: "are_you_sure",
            text: message,
            type: 'warning',
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonColor: 'var(--secondary-clr)',
            confirmButtonColor: 'var(--primary-clr)',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#'+id).submit()
            }
        })
    }
    auto_grow();
    function auto_grow() {
        let element = document.getElementById("coordinates");
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }

</script>
<script>
    $(document).on('ready', function () {
        // $('#zone_wise_delivery_fee').on('change', function(){
        //     if($("#zone_wise_delivery_fee").is(':checked')){
        //         $('.shipping_input').removeAttr('readonly');
        //         $('.shipping_input').attr('required', 'required');
        //         $('.shipping_input_group').show();
        //     } else {
        //         $('.shipping_input').attr('readonly', true);
        //         $('.shipping_input').removeAttr('required');
        //         $('.shipping_input').val('');
        //         $('.shipping_input_group').hide();
        //     }
        // })
        // INITIALIZATION OF DATATABLES
        // =======================================================
        var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

        $('#column1_search').on('keyup', function () {
            datatable
                .columns(1)
                .search(this.value)
                .draw();
        });


        $('#column3_search').on('change', function () {
            datatable
                .columns(2)
                .search(this.value)
                .draw();
        });


        // INITIALIZATION OF SELECT2
        // =======================================================
        $('.js-select2-custom').each(function () {
            var select2 = $.HSCore.components.HSSelect2.init($(this));
        });
    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa4Ng7nNB5EkPqvcI1yaxcl8QE1Ja-tPA&libraries=drawing,places&v=3.45.8"></script>

<script>
    var map; // Global declaration of the map
    var drawingManager;
    var lastpolygon = null;
    var polygons = [];

    function resetMap(controlDiv) {
        // Set CSS for the control border.
        const controlUI = document.createElement("div");
        controlUI.style.backgroundColor = "#fff";
        controlUI.style.border = "2px solid #fff";
        controlUI.style.borderRadius = "3px";
        controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
        controlUI.style.cursor = "pointer";
        controlUI.style.marginTop = "8px";
        controlUI.style.marginBottom = "22px";
        controlUI.style.textAlign = "center";
        controlUI.title = "Reset map";
        controlDiv.appendChild(controlUI);
        // Set CSS for the control interior.
        const controlText = document.createElement("div");
        controlText.style.color = "rgb(25,25,25)";
        controlText.style.fontFamily = "Roboto,Arial,sans-serif";
        controlText.style.fontSize = "10px";
        controlText.style.lineHeight = "16px";
        controlText.style.paddingLeft = "2px";
        controlText.style.paddingRight = "2px";
        controlText.innerHTML = "X";
        controlUI.appendChild(controlText);
        // Setup the click event listeners: simply set the map to Chicago.
        controlUI.addEventListener("click", () => {
            lastpolygon.setMap(null);
            $('#coordinates').val('');

        });
    }

    function initialize() {
        @php
        $default_location['lat'] = '23.757989';
        $default_location['lng'] = '90.360587';
        @endphp
        var myLatlng = { lat: {{$default_location?$default_location['lat']:'23.757989'}}, lng: {{$default_location?$default_location['lng']:'90.360587'}} };


        var myOptions = {
            zoom: 13,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            },
            polygonOptions: {
                editable: true
            }
        });
        drawingManager.setMap(map);


        //get current location block
        // infoWindow = new google.maps.InfoWindow();
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    map.setCenter(pos);
                });
        }

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            if(lastpolygon)
            {
                lastpolygon.setMap(null);
            }
            $('#coordinates').val(event.overlay.getPath().getArray());
            lastpolygon = event.overlay;
            auto_grow();
        });

        const resetDiv = document.createElement("div");
        resetMap(resetDiv, lastpolygon);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);

        // Create the search box and link it to the UI element.
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });
        let markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
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

    google.maps.event.addDomListener(window, 'load', initialize);


    function set_all_zones()
    {
        $.get({
            url: '',
            dataType: 'json',
            success: function (data) {

                console.log(data);
                for(var i=0; i<data.length;i++)
                {
                    polygons.push(new google.maps.Polygon({
                        paths: data[i],
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "#FF0000",
                        fillOpacity: 0.1,
                    }));
                    polygons[i].setMap(map);
                }

            },
        });
    }
    $(document).on('ready', function(){
        set_all_zones();
    });

</script>
<script>
    $('#search-form').on('submit', function () {
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: '',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                $('#set-rows').html(data.view);
                $('#itemCount').html(data.total);
                $('.page-area').hide();
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    });
</script>
<script>
    $('#reset_btn').click(function(){
        $('#name').val(null);
        $('#minimum_delivery_charge').val(null);
        $('#delivery_charge_per_km').val(null);

        lastpolygon.setMap(null);
        $('#coordinates').val(null);
    })
</script>
@endsection
