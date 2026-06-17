@extends('layouts.front-end.app')

@section('title', translate('map'))

@section('content')
<style>
    :root{
        --primary:#0f5bd7;
        --primary-dark:#0b3f96;
        --accent:#ff7a00;
        --bg:#f3f6fb;
        --card:#ffffff;
        --line:#e5e7eb;
        --text:#0f172a;
        --muted:#64748b;
        --shadow:0 12px 30px rgba(15,23,42,.10);
        --radius-xl:24px;
        --radius-lg:18px;
        --radius-md:14px;
    }

    body{
        background: var(--bg);
    }

    .map-page{
        padding: 18px;
    }

    .map-shell{
        display:grid;
        grid-template-columns: 390px 1fr;
        gap:18px;
        min-height: calc(100vh - 120px);
    }

    .results-panel{
        background:var(--card);
        border:1px solid var(--line);
        border-radius:var(--radius-xl);
        box-shadow:var(--shadow);
        overflow:hidden;
        display:flex;
        flex-direction:column;
    }

    .panel-head{
        padding:18px;
        border-bottom:1px solid var(--line);
        background:linear-gradient(180deg,#fff,#f8fbff);
    }

    .panel-title{
        font-size:1.08rem;
        font-weight:800;
        color:var(--text);
        margin:0 0 6px;
    }

    .panel-subtitle{
        color:var(--muted);
        font-size:.92rem;
        margin:0;
        line-height:1.8;
    }

    .categories-scroll{
        display:flex;
        gap:10px;
        overflow:auto;
        padding:14px 18px 10px;
        border-bottom:1px solid var(--line);
        background:#fff;
    }

    .filter-chip{
        border:none;
        background:#eef4ff;
        color:#1d4ed8;
        padding:10px 14px;
        border-radius:999px;
        white-space:nowrap;
        font-weight:700;
        font-size:.9rem;
        transition:.2s;
        cursor:pointer;
    }

    .filter-chip.active,
    .filter-chip:hover{
        background:linear-gradient(135deg,var(--primary),var(--primary-dark));
        color:#fff;
    }

    .zone-banner{
        margin:14px 18px 0;
        background:linear-gradient(135deg, rgba(15,91,215,.08), rgba(11,63,150,.08));
        border:1px solid #d9e6ff;
        border-radius:18px;
        padding:12px 14px;
        color:var(--text);
        display:none;
    }

    .zone-banner strong{
        display:block;
        font-size:1rem;
        margin-bottom:4px;
    }

    .results-list{
        padding:14px 18px 18px;
        overflow:auto;
        flex:1;
    }

    .estate-card{
        display:grid;
        grid-template-columns:110px 1fr;
        gap:14px;
        background:#fff;
        border:1px solid var(--line);
        border-radius:18px;
        overflow:hidden;
        box-shadow:0 6px 20px rgba(15,23,42,.05);
        margin-bottom:14px;
        cursor:pointer;
        transition:.2s ease;
    }

    .estate-card:hover,
    .estate-card.active{
        transform:translateY(-2px);
        border-color:#bfd5ff;
        box-shadow:0 14px 30px rgba(15,91,215,.12);
    }

    .estate-card img{
        width:110px;
        height:100%;
        min-height:120px;
        object-fit:cover;
        display:block;
    }

    .estate-body{
        padding:12px 12px 12px 0;
    }

    .estate-price{
        display:inline-flex;
        align-items:center;
        gap:6px;
        background:linear-gradient(135deg,var(--primary),var(--primary-dark));
        color:#fff;
        border-radius:999px;
        padding:7px 12px;
        font-weight:800;
        font-size:.85rem;
        margin-bottom:10px;
    }

    .estate-title{
        font-size:1rem;
        font-weight:800;
        color:var(--text);
        line-height:1.7;
        margin-bottom:6px;
    }

    .estate-meta{
        color:var(--muted);
        font-size:.86rem;
        line-height:1.8;
    }

    .estate-actions{
        margin-top:10px;
        display:flex;
        gap:8px;
        flex-wrap:wrap;
    }

    .estate-btn{
        border:none;
        text-decoration:none;
        padding:9px 12px;
        border-radius:12px;
        font-size:.86rem;
        font-weight:700;
        cursor:pointer;
    }

    .estate-btn.primary{
        background:linear-gradient(135deg,var(--primary),var(--primary-dark));
        color:#fff;
    }

    .estate-btn.secondary{
        background:#f8fafc;
        color:var(--text);
        border:1px solid var(--line);
    }

    .map-panel{
        position:relative;
        overflow:hidden;
        border-radius:var(--radius-xl);
        border:1px solid var(--line);
        box-shadow:var(--shadow);
        background:#fff;
        min-height: calc(100vh - 120px);
    }

    #map{
        width:100%;
        height:100%;
        min-height: calc(100vh - 120px);
    }

    .map-topbar{
        position:absolute;
        top:14px;
        left:14px;
        right:14px;
        z-index:2;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        pointer-events:none;
    }

    .map-floating{
        pointer-events:auto;
        background:rgba(255,255,255,.95);
        border:1px solid var(--line);
        border-radius:16px;
        padding:10px 14px;
        box-shadow:0 10px 24px rgba(15,23,42,.08);
        font-weight:700;
        color:var(--text);
    }

    .map-actions{
        display:flex;
        gap:8px;
        pointer-events:auto;
    }

    .map-icon-btn{
        width:42px;
        height:42px;
        border:none;
        border-radius:14px;
        background:rgba(255,255,255,.96);
        border:1px solid var(--line);
        box-shadow:0 10px 24px rgba(15,23,42,.08);
        font-size:1.1rem;
        font-weight:800;
        cursor:pointer;
    }

    .empty-state{
        text-align:center;
        color:var(--muted);
        padding:40px 20px;
        line-height:1.9;
    }

    .custom-info{
        width:250px;
    }

    .custom-info img{
        width:100%;
        height:140px;
        object-fit:cover;
        border-radius:12px;
        margin-bottom:10px;
    }

    .custom-info .title{
        font-weight:800;
        font-size:.95rem;
        color:var(--text);
        line-height:1.6;
        margin-bottom:6px;
    }

    .custom-info .meta{
        font-size:.83rem;
        color:var(--muted);
        margin-bottom:8px;
        line-height:1.7;
    }

    .custom-info .price{
        color:var(--primary);
        font-weight:800;
        margin-bottom:8px;
    }

    .custom-info a{
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        gap:6px;
        color:var(--primary);
        font-weight:800;
    }

    .gm-style .gm-style-iw-c{
        border-radius:18px !important;
        padding:12px !important;
        box-shadow:0 12px 30px rgba(15,23,42,.15) !important;
    }

    @media (max-width: 992px){
        .map-shell{
            grid-template-columns: 1fr;
        }

        .results-panel{
            order:2;
            min-height:unset;
        }

        .map-panel{
            order:1;
            min-height:420px;
        }

        #map{
            min-height:420px;
        }
    }
</style>

<div class="map-page">
    <div class="map-shell">
        <aside class="results-panel">
            <div class="panel-head">
                <h3 class="panel-title">استكشف العقارات على الخريطة</h3>
                <p class="panel-subtitle">اختر المنطقة أولاً، ثم تصفح العقارات بطريقة أوضح وأجمل.</p>
            </div>

            <div class="categories-scroll" id="categories-container" style="display:none;">
                <button id="show-all" class="filter-chip active">الكل</button>
            </div>

            <div class="zone-banner" id="zoneBanner">
                <strong id="zoneBannerTitle">اسم المنطقة</strong>
                <span id="zoneBannerSubtitle">تم تحميل العقارات الخاصة بهذه المنطقة</span>
            </div>

            <div class="results-list" id="results-list">
                <div class="empty-state">
                    <div style="font-size:1.1rem;font-weight:800;margin-bottom:8px;">اختر منطقة من الخريطة</div>
                    <div>لن يظهر اسم المنطقة إلا بعد الضغط عليها، وبعدها ستظهر العقارات في القائمة.</div>
                </div>
            </div>
        </aside>

        <section class="map-panel">
            <div class="map-topbar">
                <div class="map-floating" id="mapStatus">عرض المناطق</div>
                <div class="map-actions">
                    <button class="map-icon-btn" onclick="zoomIn()">+</button>
                    <button class="map-icon-btn" onclick="zoomOut()">−</button>
                    <button class="map-icon-btn" onclick="resetMapView()">⌂</button>
                </div>
            </div>

            <div id="map"></div>
        </section>
    </div>
</div>

<div class="modal fade" id="offersModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border:none;border-radius:22px;overflow:hidden;">
            <div class="modal-header">
                <h5 class="modal-title">عروض العقار</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="offersContent"></div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4&language=ar"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function () {
    let map;
    let zoneMarkers = [];
    let estateMarkers = [];
    let currentInfoWindow = null;
    let currentZoneId = null;
    let currentZoneName = '';
    let estates = [];
    let initialBounds = new google.maps.LatLngBounds();

    const defaultCenter = { lat: 24.7136, lng: 46.6753 };
    const defaultZoom = 6;

    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultCenter,
        zoom: defaultZoom,
        gestureHandling: 'greedy',
        disableDefaultUI: true,
        zoomControl: false,
        mapTypeControl: false,
        fullscreenControl: false,
        streetViewControl: false
    });

    function setMapStatus(text){
        $('#mapStatus').text(text);
    }

    function formatLargeNumber(number) {
        number = Number(number || 0);

        if (number >= 1000000) {
            const result = number / 1000000;
            return (result % 1 === 0 ? result.toFixed(0) : result.toFixed(2)) + ' مليون';
        } else if (number >= 1000) {
            const result = number / 1000;
            return (result % 1 === 0 ? result.toFixed(0) : result.toFixed(2)) + ' ألف';
        }
        return number.toLocaleString('en-US');
    }

    function getEstatePriceText(estate){
        if (estate.category_name === 'ارض') {
            return `${formatLargeNumber((estate.price || 0) * (estate.space || 0))} ر.س`;
        }
        return `${formatLargeNumber(estate.price || 0)} ر.س`;
    }

    function clearMarkers(markerArray) {
        markerArray.forEach(marker => marker.setMap(null));
        markerArray.length = 0;
    }

    function renderResultsList(items){
        const $list = $('#results-list');
        $list.empty();

        if (!items || !items.length) {
            $list.html(`
                <div class="empty-state">
                    <div style="font-size:1rem;font-weight:800;margin-bottom:8px;">لا توجد عقارات</div>
                    <div>لم يتم العثور على عقارات ضمن هذه الفئة داخل المنطقة المحددة.</div>
                </div>
            `);
            return;
        }

        items.forEach((estate) => {
            const imageUrl = estate.images && estate.images.length
                ? `{{ asset('storage/app/public/estate') }}/${estate.images[0]}`
                : `{{ asset('public/assets/images/default-estate.jpg') }}`;

            const hasOffer = estate.service_offers && estate.service_offers.length > 0;

            $list.append(`
                <div class="estate-card" data-id="${estate.id}">
                    <img src="${imageUrl}" onerror="this.src='{{ asset('public/assets/images/default-estate.jpg') }}'" alt="${estate.title}">
                    <div class="estate-body">
                        <div class="estate-price">${getEstatePriceText(estate)}</div>
                        <div class="estate-title">${estate.title || 'عقار'}</div>
                        <div class="estate-meta">${estate.category_name || '-'} - ${estate.zone_name || '-'}</div>
                        <div class="estate-meta">${estate.address || ''}</div>
                        <div class="estate-actions">
                            <a class="estate-btn primary" href="{{ url('/details') }}/${estate.id}">عرض التفاصيل</a>
                            ${hasOffer ? `<button class="estate-btn secondary show-offers-btn" data-id="${estate.id}">العروض</button>` : ''}
                        </div>
                    </div>
                </div>
            `);
        });

        $('.estate-card').off('click').on('click', function(e){
            if ($(e.target).closest('.show-offers-btn, a').length) return;
            const id = $(this).data('id');
            focusEstate(id);
        });

        $('.show-offers-btn').off('click').on('click', function(e){
            e.stopPropagation();
            const id = $(this).data('id');
            showOffers(id);
        });
    }

    function createZoneMarker(zone){
        // لا نظهر اسم المنطقة داخل الماركر
        const svgIcon = {
            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52">
                    <circle cx="26" cy="26" r="22" fill="#0f5bd7" />
                    <circle cx="26" cy="26" r="16" fill="#ffffff" opacity="0.20" />
                    <text x="26" y="31" font-family="Arial" font-size="14" fill="white" font-weight="bold" text-anchor="middle">${zone.estate_count}</text>
                </svg>
            `),
            scaledSize: new google.maps.Size(52, 52),
            anchor: new google.maps.Point(26, 26)
        };

        const marker = new google.maps.Marker({
            position: {
                lat: parseFloat(zone.latitude),
                lng: parseFloat(zone.longitude)
            },
            map,
            icon: svgIcon,
            title: zone.name_ar
        });

        marker.addListener('click', function () {
            currentZoneId = zone.id;
            currentZoneName = zone.name_ar;

            $('#categories-container').show();
            $('#zoneBanner').show();
            $('#zoneBannerTitle').text(zone.name_ar);
            $('#zoneBannerSubtitle').text(`تم تحميل العقارات داخل ${zone.name_ar}`);

            setMapStatus(`تم اختيار المنطقة`);

            map.setCenter(marker.getPosition());
            map.setZoom(10);

            loadCategories(zone.id);
            loadEstates(0, zone.id);
        });

        return marker;
    }

    function createEstateBubbleIcon(imageUrl, priceText, isActive = false){
        const safeImage = imageUrl || `{{ asset('public/assets/images/default-estate.jpg') }}`;
        const bg = isActive ? '#ff7a00' : '#0f5bd7';
        const shadow = isActive ? 'rgba(255,122,0,.35)' : 'rgba(15,91,215,.28)';

        return {
            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="118" viewBox="0 0 96 118">
                    <defs>
                        <filter id="shadow" x="-30%" y="-30%" width="160%" height="160%">
                            <feDropShadow dx="0" dy="8" stdDeviation="8" flood-color="${shadow}"/>
                        </filter>
                    </defs>

                    <g filter="url(#shadow)">
                        <rect x="8" y="8" width="80" height="92" rx="22" fill="white"/>
                        <rect x="14" y="14" width="68" height="44" rx="16" fill="#e5e7eb"/>
                        <image href="${safeImage}" x="14" y="14" width="68" height="44" preserveAspectRatio="xMidYMid slice"/>

                        <rect x="18" y="64" width="60" height="22" rx="11" fill="${bg}"/>
                        <text x="48" y="79" text-anchor="middle" font-family="Arial" font-size="11" font-weight="bold" fill="white">${priceText}</text>

                        <path d="M48 110 C56 98, 66 92, 66 82 L30 82 C30 92, 40 98, 48 110 Z" fill="white"/>
                        <circle cx="48" cy="95" r="4" fill="${bg}"/>
                    </g>
                </svg>
            `),
            scaledSize: new google.maps.Size(96, 118),
            anchor: new google.maps.Point(48, 108)
        };
    }

    function loadZones(){
        setMapStatus('جاري تحميل المناطق...');

        $.ajax({
            url: `{{ url('/api/v1/zones') }}`,
            method: 'GET',
            success: function(data){
                clearMarkers(zoneMarkers);
                clearMarkers(estateMarkers);
                initialBounds = new google.maps.LatLngBounds();

                if (!data || !data.length) {
                    setMapStatus('لا توجد مناطق');
                    return;
                }

                data.forEach(zone => {
                    const marker = createZoneMarker(zone);
                    zoneMarkers.push(marker);
                    initialBounds.extend(marker.getPosition());
                });

                map.fitBounds(initialBounds);
                setMapStatus('اختر منطقة');
            },
            error: function(){
                setMapStatus('تعذر تحميل المناطق');
            }
        });
    }

    function loadCategories(zoneId){
        $.ajax({
            url: '{{ url("/api/v1/categories") }}',
            method: 'GET',
            success: function(data){
                const $container = $('#categories-container');
                $container.empty();
                $container.append(`<button id="show-all" class="filter-chip active">الكل</button>`);

                (data || []).forEach(category => {
                    $container.append(`
                        <button class="filter-chip category-button" data-id="${category.id}" data-zone="${zoneId}">
                            ${category.name_ar}
                        </button>
                    `);
                });

                $('#show-all').off('click').on('click', function(){
                    $('.filter-chip').removeClass('active');
                    $(this).addClass('active');
                    loadEstates(0, zoneId);
                });

                $('.category-button').off('click').on('click', function(){
                    $('.filter-chip').removeClass('active');
                    $(this).addClass('active');
                    loadEstates($(this).data('id'), $(this).data('zone'));
                });
            }
        });
    }

    function createEstateMarker(estate){
        const imageUrl = estate.images && estate.images.length
            ? `{{ asset('storage/app/public/estate') }}/${estate.images[0]}`
            : `{{ asset('public/assets/images/default-estate.jpg') }}`;

        const shortPrice = estate.category_name === 'ارض'
            ? formatLargeNumber((estate.price || 0) * (estate.space || 0))
            : formatLargeNumber(estate.price || 0);

        const marker = new google.maps.Marker({
            position: {
                lat: parseFloat(estate.latitude),
                lng: parseFloat(estate.longitude)
            },
            map,
            title: estate.title,
            icon: createEstateBubbleIcon(imageUrl, shortPrice, false)
        });

        marker.__estateId = estate.id;
        marker.__imageUrl = imageUrl;
        marker.__price = shortPrice;

        marker.addListener('click', function(){
            focusEstate(estate.id);
        });

        return marker;
    }

    function resetEstateMarkerStyles(){
        estateMarkers.forEach(marker => {
            marker.setIcon(createEstateBubbleIcon(marker.__imageUrl, marker.__price, false));
        });
    }

    function loadEstates(categoryId, zoneId){
        setMapStatus('جاري تحميل العقارات...');

        $.ajax({
            url: `{{ url('/api/v1/estate/get-estate/all') }}?category_id=${categoryId}&zone_id=${zoneId}`,
            method: 'GET',
            success: function(data){
                clearMarkers(estateMarkers);

                estates = (data && data.estate) ? data.estate : [];
                renderResultsList(estates);

                if (!estates.length) {
                    setMapStatus('لا توجد عقارات في المنطقة المحددة');
                    return;
                }

                const bounds = new google.maps.LatLngBounds();

                estates.forEach(estate => {
                    if (!estate.latitude || !estate.longitude) return;

                    const marker = createEstateMarker(estate);
                    estateMarkers.push(marker);
                    bounds.extend(marker.getPosition());
                });

                if (!bounds.isEmpty()) {
                    map.fitBounds(bounds);
                }

                setMapStatus(`تم تحميل ${estates.length} عقار`);

                if (estates[0]) {
                    focusEstate(estates[0].id, false);
                }
            },
            error: function(){
                setMapStatus('تعذر تحميل العقارات');
            }
        });
    }

    function buildInfoWindow(estate){
        const imageUrl = estate.images && estate.images.length
            ? `{{ asset('storage/app/public/estate') }}/${estate.images[0]}`
            : `{{ asset('public/assets/images/default-estate.jpg') }}`;

        return `
            <div class="custom-info">
                <img src="${imageUrl}" onerror="this.src='{{ asset('public/assets/images/default-estate.jpg') }}'" alt="${estate.title}">
                <div class="title">${estate.title || 'عقار'}</div>
                <div class="meta">${estate.category_name || '-'} - ${estate.zone_name || '-'}</div>
                <div class="meta">${estate.address || ''}</div>
                <div class="price">${getEstatePriceText(estate)}</div>
                <a href="{{ url('/details') }}/${estate.id}">عرض التفاصيل</a>
            </div>
        `;
    }

    function focusEstate(estateId, pan = true){
        const estate = estates.find(e => Number(e.id) === Number(estateId));
        if (!estate) return;

        $('.estate-card').removeClass('active');
        $(`.estate-card[data-id="${estateId}"]`).addClass('active');

        const marker = estateMarkers.find(m => Number(m.__estateId) === Number(estateId));
        if (!marker) return;

        resetEstateMarkerStyles();
        marker.setIcon(createEstateBubbleIcon(marker.__imageUrl, marker.__price, true));

        if (currentInfoWindow) {
            currentInfoWindow.close();
        }

        currentInfoWindow = new google.maps.InfoWindow({
            content: buildInfoWindow(estate)
        });

        currentInfoWindow.open(map, marker);

        if (pan) {
            map.panTo(marker.getPosition());
            map.setZoom(14);
        }
    }

    function showOffers(estateId){
        const estate = estates.find(e => Number(e.id) === Number(estateId));
        if (!estate || !estate.service_offers || !estate.service_offers.length) return;

        let html = '<div class="row g-3">';

        estate.service_offers.forEach(offer => {
            html += `
                <div class="col-12">
                    <div style="border:1px solid #e5e7eb;border-radius:18px;padding:14px;background:#fff;">
                        <div style="display:flex;gap:14px;align-items:flex-start;flex-wrap:wrap;">
                            <img src="{{ asset('storage/app/public') }}/${offer.image}" 
                                 style="width:110px;height:110px;object-fit:cover;border-radius:14px;"
                                 alt="${offer.title}">
                            <div style="flex:1;min-width:220px;">
                                <div style="font-weight:800;font-size:1rem;margin-bottom:6px;">${offer.title}</div>
                                <div style="color:#64748b;font-size:.9rem;line-height:1.8;margin-bottom:8px;">${offer.description || ''}</div>
                                ${offer.service_price ? `<div style="font-weight:800;color:#0f5bd7;">السعر: ${offer.service_price} ريال</div>` : ''}
                                ${offer.discount ? `<div style="font-weight:800;color:#16a34a;">خصم: ${offer.discount}%</div>` : ''}
                                <div style="color:#ef4444;font-size:.88rem;margin-top:6px;">تاريخ انتهاء العرض: ${offer.expiry_date || '-'}</div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        html += '</div>';

        $('#offersContent').html(html);
        new bootstrap.Modal(document.getElementById('offersModal')).show();
    }

    window.zoomIn = function(){
        map.setZoom(map.getZoom() + 1);
    }

    window.zoomOut = function(){
        map.setZoom(map.getZoom() - 1);
    }

    window.resetMapView = function(){
        currentZoneId = null;
        currentZoneName = '';

        $('#categories-container').hide();
        $('#zoneBanner').hide();

        $('#results-list').html(`
            <div class="empty-state">
                <div style="font-size:1.1rem;font-weight:800;margin-bottom:8px;">اختر منطقة من الخريطة</div>
                <div>لن يظهر اسم المنطقة إلا بعد الضغط عليها، وبعدها ستظهر العقارات في القائمة.</div>
            </div>
        `);

        $('#categories-container').html(`<button id="show-all" class="filter-chip active">الكل</button>`);

        clearMarkers(estateMarkers);

        if (currentInfoWindow) {
            currentInfoWindow.close();
        }

        map.fitBounds(initialBounds);
        setMapStatus('عرض المناطق');
    }

    loadZones();
});
</script>
@endpush