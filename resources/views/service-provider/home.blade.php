<style>
    .anyClass {
        height:900px;
        overflow-y: scroll;
    }
</style>
@extends('layouts.admin')
<link href="{{asset('/assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />
@section('content')


    <div class="anyClass">



            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">العرض</h4>
                    <p class="card-title-dsec">عروضي  في العقارات</p>
                    <div id="map-canvas"  style="height: 420px"></div>
                </div>
                <!-- end card-body-->
            </div>



            <div class="content-box content-single">
                <article class="post-8 page type-page status-publish hentry">
                    <header>
                        <h1 class="entry-title">{{ request()->filled('search') || request()->filled('category') ? 'Search results' : 'كل العروض' }}</h1></header>
                    <div class="entry-content entry-summary">
                        <div class="geodir-search-container geodir-advance-search-default" data-show-adv="default">
                            <form class="geodir-listing-search gd-search-bar-style" name="geodir-listing-search" action="#" method="get">
                                <div class="geodir-loc-bar">
                                    <div class="clearfix geodir-loc-bar-in">
                                        <div class="geodir-search">
                                            <div class='gd-search-input-wrapper gd-search-field-cpt gd-search-field-taxonomy gd-search-field-categories'>
                                                <select name="category" class="cat_select">
                                                    <option value="">Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}"{{ old('category', request()->input('category')) == $category->id ? ' selected' : '' }}>{{ $category->name_ar }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='gd-search-input-wrapper gd-search-field-search'> <span class="geodir-search-input-label"><i class="fas fa-search gd-show"></i><i class="fas fa-times geodir-search-input-label-clear gd-hide" title="Clear field"></i></span>
                                                <input class="search_text gd_search_text" name="search" value="{{ old('search', request()->input('search')) }}" type="text" placeholder="Search for" aria-label="Search for" autocomplete="off" />
                                            </div>
                                            <button class="geodir_submit_search" data-title="fas fa-search" aria-label="fas fa-search"><i class="fas fas fa-search" aria-hidden="true"></i><span class="sr-only">Search</span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="geodir-loop-container">
                            <ul class="geodir-category-list-view clearfix gridview_onethird geodir-listing-posts geodir-gridview gridview_onethird">
                                @foreach($shops as $shop)
                                    <li class="gd_place type-gd_place status-publish has-post-thumbnail">
                                        <div class="gd-list-item-left ">
                                            <div class="geodir-post-slider">
                                                <div class="geodir-image-container geodir-image-sizes-medium_large">
                                                    <div class="geodir-image-wrapper">
                                                        <ul class="geodir-post-image geodir-images clearfix">
                                                            <li>
                                                                @foreach(json_decode($shop['images'],true) as $img)
                                                                <a href='{{ route('shop', $shop->id) }}'>
                                                                    <img src="{{asset('storage/app/public/estate').'/'.$img}}" width="1440" height="960" class="geodir-lazy-load align size-medium_large" />
                                                                </a>
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="gd-list-item-right ">
                                            <div class="geodir-post-title">
                                                <h2 class="geodir-entry-title"> <a href=""></a></h2></div>

                                                <div class="gd-badge-meta gd-badge-alignleft" title="dfdfdfdf">
                                                    <div class="gd-badge" style="background-color:#103d6b;color:#ffffff;"><i class="fas fa-certificate"></i> <span class='gd-secondary'> الخي المدينة</span></div>
                                                </div>
                                            <br>
@if($shop->categories->position!=5)

                                                @foreach (json_decode($shop->property,true) as $pro)
                                                    <span
                                                        class="badge rounded-pill badge-soft-success font-size-14">{{ $pro['number'] }} {{ $pro['name'] }}</span>
                                                @endforeach
                                            @endif
                                            <div class="geodir-post-content-container">
                                                <div class="geodir_post_meta  geodir-field-post_content" style='max-height:120px;overflow:hidden;'>{{ $shop->short_description }} <a href='{{ route('shop', $shop->id) }}' class='gd-read-more  gd-read-more-fade'>Read more...</a></div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                            <div class="clear"></div>
                        </div>
{{--                        {{ $shops->appends(request()->query())->links('partials.pagination') }}--}}
                    </div>
                    <footer class="entry-footer"></footer>
                </article>
            </div>

    </div>



@endsection

@section('scripts')
<script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key=AIzaSyC698w-7CmAo27obPPuVwVcbtfyiO7Y61M&libraries=places&region=GB'></script>
<script defer>
	function initialize() {

		var mapOptions = {
			zoom: 5,
			minZoom: 2,
			maxZoom: 17,
			zoomControl:true,
			zoomControlOptions: {
  				style:google.maps.ZoomControlStyle.DEFAULT
			},
            center: new google.maps.LatLng(24.679917, 46.704359),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: false,
			panControl:false,
			mapTypeControl:false,
			scaleControl:false,
			overviewMapControl:false,
			rotateControl:false
	  	}
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var image = new google.maps.MarkerImage("{{asset('storage/app/public').'/location.png'}}", null, null, null, new google.maps.Size(45,52));
        var places = @json($mapShops);

        for(place in places)
        {
            place = places[place];
            if (place.latitude) {
                if (place.longitude) {
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(place.latitude, place.longitude),
                        icon: image,
                        map: map,
                        title: place.address
                    });
                    var infowindow = new google.maps.InfoWindow();
                    google.maps.event.addListener(marker, 'click', (function (marker, place) {
                        return function () {


                            infowindow.setContent(generateContent(place))
                            infowindow.open(map, marker);
                        }
                    })(marker, place));
                }
            }
        }
	}
	google.maps.event.addDomListener(window, 'load', initialize);

    function generateContent(place)
    {



        var content = `
            <div class="gd-bubble" style="">
                <div class="gd-bubble-inside">
                    <div class="geodir-bubble_desc">
                    <div class="geodir-bubble_image">
                        <div class="geodir-post-slider">
                            <div class="geodir-image-container geodir-image-sizes-medium_large ">
                                <div id="geodir_images_5de53f2a45254_189" class="geodir-image-wrapper" data-controlnav="1">
                                    <ul class="geodir-post-image geodir-images clearfix">
                                        <li>
                                            <div class="geodir-post-title">
                                                <h4 class="geodir-entry-title">
                                                    <a href="{{ route('shop', '') }}/`+place.id+`" title="View: `+place.categories.name+`">`+place.categories.name+`</a>
                                                </h4>
                                            </div>

                                            <a href="{{ route('shop', '') }}/`+place.id+`"><img src="https://pdm.sa/images/logo3.png" alt="`+place.name+`" class="align size-medium_large" width="1400" height="930"></a>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="geodir-bubble-meta-side">
                    <div class="geodir-output-location">
                    <div class="geodir-output-location geodir-output-location-mapbubble">
                        <div class="geodir_post_meta  geodir-field-post_title"><span class="geodir_post_meta_icon geodir-i-text">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Place Title: </span></span>`+place.name+`</div>
                        <div class="geodir_post_meta  geodir-field-address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <span class="geodir_post_meta_icon geodir-i-address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Address: </span></span><span itemprop="streetAddress">`+place.address+`</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            </div>`;

    return content;

    }
</script>
@endsection
