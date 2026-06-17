{{-- @extends('layouts.front-end.app')

@section('title', translate('flash_Deal_Products'))

@push('css_or_js')
    <meta property="og:image" content="{{$web_config['web_logo']['path']}}"/>
    <meta property="og:title" content="Deals of {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <meta property="twitter:card" content="{{$web_config['web_logo']['path']}}"/>
    <meta property="twitter:title" content="Deals of {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description"
          content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">
    <style>
        .countdown-background {
            background: var(--web-primary);
        }

        .cz-countdown-days {
            border: .5px solid var(--web-primary);
        }

        .cz-countdown-hours {
            border: .5px solid var(--web-primary);
        }

        .cz-countdown-minutes {
            border: .5px solid var(--web-primary);
        }

        .cz-countdown-seconds {
            border: .5px solid var(--web-primary);
        }

        .flash_deal_product_details .flash-product-price {
            color: var(--web-primary);
        }
    </style>
@endpush

@section('content')
    @php($decimal_point_settings = getWebConfig(name: 'decimal_point_settings'))
    @php($deal_banner = getStorageImages(path: $deal['banner_full_url'],type: 'banner' ,source: theme_asset(path: 'public/assets/front-end/img/flash-deals.png')))
    <div class="__inline-59 pt-md-3">
        <div class="container md-4 mt-3 rtl text-align-direction">
            <div class="__flash-deals-bg rounded" style="background: url({{$deal_banner}}) no-repeat center center / cover">
                <div class="row g-3 justify-content-end align-items-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="countdown-card bg-transparent">
                            <div class="text-center text-white">
                                <div class="countdown-background">
                                 <span class="cz-countdown d-flex justify-content-center align-items-center"
                                       data-countdown="{{$web_config['flash_deals']?date('m/d/Y',strtotime($web_config['flash_deals']['end_date'])):''}} 23:59:00">
                                     <span class="cz-countdown-days">
                                         <span class="cz-countdown-value"></span>
                                         <span class="cz-countdown-text">{{ translate('days')}}</span>
                                     </span>
                                     <span class="cz-countdown-value p-1">:</span>
                                     <span class="cz-countdown-hours">
                                         <span class="cz-countdown-value"></span>
                                         <span class="cz-countdown-text">{{ translate('hrs')}}</span>
                                     </span>
                                     <span class="cz-countdown-value p-1">:</span>
                                     <span class="cz-countdown-minutes">
                                         <span class="cz-countdown-value"></span>
                                         <span class="cz-countdown-text">{{ translate('min')}}</span>
                                     </span>
                                     <span class="cz-countdown-value p-1">:</span>
                                     <span class="cz-countdown-seconds">
                                         <span class="cz-countdown-value"></span>
                                         <span class="cz-countdown-text">{{ translate('sec')}}</span>
                                     </span>
                                 </span>

                                    <?php
                                        $startDate = \Carbon\Carbon::parse($web_config['flash_deals']['start_date']);
                                        $endDate = \Carbon\Carbon::parse($web_config['flash_deals']['end_date']);
                                        $now = \Carbon\Carbon::now();
                                        $totalDuration = $endDate->diffInSeconds($startDate);
                                        $elapsedDuration = $now->diffInSeconds($startDate);
                                        $flashDealsPercentage = ($elapsedDuration / $totalDuration) * 100;
                                    ?>

                                    <div class="progress __progress">
                                        <div class="progress-bar flash-deal-progress-bar" role="progressbar"
                                             style="width: {{ number_format($flashDealsPercentage, 2) }}%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pb-5 mb-2 mb-md-4 mt-3 rtl text-align-direction">
            <div class="row">
                <div class="col-lg-4 col-md-6 my-2 text-center {{Session::get('direction') === "rtl" ? 'text-sm-right' : 'text-sm-left'}}">
                    <div class="flash_deal_title">
                        {{$web_config['flash_deals']->title}}
                    </div>
                    <span class="fs-14 font-weight-normal">{{translate('hurry_Up')}} ! {{translate('the_offer_is_limited')}}. {{translate('grab_while_it_lasts')}}</span>
                </div>

                <section class="col-lg-12">
                    <div class="row g-3 mt-2">
                        @foreach($flashDealProducts as $flashDealProduct)
                            <div class="col--xl-2 col-sm-4 col-lg-3 col-6">
                                @include('web-views.partials._inline-single-product',['product'=> $flashDealProduct,'decimal_point_settings'=>$decimal_point_settings])
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/deals.js') }}"></script>
@endpush --}}







<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل العقار</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .estate-details-container {
            padding: 20px;
        }
        .img-fluid {
            max-height: 400px;
            object-fit: cover;
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-height: 500px;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .estate-header {
            margin-bottom: 20px;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 10px;
        }
        .estate-header h1 {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container estate-details-container">
        <div class="estate-header">
            <h1 id="estate-title"></h1>
            <p id="estate-address"></p>
            <p id="estate-price"></p>
            <p id="estate-space"></p>
            <p id="estate-ownership-type"></p>
            <p id="estate-description"></p>
            <p id="estate-phone"></p>
            <p id="estate-price-negotiation"></p>
            <p id="estate-build-space"></p>
            <p id="estate-document-number"></p>
            <p id="estate-ad-number"></p>
            <p id="estate-created-at"></p>
        </div>

        <h3>الصور:</h3>
        <div id="estate-images" class="row"></div>

        <h3>صور أخرى:</h3>
        <div id="estate-planned-images" class="row"></div>

        <h3>الفيديو:</h3>
        <div id="estate-video" class="video-container"></div>

        <h3>خريطة الموقع:</h3>
        <iframe src="" id="estate-map" width="100%" height="300" frameborder="0"></iframe>

        <h3>رابط جولة افتراضية:</h3>
        <a id="estate-ar-path" href="" target="_blank">شاهد الجولة الافتراضية</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // افترض أن معرّف العقار يأتي من URL query parameter
            const urlParams = new URLSearchParams(window.location.search);
            const estateId = urlParams.get('estateId');

            $.ajax({
                url: `/api/v1/estate/details/${estateId}`,
                method: 'GET',
                success: function(data) {
                    if (data) {
                        $('#estate-title').text(data.title);
                        $('#estate-address').text(`العنوان: ${data.address || 'غير متوفر'}`);
                        $('#estate-price').text(`السعر: ${data.price} SAR`);
                        $('#estate-space').text(`المساحة: ${data.space} متر مربع`);
                        $('#estate-ownership-type').text(`نوع الملكية: ${data.ownership_type || 'غير متوفر'}`);
                        $('#estate-description').text(`الوصف الطويل: ${data.long_description || 'غير متوفر'}`);
                        $('#estate-phone').text(`رقم الهاتف: ${data.users ? data.users.phone : 'غير متوفر'}`);
                        $('#estate-price-negotiation').text(`تفاوض السعر: ${data.price_negotiation || 'غير متوفر'}`);
                        $('#estate-build-space').text(`مساحة البناء: ${data.build_space || 'غير متوفر'}`);
                        $('#estate-document-number').text(`رقم الوثيقة: ${data.document_number || 'غير متوفر'}`);
                        $('#estate-ad-number').text(`رقم الإعلان: ${data.ad_number || 'غير متوفر'}`);
                        $('#estate-created-at').text(`تاريخ الإضافة: ${data.created_at || 'غير متوفر'}`);

                        // عرض الصور
                        $('#estate-images').html(data.images.map(image => `
                            <div class="col-md-4 mb-2">
                                <img src="/storage/${image}" class="img-fluid" alt="صورة العقار">
                            </div>
                        `).join(''));

                        $('#estate-planned-images').html(data.planned.map(image => `
                            <div class="col-md-4 mb-2">
                                <img src="/storage/${image}" class="img-fluid" alt="صورة العقار">
                            </div>
                        `).join(''));

                        // عرض الفيديو
                        if (data.video_url) {
                            $('#estate-video').html(`
                                <video width="100%" controls>
                                    <source src="/storage/${data.video_url}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            `);
                        } else {
                            $('#estate-video').html('<p>لا يوجد فيديو متاح.</p>');
                        }

                        // عرض خريطة الموقع
                        $('#estate-map').attr('src', `https://www.google.com/maps?q=${data.latitude},${data.longitude}&z=15&output=embed`);

                        // عرض الرابط
                        $('#estate-ar-path').attr('href', data.ar_path).text('شاهد الجولة الافتراضية');
                    } else {
                        alert('لم يتم العثور على تفاصيل العقار.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('خطأ في جلب تفاصيل العقار: ' + textStatus + ' - ' + errorThrown);
                }
            });
        });
    </script>
</body>
</html>
