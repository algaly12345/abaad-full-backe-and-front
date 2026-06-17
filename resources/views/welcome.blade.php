@extends('layouts.front-end.app')

@section('title', $web_config['name']->value.' '.translate('online_Shopping').' | '.$web_config['name']->value.' '.translate('ecommerce'))

@push('css_or_js')
    <meta property="og:image" content="{{$web_config['web_logo']['path']}}"/>
    <meta property="og:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <meta property="twitter:card" content="{{$web_config['web_logo']['path']}}"/>
    <meta property="twitter:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <link rel="stylesheet" href="{{ asset('public/assets/front-end/css/home.css')}}"/>
    <link rel="stylesheet" href="{{ asset('public/assets/front-end/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/front-end/css/owl.theme.default.min.css') }}">
@endpush

@section('content')
<style>
        body {
            direction: rtl;
        }
        #map {
            height: 500px;
            width: 100%;
        }
        #categories-container {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 5;
            max-width: calc(100% - 20px);
            overflow-x: auto;
            white-space: nowrap;
        }
        #loading {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            border-radius: 5px;
            font-size: 18px;
        }
        #error-message {
            color: red;
            padding: 10px;
            text-align: center;
        }
        #estates-container {
            padding: 10px;
            background-color: #f9f9f9;
            border-top: 1px solid #ccc;
        }
        .estate-item {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            cursor: pointer;
        }
        .estate-item:hover {
            background-color: #e0e0e0;
        }
        .estate-item.active {
            background-color: #d0d0d0;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <div id="categories-container" class="d-flex flex-wrap">
        <button id="show-all" class="btn btn-outline-secondary mx-2">الكل</button>
    </div>
    <div id="loading">جاري التحميل...</div>
    <div id="error-message"></div>
    <div id="estates-container">
        <ul id="estates-list" class="list-unstyled"></ul>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4&language=ar"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 24.7136, lng: 46.6753},
                zoom: 5
            });

            var markers = [];
            var currentZoneId = null;
            var zoneMarkers = [];

            function showLoading() {
                $('#loading').show();
            }

            function hideLoading() {
                $('#loading').hide();
            }

            function loadZones() {
                showLoading();
                $.ajax({
                    url: `{{ url('/api/v1/zones') }}`,
                    method: 'GET',
                    success: function(data) {
                        clearMarkers(zoneMarkers);
                        if (!data || data.length === 0) {
                            $('#error-message').text('لم يتم العثور على أي مناطق.');
                            hideLoading();
                            return;
                        }
                        data.forEach(function(zone) {
                            var marker = new google.maps.Marker({
                                position: {lat: parseFloat(zone.latitude), lng: parseFloat(zone.longitude)},
                                map: map,
                                title: zone.name_ar,
                                label: {
                                    text: zone.name_ar,
                                    color: 'black',
                                    fontSize: '14px',
                                    fontWeight: 'bold'
                                }
                            });

                            marker.addListener('click', function() {
                                map.setCenter(marker.getPosition());
                                map.setZoom(10);
                                currentZoneId = zone.id;
                                $('#categories-container').show();
                                clearMarkers(zoneMarkers);
                                loadCategories(zone.id);
                            });

                            zoneMarkers.push(marker);
                        });
                        hideLoading();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#error-message').text('خطأ في جلب المناطق: ' + textStatus + ' - ' + errorThrown);
                        hideLoading();
                    }
                });
            }

            function loadCategories(zoneId) {
                showLoading();
                $.ajax({
                    url: '{{ url("/api/v1/categories") }}',
                    method: 'GET',
                    success: function(data) {
                        $('#categories-container').empty();
                        $('#categories-container').append(`<button id="show-all" class="btn btn-outline-secondary mx-2">الكل</button>`);
                        if (!data || data.length === 0) {
                            $('#error-message').text('لم يتم العثور على أي فئات.');
                            hideLoading();
                        } else {
                            data.forEach(function(category) {
                                $('#categories-container').append(`<button class="btn btn-outline-primary mx-2 category-button" data-id="${category.id}" data-zone="${zoneId}">${category.name_ar}</button>`);
                            });

                            $('.category-button').on('click', function() {
                                var categoryId = $(this).data('id');
                                var zoneId = $(this).data('zone');
                                $('.category-button').removeClass('active');
                                $(this).addClass('active');
                                loadEstates(categoryId, zoneId);
                            });

                            $('#show-all').on('click', function() {
                                loadEstates(0, zoneId);
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#error-message').text('خطأ في جلب الفئات: ' + textStatus + ' - ' + errorThrown);
                        hideLoading();
                    }
                });
            }

            function loadEstates(categoryId, zoneId) {
                showLoading();
                $.ajax({
                    url: `{{ url('/api/v1/estate/get-estate/all') }}?category_id=${categoryId}&zone_id=${zoneId}`,
                    method: 'GET',
                    success: function(data) {
                        clearMarkers(markers);
                        $('#estates-list').empty();
                        if (!data || !data.estate || data.estate.length === 0) {
                            $('#error-message').text('لم يتم العثور على أي عقارات.');
                            $('#estates-list').append('<li>لا توجد عقارات متاحة في هذا القسم.</li>');
                            hideLoading();
                            return;
                        }
                        data.estate.forEach(function(estate, index) {
                            if (!estate.latitude || !estate.longitude) {
                                return;
                            }
                            var marker = new google.maps.Marker({
                                position: {lat: parseFloat(estate.latitude), lng: parseFloat(estate.longitude)},
                                map: map,
                                title: estate.title,
                                label: {
                                    text: (index + 1).toString(),
                                    color: 'black',
                                    fontSize: '14px',
                                    fontWeight: 'bold'
                                }
                            });

                            markers.push(marker);
                            $('#estates-list').append(`
                                <li class="estate-item" data-lat="${estate.latitude}" data-lng="${estate.longitude}">
                                    <h3>${estate.title}</h3>
                                    <p>${estate.short_description}</p>
                                    <p>السعر: ${estate.price}</p>
                                </li>
                            `);
                        });

                        $('.estate-item').on('click', function() {
                            var lat = parseFloat($(this).data('lat'));
                            var lng = parseFloat($(this).data('lng'));
                            var position = {lat: lat, lng: lng};
                            map.setCenter(position);
                            map.setZoom(15);
                            $('.estate-item').removeClass('active');
                            $(this).addClass('active');
                        });
                        $('#error-message').empty();
                        hideLoading();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#error-message').text('خطأ في جلب العقارات: ' + textStatus + ' - ' + errorThrown);
                        hideLoading();
                    }
                });
            }

            function clearMarkers(markerArray) {
                markerArray.forEach(function(marker) {
                    marker.setMap(null);
                });
                markerArray.length = 0;
            }

            loadZones();
        });
    </script>
</body>
</html>
