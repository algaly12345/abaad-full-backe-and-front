<!--@extends('layouts.front-end.app')-->

<!--@section('title', translate('map'))-->
<!--@section('content')-->
<!--<style>-->
<!--.price-label {-->
    background-color: #003366; /* Default navy background color */
<!--    padding: 2px 5px;-->
<!--    border-radius: 5px;-->
    border: 1px solid #FFFFFF; /* White border */
    white-space: nowrap; /* Prevent text from wrapping */
<!--}-->

<!--.price-label-selected {-->
    background-color: #FF6600; /* Orange color for the selected marker */
<!--}-->

<!--</style>-->




<!--    <div class="py-4 rtl __inline-56 px-0 px-md-3 text-align-direction">-->




<!--        <div class="row mx-max-md-0" style="position: relative;">-->
            <!-- خريطة -->
<!--            <div id="map" style="height: 650px; width: 100%;"></div>-->

            <!-- أقسام -->
<!--            <div style="position: absolute; top: 10px; left: 0; right: 0; z-index: 1; overflow-x: auto; white-space: nowrap;">-->
<!--                <div id="categories-container" class="d-flex flex-nowrap">-->
<!--                    <button id="show-all" class="btn" style="background-color: white; color: black; padding: 10px 20px; margin-right: 10px;">الكل</button> <!-- زر أبيض -->-->
<!--                </div>-->
<!--            </div>-->

            <!-- تحميل -->
<!--            <div id="loading" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1; display: none;">جاري التحميل...</div>-->

            <!-- رسالة خطأ -->
<!--            <div id="error-message" style="color: red; text-align: center; margin-top: 10px;"></div>-->

      <!-- تفاصيل العقار -->
<!--      <div id="estate-details" class="w-100" style="position: absolute; bottom: 10px; left: 0; right: 0; z-index: 1; background-color: rgba(255, 255, 255, 0.9); padding: 15px; border-radius: 8px; max-height: 200px; overflow-y: auto; display: none; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);">-->
<!--        <div class="d-flex align-items-start" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }};">-->
<!--            <div class="flex-shrink-0">-->
<!--                <img id="estate-image" src="" alt="Estate Image" style="width: 120px; height: 80px; object-fit: cover; border-radius: 5px; margin: {{ app()->getLocale() == 'ar' ? '0 0 0 15px' : '0 15px 0 0' }};">-->
<!--            </div>-->
<!--            <div class="flex-grow-1" style="text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};">-->
<!--                <h3 id="estate-title" style="font-size: 18px; margin: 0; color: #003366;"></h3>-->
<!--                <div id="estate-rating" class="my-1"></div>-->
<!--                <p id="estate-description" style="font-size: 14px; color: #333; margin: 0;"></p>-->
<!--                <p id="estate-price" style="font-size: 16px; font-weight: bold; color: #d9534f; margin: 0;"></p>-->
<!--                {{-- <button id="back-to-list" class="btn" style="background-color: #003366; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px;">العودة إلى القائمة</button> --}}-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->




<!--        </div>-->







<!--    </div>-->






<!-- مودال لعرض تفاصيل العقار -->
<!--<div id="estate-full-details-modal" class="modal fade modal-fullscreen" tabindex="-1" role="dialog">-->
<!--    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen" role="document">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title" id="estate-title"></h5>-->
<!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--            </div>-->
<!--            <div class="modal-body" id="estate-full-details">-->
                <!-- سيتم إدراج تفاصيل العقار هنا -->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->





<!--<div class="modal fade" id="offers-dialog" tabindex="-1" role="dialog" aria-labelledby="offersDialogLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog" role="document">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title" id="offersDialogLabel">عروض الخدمة</h5>-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                    <span aria-hidden="true">&times;</span>-->
<!--                </button>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
                <!-- Content will be inserted here -->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<!--@endsection-->

<!--@push('script')-->
<!--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4&language=ar"></script>-->
<!--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->

<!--    <script>-->

<!--$(document).ready(function() {-->
<!--    var map = new google.maps.Map(document.getElementById('map'), {-->
<!--        center: {lat: 24.7136, lng: 46.6753},-->
<!--        zoom: 5,-->
<!--        gestureHandling: 'none',-->
<!--        disableDefaultUI: true,-->
<!--        scrollwheel: false,-->
<!--        disableDoubleClickZoom: true-->
<!--    });-->

<!--    var markers = [];-->
<!--    var currentZoneId = null;-->
<!--    var zoneMarkers = [];-->
<!--    var bounds = new google.maps.LatLngBounds();-->

<!--    function showLoading() {-->
<!--        $('#loading').show();-->
<!--    }-->

<!--    function hideLoading() {-->
<!--        $('#loading').hide();-->
<!--    }-->

<!--    function loadZones() {-->
<!--    showLoading();-->
<!--    $.ajax({-->
<!--        url: `{{ url('/api/v1/zones') }}`,-->
<!--        method: 'GET',-->
<!--        success: function(data) {-->
<!--            clearMarkers(zoneMarkers);-->
<!--            bounds = new google.maps.LatLngBounds();-->
<!--            if (!data || data.length === 0) {-->
<!--                $('#error-message').text('لم يتم العثور على أي مناطق.');-->
<!--                hideLoading();-->
<!--                return;-->
<!--            }-->
<!--            data.forEach(function(zone) {-->
<!--                var svgIcon = {-->
<!--                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="30">-->
                          <!-- زر -->
<!--                          <rect x="0" y="0" width="100" height="30" rx="15" ry="15" fill="#003366" />-->

                          <!-- نص المنطقة -->
<!--                          <text x="10" y="20" font-family="Arial" font-size="12" fill="white" font-weight="bold">${zone.name_ar}</text>-->

                          <!-- عدد العقارات -->
<!--                          <rect x="70" y="5" width="25" height="20" rx="10" ry="10" fill="#FFFFFF" />-->
<!--                          <text x="82" y="20" font-family="Arial" font-size="12" fill="#003366" font-weight="bold" text-anchor="middle">${zone.estate_count}</text>-->
<!--                        </svg>-->
<!--                    `),-->
                    scaledSize: new google.maps.Size(100, 30), // حجم الأيقونة المصغرة
                    anchor: new google.maps.Point(50, 15) // نقطة الارتكاز للعلامة
<!--                };-->

<!--                var marker = new google.maps.Marker({-->
<!--                    position: { lat: parseFloat(zone.latitude), lng: parseFloat(zone.longitude) },-->
<!--                    map: map,-->
<!--                    icon: svgIcon,-->
<!--                    title: `${zone.name_ar} - ${zone.property_count} عقارات`-->
<!--                });-->

<!--                marker.addListener('click', function() {-->
<!--                    map.setCenter(marker.getPosition());-->
<!--                    map.setZoom(10);-->
<!--                    currentZoneId = zone.id;-->
<!--                    $('#categories-container').show();-->
<!--                    clearMarkers(zoneMarkers);-->
<!--                    loadCategories(zone.id);-->

<!--                    map.setOptions({-->
<!--                        gestureHandling: 'greedy',-->
<!--                        scrollwheel: true,-->
<!--                        disableDoubleClickZoom: false-->
<!--                    });-->
<!--                });-->

<!--                zoneMarkers.push(marker);-->
<!--                bounds.extend(marker.getPosition());-->
<!--            });-->
<!--            hideLoading();-->
<!--            map.fitBounds(bounds);-->
<!--        },-->
<!--        error: function(jqXHR, textStatus, errorThrown) {-->
<!--            $('#error-message').text('خطأ في جلب المناطق: ' + textStatus + ' - ' + errorThrown);-->
<!--            hideLoading();-->
<!--        }-->
<!--    });-->
<!--}-->





<!--    function loadCategories(zoneId) {-->
<!--        showLoading();-->
<!--        $.ajax({-->
<!--            url: '{{ url("/api/v1/categories") }}',-->
<!--            method: 'GET',-->
<!--            success: function(data) {-->
<!--                $('#categories-container').empty();-->
<!--                $('#categories-container').append(`<button id="show-all" class="btn" style="background-color: white; color: black; padding: 10px 20px; margin-right: 10px;">الكل</button>`);-->
<!--                if (!data || data.length === 0) {-->
<!--                    $('#error-message').text('لم يتم العثور على أي فئات.');-->
<!--                    hideLoading();-->
<!--                } else {-->
<!--                    data.forEach(function(category) {-->
<!--                        $('#categories-container').append(`<button class="btn category-button" data-id="${category.id}" data-zone="${zoneId}" style="background-color: white; color: black; padding: 8px 15px; margin-right: 10px;">${category.name_ar}</button>`);-->
<!--                    });-->

<!--                    $('.category-button').on('click', function() {-->
<!--                        var categoryId = $(this).data('id');-->
<!--                        var zoneId = $(this).data('zone');-->
                        $('.category-button').css('background-color', 'white').css('color', 'black'); // Reset other buttons
                        $('#show-all').css('background-color', 'white').css('color', 'black'); // Reset "All" button
                        $(this).css('background-color', '#003366').css('color', 'white'); // Highlight clicked button
                        $('#estate-details').hide(); // Hide estate details when switching categories
<!--                        loadEstates(categoryId, zoneId);-->
<!--                    });-->

<!--                    $('#show-all').on('click', function() {-->
                        $('.category-button').css('background-color', 'white').css('color', 'black'); // Reset other buttons
                        $(this).css('background-color', '#003366').css('color', 'white'); // Highlight "All" button
                        $('#estate-details').hide(); // Hide estate details when selecting "All"
<!--                        loadEstates(0, zoneId);-->
<!--                    });-->
<!--                }-->
<!--            },-->
<!--            error: function(jqXHR, textStatus, errorThrown) {-->
<!--                $('#error-message').text('خطأ في جلب الفئات: ' + textStatus + ' - ' + errorThrown);-->
<!--                hideLoading();-->
<!--            }-->
<!--        });-->
<!--    }-->

    var currentInfoWindow = null; // Variable to keep track of the current InfoWindow





<!--    var currentSelectedMarker = null;-->
var estates = []; // Ensure this array is globally accessible
<!--function loadEstates(categoryId, zoneId) {-->
<!--    showLoading();-->
<!--    $.ajax({-->
<!--        url: `{{ url('/api/v1/estate/get-estate/all') }}?category_id=${categoryId}&zone_id=${zoneId}`,-->
<!--        method: 'GET',-->
<!--        success: function(data) {-->
<!--            clearMarkers(markers);-->
<!--            if (!data || !data.estate || data.estate.length === 0) {-->
<!--                $('#error-message').text('لم يتم العثور على أي عقارات.');-->
<!--                $('#estate-details').hide();-->
<!--                hideLoading();-->
<!--                return;-->
<!--            }-->

            estates = data.estate; // Populate the global estates array

<!--            var firstEstatePosition = null;-->
<!--            data.estate.forEach(function(estate, index) {-->
<!--                var imageUrl = '{{ asset("storage/app/public/estate/") }}/' + estate.images[0];-->
<!--                var defaultImageUrl = '{{ asset("public/assets/images/default-estate.jpg") }}';-->

                // Log URLs for debugging
<!--                console.log('Image URL:', imageUrl);-->
<!--                console.log('Default Image URL:', defaultImageUrl);-->

                // Verify if the image exists
<!--                var img = new Image();-->
<!--                img.onload = function() {-->
<!--                    processEstate(imageUrl, estate);-->
<!--                };-->
<!--                img.onerror = function() {-->
<!--                    console.warn('Image not found, using default:', imageUrl);-->
<!--                    processEstate(defaultImageUrl, estate);-->
<!--                };-->
<!--                img.src = imageUrl;-->

<!--                function processEstate(imageToUse, estate) {-->
<!--                    var hasOffer = estate.service_offers && estate.service_offers.length > 0;-->
<!--                    createCustomMarker(imageToUse, function(customIconUrl) {-->
<!--                        var marker = new google.maps.Marker({-->
<!--                            position: { lat: parseFloat(estate.latitude), lng: parseFloat(estate.longitude) },-->
<!--                            map: map,-->
<!--                            title: estate.title,-->
<!--                            icon: {-->
<!--                                url: customIconUrl,-->
<!--                                scaledSize: new google.maps.Size(60, 60),-->
<!--                                labelOrigin: new google.maps.Point(30, -10)-->
<!--                            },-->
<!--                            label: {-->
<!--                                text: estate.price.toString() + ' SAR',-->
<!--                                color: '#FFFFFF',-->
<!--                                fontSize: '12px',-->
<!--                                fontWeight: 'bold',-->
<!--                                className: 'price-label'-->
<!--                            }-->
<!--                        });-->

<!--                        markers.push(marker);-->

<!--                        var infoWindow = new google.maps.InfoWindow();-->

<!--                        google.maps.event.addListener(marker, 'click', function() {-->
<!--                            if (currentInfoWindow) {-->
<!--                                currentInfoWindow.close();-->
<!--                            }-->

                            // Reset the icon of the previously selected marker
<!--                            if (currentSelectedMarker) {-->
<!--                                createCustomMarker(imageToUse, function(originalIconUrl) {-->
<!--                                    currentSelectedMarker.setIcon({-->
<!--                                        url: originalIconUrl,-->
<!--                                        scaledSize: new google.maps.Size(60, 60),-->
<!--                                        labelOrigin: new google.maps.Point(30, -10)-->
<!--                                    });-->
<!--                                }, false, hasOffer);-->
<!--                            }-->

                            // Set the icon of the currently selected marker to red
<!--                            createCustomMarker(imageToUse, function(selectedIconUrl) {-->
<!--                                marker.setIcon({-->
<!--                                    url: selectedIconUrl,-->
<!--                                    scaledSize: new google.maps.Size(60, 60),-->
<!--                                    labelOrigin: new google.maps.Point(30, -10)-->
<!--                                });-->
<!--                            }, true, hasOffer);-->

<!--                            currentSelectedMarker = marker;-->

<!--                            let offersHtml = '';-->
<!--                            if (hasOffer) {-->
<!--                                offersHtml = `-->
<!--                                    <button onclick="toggleOffers(${estate.id})" class="btn btn-primary">-->
<!--                                        <img src="{{ asset('public/assets/images/offers-icon.png') }}" alt="Offers" style="width: 20px; height: 20px;">-->
<!--                                    </button>-->
<!--                                `;-->
<!--                            }-->

<!--                            var contentString = `-->
<!--                                <div>-->
<!--                                    <img src="${imageToUse}" alt="${estate.title}" style="width: 120px; height: 80px; object-fit: cover; border-radius: 5px;">-->
<!--                                    <h3>${estate.title}</h3>-->
<!--                                    <p>${estate.short_description}</p>-->
<!--                                    <p>السعر: ${estate.price}</p>-->
<!--                                    ${offersHtml}-->
<!--                                    <div id="offers-${estate.id}" class="offers-list" style="display: none;"></div>-->
<!--                                </div>-->
<!--                            `;-->

<!--                            infoWindow.setContent(contentString);-->
<!--                            infoWindow.open(map, marker);-->

<!--                            currentInfoWindow = infoWindow;-->

<!--                            $('#estate-details').show();-->
<!--                            $('#estate-title').text(estate.title);-->
<!--                            $('#estate-description').text(estate.short_description);-->
<!--                            $('#estate-price').text('السعر: ' + estate.price);-->
                            $('#estate-image').attr('src', imageToUse); // Update the image source
<!--                            $('#estate-details').data('estate-id', estate.id);-->

<!--                            map.setCenter(marker.getPosition());-->
<!--                            map.setZoom(15);-->
<!--                        });-->

                        // Set the first estate and center the map
<!--                        if (index === 0) {-->
<!--                            firstEstatePosition = { lat: parseFloat(estate.latitude), lng: parseFloat(estate.longitude) };-->

                            // Simulate a click on the first estate to zoom in on it
<!--                            google.maps.event.trigger(marker, 'click');-->
<!--                        }-->
<!--                    }, false, hasOffer);-->
<!--                }-->
<!--            });-->

<!--            if (firstEstatePosition !== null) {-->
<!--                map.setCenter(firstEstatePosition);-->
<!--                map.setZoom(15);-->
<!--            }-->

<!--            $('#error-message').empty();-->
<!--            hideLoading();-->
<!--        },-->
<!--        error: function(jqXHR, textStatus, errorThrown) {-->
<!--            $('#error-message').text('خطأ في جلب العقارات: ' + textStatus + ' - ' + errorThrown);-->
<!--            hideLoading();-->
<!--        }-->
<!--    });-->
<!--}-->



<!--function createCustomMarker(estateImageUrl, callback, isSelected, hasOffer) {-->
<!--    const canvas = document.createElement('canvas');-->
<!--    const context = canvas.getContext('2d');-->
<!--    const markerImage = new Image();-->
<!--    const estateImage = new Image();-->

<!--    canvas.width = 60;-->
<!--    canvas.height = 60;-->

    // تحديد مسار الصورة بناءً على ما إذا كان الـ marker تم اختياره أم لا
<!--    let markerImageUrl = isSelected-->
<!--        ? '{{ asset("public/assets/images/marker-selected.png") }}'-->
<!--        : '{{ asset("public/assets/images/marker.png") }}';-->

    // إذا كان العقار يحتوي على عروض خدمة، استخدم العلامة الذهبية
<!--    if (hasOffer) {-->
<!--        markerImageUrl = '{{ asset("public/assets/images/marker-gold.png") }}';-->
<!--    }-->

<!--    markerImage.src = markerImageUrl;-->

<!--    markerImage.onerror = function() {-->
<!--        console.error('Error loading marker image');-->
        // يمكن إضافة معالجة للخطأ هنا، مثل تعيين صورة افتراضية للـ marker
<!--    };-->

<!--    markerImage.onload = function() {-->
<!--        context.drawImage(markerImage, 0, 0, canvas.width, canvas.height);-->

<!--        estateImage.src = estateImageUrl;-->

<!--        estateImage.onerror = function() {-->
<!--            console.error('Error loading estate image');-->
            // إذا فشلت الصورة في التحميل، استخدم صورة افتراضية
<!--            estateImage.src = '{{ asset("public/assets/images/default-estate.png") }}';-->
<!--        };-->

<!--        estateImage.onload = function() {-->
<!--            const estateImageSize = 30;-->
<!--            const estateImageX = (canvas.width - estateImageSize) / 2;-->
<!--            const estateImageY = (canvas.height - estateImageSize) / 2 - 8;-->

<!--            context.save();-->
<!--            context.beginPath();-->
<!--            context.arc(estateImageX + estateImageSize / 2, estateImageY + estateImageSize / 2, estateImageSize / 2, 0, Math.PI * 2, true);-->
<!--            context.closePath();-->
<!--            context.clip();-->

<!--            context.drawImage(estateImage, estateImageX, estateImageY, estateImageSize, estateImageSize);-->

<!--            context.restore();-->

<!--            callback(canvas.toDataURL());-->
<!--        };-->
<!--    };-->
<!--}-->


<!--function toggleOffers(estateId) {-->
<!--    const estate = estates.find(e => e.id === estateId);-->

<!--    if (!estate || !estate.service_offers || estate.service_offers.length === 0) {-->
        return; // No offers to display
<!--    }-->

<!--    const offersList = document.getElementById(`offers-${estateId}`);-->
<!--    if (offersList.style.display === 'none') {-->
<!--        let offersHtml = '<ul>';-->
<!--        estate.service_offers.forEach(offer => {-->
<!--            offersHtml += `-->
<!--                <li>-->
<!--                    <img src="{{ asset('storage/') }}/${offer.image}" alt="${offer.title}" style="width: 100px; height: auto;">-->
<!--                    <h5>${offer.title}</h5>-->
<!--                    <p>الوصف: ${offer.description}</p>-->
<!--                    <p>السعر: ${offer.service_price ? offer.service_price : 'غير محدد'}</p>-->
<!--                    <p>تاريخ انتهاء العرض: ${offer.expiry_date}</p>-->
<!--                    <p>خصم: ${offer.discount}%</p>-->
<!--                    <p>رقم الهاتف: ${offer.phone_provider}</p>-->
<!--                </li>`;-->
<!--        });-->
<!--        offersHtml += '</ul>';-->

<!--        offersList.innerHTML = offersHtml;-->
<!--        offersList.style.display = 'block';-->
<!--    } else {-->
<!--        offersList.style.display = 'none';-->
<!--    }-->
<!--}-->


<!--$(document).ready(function() {-->
<!--    $('#back-to-list').click(function() {-->
<!--        $('#estate-details').hide();-->
<!--    });-->

<!--    $('#estate-details').on('click', function() {-->
<!--        var estateId = $(this).data('estate-id');-->
<!--        if (estateId) {-->
<!--            getEstateDetails(estateId);-->
<!--        }-->
<!--    });-->
<!--});-->

<!--function getEstateDetails(estateId) {-->
    // توجيه المستخدم إلى صفحة تفاصيل العقار
<!--    window.location.href = `{{ url('/details') }}/${estateId}`;-->
<!--}-->




<!-- function clearMarkers(markerArray) {-->
<!--        markerArray.forEach(function(marker) {-->
<!--            marker.setMap(null);-->
<!--        });-->
<!--        markerArray.length = 0;-->
<!--    }-->

<!--    map.addListener('zoom_changed', function() {-->
<!--        var currentZoom = map.getZoom();-->
<!--        if (currentZoom <= 5) {-->
<!--            $('#categories-container').hide();-->
            $('#estate-details').hide(); // Hide estate details on zoom out
<!--            clearMarkers(markers);-->
<!--            loadZones();-->

<!--            map.setOptions({-->
<!--                gestureHandling: 'none',-->
<!--                scrollwheel: false,-->
<!--                disableDoubleClickZoom: true-->
<!--            });-->
<!--        }-->
<!--    });-->

<!--    $('#back-to-list').on('click', function() {-->
<!--        $('#estate-details').hide();-->
<!--    });-->

<!--    loadZones();-->
<!--});-->





<!--    </script>-->


<!--@endpush-->




@extends('layouts.front-end.app')

@section('title', translate('map'))

@push('css_or_js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap');

*{ box-sizing:border-box; margin:0; padding:0; }

:root{
    --pri:#114b89;
    --pri-dark:#0c3c6d;
    --sec:#0f5bd7;
    --acc:#ffd166;
    --danger:#ef4444;
    --success:#22c55e;
    --bg:#f4f7fb;
    --card:#ffffff;
    --text:#0f172a;
    --muted:#64748b;
    --line:#e5e7eb;
    --shadow-lg:0 24px 60px rgba(15,23,42,.16);
    --shadow-md:0 12px 30px rgba(15,23,42,.10);
    --shadow-sm:0 6px 18px rgba(15,23,42,.08);
    --radius-xl:24px;
    --radius-lg:18px;
    --radius-md:14px;
    --radius-sm:10px;
    --glass:rgba(255,255,255,.92);
    --glass-border:rgba(255,255,255,.7);
}

body{
    font-family:'Cairo','Segoe UI',sans-serif;
    background:var(--bg);
    color:var(--text);
    -webkit-font-smoothing:antialiased;
}

/* ══════════════════════════════
   MAP WRAPPER
══════════════════════════════ */
.map-page{ position:relative; height:100vh; overflow:hidden; }

#map{
    width:100%; height:100%;
    position:absolute; inset:0;
}

/* ══════════════════════════════
   TOP BAR — فلاتر الأقسام
══════════════════════════════ */
.map-topbar{
    position:absolute;
    top:16px; left:16px; right:16px;
    z-index:10;
    display:flex;
    flex-direction:column;
    gap:10px;
    pointer-events:none;
}

.map-search-row{
    display:flex;
    align-items:center;
    gap:10px;
    pointer-events:all;
}

.map-back-btn{
    width:46px; height:46px; border-radius:50%; border:none;
    background:var(--glass);
    backdrop-filter:blur(14px);
    -webkit-backdrop-filter:blur(14px);
    border:1.5px solid var(--glass-border);
    box-shadow:var(--shadow-md);
    color:var(--pri); font-size:16px;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; flex-shrink:0;
    transition:background .2s, transform .2s;
    text-decoration:none;
}
.map-back-btn:hover{ background:#fff; transform:scale(1.06); }

.map-title-pill{
    display:flex; align-items:center; gap:10px;
    background:var(--glass);
    backdrop-filter:blur(14px);
    -webkit-backdrop-filter:blur(14px);
    border:1.5px solid var(--glass-border);
    box-shadow:var(--shadow-md);
    border-radius:999px;
    padding:10px 18px;
    flex:1;
}
.map-title-pill i{ color:var(--sec); font-size:16px; }
.map-title-pill span{
    font-size:14px; font-weight:800; color:var(--text);
    font-family:'Cairo',sans-serif;
}

/* Categories scroll */
.map-cats-wrap{
    pointer-events:all;
    overflow-x:auto;
    padding-bottom:4px;
}
.map-cats-wrap::-webkit-scrollbar{ height:0; }
.map-cats-row{
    display:flex; gap:8px;
    width:max-content;
}

.map-cat-btn{
    border:none;
    background:var(--glass);
    backdrop-filter:blur(14px);
    -webkit-backdrop-filter:blur(14px);
    border:1.5px solid var(--glass-border);
    box-shadow:var(--shadow-sm);
    color:var(--text);
    border-radius:999px;
    padding:10px 18px;
    font-size:13px; font-weight:800;
    font-family:'Cairo',sans-serif;
    white-space:nowrap;
    cursor:pointer;
    transition:.22s ease;
}
.map-cat-btn:hover{
    background:#fff;
    border-color:rgba(15,91,215,.3);
}
.map-cat-btn.active{
    background:linear-gradient(135deg,var(--sec),var(--pri));
    color:#fff;
    border-color:transparent;
    box-shadow:0 8px 22px rgba(15,91,215,.28);
}

/* ══════════════════════════════
   LOADING OVERLAY
══════════════════════════════ */
#map-loading{
    position:absolute; top:50%; left:50%;
    transform:translate(-50%,-50%);
    z-index:20; display:none;
}
.map-loading-box{
    background:var(--glass);
    backdrop-filter:blur(16px);
    -webkit-backdrop-filter:blur(16px);
    border:1.5px solid var(--glass-border);
    border-radius:20px;
    box-shadow:var(--shadow-lg);
    padding:16px 22px;
    display:flex; align-items:center; gap:12px;
    font-weight:800; color:#334155;
    font-family:'Cairo',sans-serif; font-size:14px;
}
.map-loading-box .spinner-border{ width:22px; height:22px; border-width:2.5px; }

/* ══════════════════════════════
   ESTATE CARD — أسفل الشاشة
══════════════════════════════ */
#estate-details{
    position:absolute;
    bottom:16px; left:16px; right:16px;
    z-index:15;
    display:none;
    pointer-events:all;
}

.estate-card-map{
    background:var(--glass);
    backdrop-filter:blur(18px);
    -webkit-backdrop-filter:blur(18px);
    border:1.5px solid var(--glass-border);
    border-radius:var(--radius-xl);
    box-shadow:var(--shadow-lg);
    overflow:hidden;
    cursor:pointer;
    transition:transform .25s ease, box-shadow .25s ease;
    direction:rtl;
}
.estate-card-map:hover{
    transform:translateY(-3px);
    box-shadow:0 30px 70px rgba(15,23,42,.20);
}

.ecm-inner{
    display:flex; align-items:stretch; gap:0;
}

.ecm-img-wrap{
    width:120px; flex-shrink:0; position:relative; overflow:hidden;
}
.ecm-img-wrap img{
    width:100%; height:100%;
    object-fit:cover; display:block;
    transition:transform .4s ease;
}
.estate-card-map:hover .ecm-img-wrap img{ transform:scale(1.07); }

.ecm-img-badge{
    position:absolute; top:8px; right:8px;
    background:rgba(255,255,255,.88);
    border-radius:999px; padding:3px 8px;
    font-size:10px; font-weight:900;
    color:#0f172a;
    display:flex; align-items:center; gap:4px;
    backdrop-filter:blur(6px);
}

.ecm-body{
    flex:1; padding:14px 16px;
    display:flex; flex-direction:column; gap:8px;
}

.ecm-top{
    display:flex; align-items:flex-start;
    justify-content:space-between; gap:8px;
}

.ecm-title{
    font-size:15px; font-weight:900; color:var(--text);
    line-height:1.4; font-family:'Cairo',sans-serif;
}

.ecm-close{
    width:30px; height:30px; border-radius:50%; border:none;
    background:#f8fafc; color:var(--muted);
    display:flex; align-items:center; justify-content:center;
    font-size:12px; cursor:pointer; flex-shrink:0;
    transition:background .2s;
}
.ecm-close:hover{ background:#fee2e2; color:var(--danger); }

.ecm-address{
    font-size:12px; color:var(--muted); font-weight:600;
    display:flex; align-items:center; gap:5px;
    font-family:'Cairo',sans-serif;
}
.ecm-address i{ color:var(--sec); font-size:11px; }

.ecm-price-row{
    display:flex; align-items:center;
    justify-content:space-between; gap:8px;
    margin-top:auto;
}

.ecm-price{
    display:flex; align-items:center; gap:6px;
    background:linear-gradient(135deg,rgba(8,26,51,.94),rgba(12,49,91,.94));
    border-radius:12px; padding:8px 12px;
}
.ecm-price-num{
    font-size:14px; font-weight:900; color:#fff;
    font-family:'Cairo',sans-serif;
}
.ecm-price-curr{
    font-size:10px; color:rgba(255,255,255,.75);
    font-weight:700; font-family:'Cairo',sans-serif;
}

.ecm-view-btn{
    display:flex; align-items:center; gap:6px;
    background:linear-gradient(135deg,var(--sec),var(--pri));
    color:#fff; border:none; border-radius:12px;
    padding:8px 14px; font-size:12px; font-weight:800;
    font-family:'Cairo',sans-serif; cursor:pointer;
    box-shadow:0 8px 18px rgba(15,91,215,.24);
    text-decoration:none;
    transition:transform .2s, box-shadow .2s;
}
.ecm-view-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 24px rgba(15,91,215,.32);
    color:#fff;
}

/* ══════════════════════════════
   ZOOM CONTROLS — custom
══════════════════════════════ */
.map-zoom-controls{
    position:absolute;
    left:16px; bottom:50%;
    transform:translateY(50%);
    z-index:10;
    display:flex; flex-direction:column; gap:6px;
}
.map-zoom-btn{
    width:44px; height:44px; border-radius:14px; border:none;
    background:var(--glass);
    backdrop-filter:blur(14px);
    -webkit-backdrop-filter:blur(14px);
    border:1.5px solid var(--glass-border);
    box-shadow:var(--shadow-sm);
    color:var(--text); font-size:18px;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:.2s ease;
}
.map-zoom-btn:hover{ background:#fff; color:var(--sec); }

/* ══════════════════════════════
   STATS PILL
══════════════════════════════ */
.map-stats-pill{
    position:absolute;
    left:16px; top:16px;
    z-index:10;
    display:none;
}
.map-stats-inner{
    background:var(--glass);
    backdrop-filter:blur(14px);
    -webkit-backdrop-filter:blur(14px);
    border:1.5px solid var(--glass-border);
    border-radius:999px;
    box-shadow:var(--shadow-md);
    padding:8px 16px;
    display:flex; align-items:center; gap:8px;
    font-family:'Cairo',sans-serif;
}
.map-stats-dot{
    width:8px; height:8px; border-radius:50%;
    background:var(--success);
    box-shadow:0 0 8px var(--success);
}
.map-stats-text{ font-size:12px; font-weight:800; color:var(--text); }
.map-stats-num{ font-size:13px; font-weight:900; color:var(--sec); }

/* ══════════════════════════════
   OFFERS MODAL
══════════════════════════════ */
#offers-dialog .modal-content{
    border:none; border-radius:24px; overflow:hidden;
    box-shadow:var(--shadow-lg);
}
#offers-dialog .modal-header{
    background:linear-gradient(135deg,#0b1220,var(--pri));
    color:#fff; border:none; padding:18px 22px;
}
#offers-dialog .modal-header .btn-close{ filter:invert(1); }
.offer-item{
    background:#f8fafc; border:1px solid var(--line);
    border-radius:16px; padding:14px; margin-bottom:12px;
    display:flex; gap:14px; align-items:flex-start;
}
.offer-item:last-child{ margin-bottom:0; }
.offer-img{
    width:80px; height:80px; border-radius:12px;
    object-fit:cover; flex-shrink:0;
    border:2px solid var(--line);
}
.offer-body{ flex:1; }
.offer-title{ font-size:14px; font-weight:900; color:var(--text); margin-bottom:6px; font-family:'Cairo',sans-serif; }
.offer-row{ display:flex; align-items:center; gap:6px; font-size:12px; color:var(--muted); margin-bottom:3px; font-family:'Cairo',sans-serif; font-weight:600; }
.offer-row i{ color:var(--sec); width:14px; }
.offer-badge{
    display:inline-flex; align-items:center; gap:4px;
    background:#fef3c7; color:#d97706;
    border-radius:999px; padding:3px 10px;
    font-size:11px; font-weight:900; font-family:'Cairo',sans-serif;
    margin-top:6px;
}

/* ══════════════════════════════
   RESPONSIVE
══════════════════════════════ */
@media(max-width:768px){
    .map-topbar{ top:10px; left:10px; right:10px; gap:8px; }
    .ecm-img-wrap{ width:90px; }
    .ecm-title{ font-size:13px; }
    .ecm-price-num{ font-size:12px; }
    .map-zoom-controls{ left:10px; }
    #estate-details{ bottom:10px; left:10px; right:10px; }
}

@media(max-width:480px){
    .ecm-inner{ flex-direction:column; }
    .ecm-img-wrap{ width:100%; height:160px; }
    .ecm-img-wrap img{ height:160px; }
}
</style>
@endpush

@section('content')
<div class="map-page">

    {{-- ── الخريطة ── --}}
    <div id="map"></div>

    {{-- ── Top Bar ── --}}
    <div class="map-topbar">
        <div class="map-search-row">
            <a href="{{ url()->previous() }}" class="map-back-btn">
                <i class="fas fa-arrow-right"></i>
            </a>
            <div class="map-title-pill">
                <i class="fas fa-map-location-dot"></i>
                <span>استعراض العقارات على الخريطة</span>
            </div>
        </div>

        <div class="map-cats-wrap" id="cats-scroll" style="display:none">
            <div class="map-cats-row" id="categories-container"></div>
        </div>
    </div>

    {{-- ── إحصاء العقارات ── --}}
    <div class="map-stats-pill" id="map-stats-pill">
        <div class="map-stats-inner">
            <div class="map-stats-dot"></div>
            <span class="map-stats-text">عقارات متاحة:</span>
            <span class="map-stats-num" id="map-stats-count">0</span>
        </div>
    </div>

    {{-- ── أزرار التحكم ── --}}
    <div class="map-zoom-controls">
        <button class="map-zoom-btn" id="zoom-in" title="تكبير">
            <i class="fas fa-plus"></i>
        </button>
        <button class="map-zoom-btn" id="zoom-out" title="تصغير">
            <i class="fas fa-minus"></i>
        </button>
        <button class="map-zoom-btn" id="zoom-locate" title="موقعي">
            <i class="fas fa-location-crosshairs"></i>
        </button>
    </div>

    {{-- ── Loading ── --}}
    <div id="map-loading">
        <div class="map-loading-box">
            <div class="spinner-border text-primary" role="status"></div>
            <span>جاري التحميل...</span>
        </div>
    </div>

    {{-- ── بطاقة العقار السفلية ── --}}
    <div id="estate-details">
        <div class="estate-card-map" id="estate-card-inner">
            <div class="ecm-inner">
                <div class="ecm-img-wrap">
                    <img id="estate-image" src="" alt="صورة العقار">
                    <div class="ecm-img-badge">
                        <i class="fas fa-image"></i>
                        <span id="estate-img-count">1</span>
                    </div>
                </div>
                <div class="ecm-body">
                    <div class="ecm-top">
                        <div class="ecm-title" id="estate-title">—</div>
                        <button class="ecm-close" id="ecm-close-btn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="ecm-address">
                        <i class="fas fa-location-dot"></i>
                        <span id="estate-description">—</span>
                    </div>
                    <div class="ecm-price-row">
                        <div class="ecm-price">
                            <div>
                                <div class="ecm-price-num" id="estate-price">—</div>
                                <div class="ecm-price-curr">ريال سعودي</div>
                            </div>
                        </div>
                        <a href="#" class="ecm-view-btn" id="estate-view-link">
                            <i class="fas fa-eye"></i>
                            عرض التفاصيل
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ══════════════════════════════
     Offers Modal
══════════════════════════════ --}}
<div class="modal fade" id="offers-dialog" tabindex="-1" aria-labelledby="offersDialogLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:10px;position:relative;z-index:1">
                    <div style="width:38px;height:38px;border-radius:12px;background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.22);display:flex;align-items:center;justify-content:center;font-size:16px;color:#fff">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div>
                        <div style="font-size:16px;font-weight:900;color:#fff;font-family:'Cairo',sans-serif">عروض الخدمة</div>
                        <div style="font-size:11px;color:rgba(255,255,255,.7);font-weight:600;font-family:'Cairo',sans-serif">العروض المتاحة على هذا العقار</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3" id="offers-modal-body">
                {{-- ستُملأ ديناميكياً --}}
            </div>
            <div class="modal-footer" style="border:none;background:#f8fafc">
                <button type="button" class="btn btn-light" style="border-radius:12px;font-weight:800;font-family:'Cairo',sans-serif" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4&language=ar"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    /* ──────────────────────────────
       إعداد الخريطة
    ────────────────────────────── */
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 24.7136, lng: 46.6753 },
        zoom: 5,
        gestureHandling: 'none',
        disableDefaultUI: true,
        scrollwheel: false,
        disableDoubleClickZoom: true,
        styles: [
            { featureType:"poi", elementType:"labels", stylers:[{ visibility:"off" }] },
            { featureType:"transit", elementType:"labels", stylers:[{ visibility:"off" }] },
            { featureType:"water", elementType:"geometry", stylers:[{ color:"#c9d9e8" }] },
            { featureType:"landscape", elementType:"geometry", stylers:[{ color:"#f4f7fb" }] },
            { featureType:"road", elementType:"geometry", stylers:[{ color:"#ffffff" }] },
            { featureType:"road", elementType:"geometry.stroke", stylers:[{ color:"#e5e7eb" }] },
            { featureType:"administrative", elementType:"geometry.stroke", stylers:[{ color:"#c5d3e4" }] }
        ]
    });

    var markers         = [];
    var zoneMarkers     = [];
    var bounds          = new google.maps.LatLngBounds();
    var currentZoneId   = null;
    var currentInfoWin  = null;
    var currentSelMark  = null;
    var estates         = [];
    var currentEstateId = null;

    /* ──────────────────────────────
       أزرار التحكم
    ────────────────────────────── */
    $('#zoom-in').on('click',  function(){ map.setZoom(map.getZoom() + 1); });
    $('#zoom-out').on('click', function(){ map.setZoom(map.getZoom() - 1); });
    $('#zoom-locate').on('click', function(){
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(pos){
                map.setCenter({ lat:pos.coords.latitude, lng:pos.coords.longitude });
                map.setZoom(14);
            });
        }
    });

    $('#ecm-close-btn').on('click', function(){ $('#estate-details').hide(); });
    $('#estate-card-inner').on('click', function(){
        if(currentEstateId) window.location.href = '{{ url("/details") }}/' + currentEstateId;
    });
    $('#estate-view-link').on('click', function(e){
        e.stopPropagation();
        if(currentEstateId) window.location.href = '{{ url("/details") }}/' + currentEstateId;
    });

    /* ──────────────────────────────
       Helpers
    ────────────────────────────── */
    function showLoading(){ $('#map-loading').show(); }
    function hideLoading(){ $('#map-loading').hide(); }

    function formatPrice(n){
        n = Number(n || 0);
        if(n >= 1000000) return (n/1000000).toFixed(1) + ' مليون';
        if(n >= 1000)    return (n/1000).toFixed(0) + ' ألف';
        return n.toLocaleString();
    }

    function clearMarkers(arr){
        arr.forEach(m => m.setMap(null));
        arr.length = 0;
    }

    /* ──────────────────────────────
       تحميل المناطق
    ────────────────────────────── */
    function loadZones(){
        showLoading();
        $('#cats-scroll').hide();
        $('#map-stats-pill').hide();
        $('#estate-details').hide();

        $.ajax({
            url: '{{ url("/api/v1/zones") }}',
            method: 'GET',
            success: function(data){
                clearMarkers(zoneMarkers);
                bounds = new google.maps.LatLngBounds();

                if(!data || data.length === 0){ hideLoading(); return; }

                data.forEach(function(zone){
                    var count = zone.estate_count || 0;
                    var svgW  = Math.max(110, zone.name_ar.length * 11 + 50);
                    var svg   = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="${svgW}" height="36">
                          <defs>
                            <filter id="s" x="-20%" y="-30%" width="140%" height="180%">
                              <feDropShadow dx="0" dy="3" stdDeviation="3" flood-color="rgba(15,23,42,.22)"/>
                            </filter>
                          </defs>
                          <rect x="1" y="1" width="${svgW-2}" height="34" rx="17" ry="17"
                                fill="#114b89" filter="url(#s)"/>
                          <text x="${(svgW - count.toString().length * 7 - 36) / 2}"
                                y="23" font-family="Cairo,Arial" font-size="13"
                                fill="white" font-weight="bold">${zone.name_ar}</text>
                          <rect x="${svgW - 36}" y="6" width="30" height="24" rx="12" ry="12" fill="white"/>
                          <text x="${svgW - 21}" y="22" font-family="Cairo,Arial" font-size="11"
                                fill="#114b89" font-weight="bold" text-anchor="middle">${count}</text>
                        </svg>`;

                    var marker = new google.maps.Marker({
                        position: { lat: parseFloat(zone.latitude), lng: parseFloat(zone.longitude) },
                        map: map,
                        icon: {
                            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg),
                            scaledSize: new google.maps.Size(svgW, 36),
                            anchor: new google.maps.Point(svgW / 2, 18)
                        },
                        title: zone.name_ar
                    });

                    marker.addListener('click', function(){
                        map.setCenter(marker.getPosition());
                        map.setZoom(10);
                        currentZoneId = zone.id;
                        $('#cats-scroll').show();
                        clearMarkers(zoneMarkers);
                        loadCategories(zone.id);
                        map.setOptions({ gestureHandling:'greedy', scrollwheel:true, disableDoubleClickZoom:false });
                    });

                    zoneMarkers.push(marker);
                    bounds.extend(marker.getPosition());
                });

                map.fitBounds(bounds);
                hideLoading();
            },
            error: function(){ hideLoading(); }
        });
    }

    /* ──────────────────────────────
       تحميل الأقسام
    ────────────────────────────── */
    function loadCategories(zoneId){
        showLoading();
        $.ajax({
            url: '{{ url("/api/v1/categories") }}',
            method: 'GET',
            success: function(data){
                $('#categories-container').empty();

                var allBtn = $('<button class="map-cat-btn active">الكل</button>');
                allBtn.on('click', function(){
                    $('.map-cat-btn').removeClass('active');
                    $(this).addClass('active');
                    $('#estate-details').hide();
                    loadEstates(0, zoneId);
                });
                $('#categories-container').append(allBtn);

                if(data && data.length){
                    data.forEach(function(cat){
                        var btn = $(`<button class="map-cat-btn">${cat.name_ar}</button>`);
                        btn.on('click', function(){
                            $('.map-cat-btn').removeClass('active');
                            $(this).addClass('active');
                            $('#estate-details').hide();
                            loadEstates(cat.id, zoneId);
                        });
                        $('#categories-container').append(btn);
                    });
                }

                loadEstates(0, zoneId);
                hideLoading();
            },
            error: function(){ hideLoading(); }
        });
    }

    /* ──────────────────────────────
       تحميل العقارات
    ────────────────────────────── */
    function loadEstates(categoryId, zoneId){
        showLoading();
        $.ajax({
            url: `{{ url('/api/v1/estate/get-estate/all') }}?category_id=${categoryId}&zone_id=${zoneId}`,
            method: 'GET',
            success: function(data){
                clearMarkers(markers);
                $('#estate-details').hide();

                if(!data || !data.estate || data.estate.length === 0){
                    $('#map-stats-count').text('0');
                    $('#map-stats-pill').show();
                    hideLoading();
                    return;
                }

                estates = data.estate;
                $('#map-stats-count').text(estates.length);
                $('#map-stats-pill').show();

                estates.forEach(function(estate, index){
                    var imgUrl     = '{{ asset("storage/app/public/estate/") }}/' + (estate.images[0] || '');
                    var defaultImg = '{{ asset("public/assets/images/default-estate.jpg") }}';
                    var hasOffer   = estate.service_offers && estate.service_offers.length > 0;

                    var testImg = new Image();
                    testImg.onload  = function(){ buildMarker(imgUrl,     estate, hasOffer, index); };
                    testImg.onerror = function(){ buildMarker(defaultImg, estate, hasOffer, index); };
                    testImg.src = imgUrl;
                });

                hideLoading();
            },
            error: function(){ hideLoading(); }
        });
    }

    /* ──────────────────────────────
       بناء Marker
    ────────────────────────────── */
    function buildMarker(imgUrl, estate, hasOffer, index){
        createCustomMarker(imgUrl, function(iconUrl){
            var priceText = formatPrice(estate.price);
            var marker = new google.maps.Marker({
                position: { lat: parseFloat(estate.latitude), lng: parseFloat(estate.longitude) },
                map: map,
                title: estate.title,
                icon: {
                    url: iconUrl,
                    scaledSize: new google.maps.Size(60, 60),
                    labelOrigin: new google.maps.Point(30, -12)
                },
                label: {
                    text: priceText,
                    color: '#ffffff',
                    fontSize: '11px',
                    fontWeight: '900',
                    className: hasOffer ? 'price-label price-label-selected' : 'price-label'
                },
                zIndex: hasOffer ? 2 : 1
            });

            markers.push(marker);

            marker.addListener('click', function(){
                if(currentInfoWin)  currentInfoWin.close();
                if(currentSelMark && currentSelMark !== marker){
                    createCustomMarker(imgUrl, function(u){
                        currentSelMark.setIcon({ url:u, scaledSize:new google.maps.Size(60,60), labelOrigin:new google.maps.Point(30,-12) });
                    }, false, hasOffer);
                }

                createCustomMarker(imgUrl, function(selUrl){
                    marker.setIcon({ url:selUrl, scaledSize:new google.maps.Size(60,60), labelOrigin:new google.maps.Point(30,-12) });
                }, true, hasOffer);

                currentSelMark  = marker;
                currentEstateId = estate.id;

                /* ── بطاقة الأسفل ── */
                $('#estate-image').attr('src', imgUrl);
                $('#estate-title').text(estate.title || estate.category_name || '—');
                $('#estate-description').text(estate.address || estate.short_description || '—');
                $('#estate-price').text(formatPrice(estate.price));
                $('#estate-view-link').attr('href', '{{ url("/details") }}/' + estate.id);
                $('#estate-img-count').text(Array.isArray(estate.images) ? estate.images.length : 1);
                $('#estate-details').show();

                map.setCenter(marker.getPosition());
                map.setZoom(15);
            });

            if(index === 0){
                google.maps.event.trigger(marker, 'click');
            }
        }, false, hasOffer);
    }

    /* ──────────────────────────────
       رسم Marker مخصص على canvas
    ────────────────────────────── */
    function createCustomMarker(estateImgUrl, callback, isSelected, hasOffer){
        var canvas  = document.createElement('canvas');
        canvas.width = canvas.height = 60;
        var ctx      = canvas.getContext('2d');
        var markImg  = new Image();
        var estImg   = new Image();

        var markerSrc = isSelected
            ? '{{ asset("public/assets/images/marker-selected.png") }}'
            : (hasOffer
                ? '{{ asset("public/assets/images/marker-gold.png") }}'
                : '{{ asset("public/assets/images/marker.png") }}');

        markImg.onload = function(){
            ctx.drawImage(markImg, 0, 0, 60, 60);
            estImg.onload = function(){
                var size = 28, x = 16, y = 8;
                ctx.save();
                ctx.beginPath();
                ctx.arc(x + size/2, y + size/2, size/2, 0, Math.PI*2);
                ctx.closePath();
                ctx.clip();
                ctx.drawImage(estImg, x, y, size, size);
                ctx.restore();
                callback(canvas.toDataURL());
            };
            estImg.onerror = function(){
                estImg.src = '{{ asset("public/assets/images/default-estate.jpg") }}';
            };
            estImg.src = estateImgUrl;
        };
        markImg.onerror = function(){ callback(canvas.toDataURL()); };
        markImg.src = markerSrc;
    }

    /* ──────────────────────────────
       Zoom out → رجوع للمناطق
    ────────────────────────────── */
    map.addListener('zoom_changed', function(){
        if(map.getZoom() <= 5){
            $('#cats-scroll').hide();
            $('#estate-details').hide();
            $('#map-stats-pill').hide();
            clearMarkers(markers);
            loadZones();
            map.setOptions({ gestureHandling:'none', scrollwheel:false, disableDoubleClickZoom:true });
        }
    });

    /* ──────────────────────────────
       عروض الخدمة
    ────────────────────────────── */
    window.showOffersModal = function(estateId){
        var estate = estates.find(e => e.id == estateId);
        if(!estate || !estate.service_offers || !estate.service_offers.length) return;

        var html = '';
        estate.service_offers.forEach(function(offer){
            html += `
                <div class="offer-item">
                    <img class="offer-img"
                         src="{{ asset('storage/') }}/${offer.image}"
                         alt="${offer.title}"
                         onerror="this.src='{{ asset('public/assets/images/default-estate.jpg') }}'">
                    <div class="offer-body">
                        <div class="offer-title">${offer.title}</div>
                        <div class="offer-row"><i class="fas fa-file-alt"></i>${offer.description || '—'}</div>
                        ${offer.service_price ? `<div class="offer-row"><i class="fas fa-tag"></i>السعر: ${offer.service_price} ريال</div>` : ''}
                        ${offer.expiry_date   ? `<div class="offer-row"><i class="fas fa-calendar"></i>ينتهي: ${offer.expiry_date}</div>` : ''}
                        ${offer.phone_provider ? `<div class="offer-row"><i class="fas fa-phone"></i>${offer.phone_provider}</div>` : ''}
                        ${offer.discount ? `<span class="offer-badge"><i class="fas fa-percent"></i>خصم ${offer.discount}%</span>` : ''}
                    </div>
                </div>`;
        });

        $('#offers-modal-body').html(html);
        new bootstrap.Modal(document.getElementById('offers-dialog')).show();
    };

    /* ──────────────────────────────
       تشغيل
    ────────────────────────────── */
    loadZones();
});
</script>
@endpush
