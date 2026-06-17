@php($announcement=getWebConfig(name: 'announcement'))
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<meta name="csrf-token" content="{{ csrf_token() }}">

<header class="rtl __inline-10">
    <div class="topbar">
        <div class="container">

            <div>
                <div class="topbar-text dropdown d-md-none ms-auto">
                    <a class="topbar-link direction-ltr" href="tel: {{$web_config['phone']->value}}">
                        <i class="fa fa-phone"></i> {{$web_config['phone']->value}}
                    </a>
                </div>
                <div class="d-none d-md-block mr-2 text-nowrap">
                    <a class="topbar-link d-none d-md-inline-block direction-ltr" href="tel:{{$web_config['phone']->value}}">
                        <i class="fa fa-phone"></i> {{$web_config['phone']->value}}
                    </a>
                </div>
            </div>

            <div>
                @php($currency_model = getWebConfig(name: 'currency_model'))
                @if($currency_model=='multi_currency')
                    <div class="topbar-text dropdown disable-autohide mr-4">
                        <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                            <span>{{session('currency_code')}} {{session('currency_symbol')}}</span>
                        </a>
                        <ul class="text-align-direction dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} min-width-160px">
                            @foreach (\App\Models\Currency::where('status', 1)->get() as $key => $currency)
                                <li class="dropdown-item cursor-pointer get-currency-change-function"
                                    data-code="{{$currency['code']}}">
                                    {{ $currency->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="topbar-text dropdown disable-autohide __language-bar text-capitalize">
                    <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                        @if(App::getLocale() == 'ar')
                            <img class="mr-2" width="20" src="{{ asset('public/assets/front-end/png/flag.png') }}" alt="Arabic">
                            Arabic
                        @else
                            <img class="mr-2" width="20" src="{{ asset('public/assets/front-end/img/flags/en.png') }}" alt="English">
                            English
                        @endif
                    </a>
                    <ul class="text-align-direction dropdown-menu dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}">
                        <li>
                            <form method="POST" action="{{ route('change') }}" id="change-en">
                                @csrf
                                <input type="hidden" name="language_code" value="en">
                                <button type="submit" class="dropdown-item pb-1">
                                    <img class="mr-2" width="20" src="{{ asset('public/assets/front-end/img/flags/en.png') }}" alt="English"/>
                                    <span class="text-capitalize">English</span>
                                </button>
                            </form>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('change') }}" id="change-ar">
                                @csrf
                                <input type="hidden" name="language_code" value="ar">
                                <button type="submit" class="dropdown-item pb-1">
                                    <img class="mr-2" width="20" src="{{ asset('public/assets/front-end/png/flag.png') }}" alt="Arabic"/>
                                    <span class="text-capitalize">Arabic</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </div>


    <div class="navbar-sticky bg-light mobile-head">
        <div class="navbar navbar-expand-md navbar-light">
            <div class="container ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand d-none d-sm-block mr-3 flex-shrink-0 __min-w-7rem"
                   href="{{route('zones-main')}}">
                    <img class="__inline-11"
                         src="{{ asset('public/assets/images/logo_web.png') }}"
                         alt="{{$web_config['name']->value}}">
                </a>
                <a class="navbar-brand d-sm-none"
                   href="{{route('zones-main')}}">
                    <img class="mobile-logo-img __inline-12"
                        src="{{ asset('public/assets/images/logo_web.png') }}"
                         alt="{{$web_config['name']->value}}"/>
                </a>
                
                
                

                <div class="input-group-overlay mx-lg-4 search-form-mobile text-align-direction">
                    <form action="{{route('search')}}" type="submit" class="search_form">
                        <div class="d-flex align-items-center gap-2">
                            <input class="form-control appended-form-control search-bar-input" type="search"
                                   autocomplete="off" data-given-value=""
                                   placeholder="{{ translate("search for items")}}..."
                                   name="name" value="{{ request('name') }}">

                            <button class="input-group-append-overlay search_button d-none d-md-block" type="submit">
                                    <span class="input-group-text __text-20px">
                                        <i class="czi-search text-white"></i>
                                    </span>
                            </button>

                            <span class="close-search-form-mobile fs-14 font-semibold text-muted d-md-none" type="submit">
                                {{ translate('cancel') }}
                            </span>
                        </div>

                        <input name="data_from" value="search" hidden>
                        <input name="page" value="1" hidden>
                        <diV class="card search-card mobile-search-card">
                            <div class="card-body">
                                <div class="search-result-box __h-400px overflow-x-hidden overflow-y-auto"></div>
                            </div>
                        </diV>
                    </form>
                </div>

                <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                    <a class="navbar-tool navbar-stuck-toggler" href="#">
                        <span class="navbar-tool-tooltip">{{ translate('expand_Menu') }}</span>
                        <div class="navbar-tool-icon-box">
                            <i class="navbar-tool-icon czi-menu open-icon"></i>
                            <i class="navbar-tool-icon czi-close close-icon"></i>
                        </div>
                    </a>
                    
                    
                    
                    <div class="navbar-tool open-search-form-mobile d-lg-none {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}">
                        <a class="navbar-tool-icon-box bg-secondary" href="javascript:">
                            <i class="tio-search"></i>
                        </a>
                    </div>
                    
                    
                    <div class="navbar-tool dropdown d-none d-md-block {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}">
                        <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{route('view-wishlist')}}">
                            <span class="navbar-tool-label">
                                <span class="countWishlist">
                                 
                                    {{ auth()->user() ? auth()->user()->wishlist()->count() : 0 }}
                                    
                                </span>
                           </span>
                            <i class="navbar-tool-icon czi-heart"></i>
                        </a>
                    </div>




                    <!--<div class="dropdown">-->
                    <!--    <a class="navbar-tool ml-3" href=""-->
                    <!--    id="verificationButton2"  type="button" aria-haspopup="true" aria-expanded="false">-->
                    <!--        <div class="navbar-tool-icon-box bg-secondary" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">-->
                                <!-- أيقونة إضافة على شكل مربع -->
                    <!--            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                    <!--                <rect width="24" height="24" rx="4" fill="#1b4b7c"/>-->
                    <!--                <path d="M12 7V17M7 12H17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
                    <!--            </svg>-->
                    <!--        </div>-->
                    <!--    </a>-->
                    <!--</div>-->











                    @if(auth('customer')->check())
                    <div class="dropdown">
                        <a class="navbar-tool ml-3" type="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="navbar-tool-icon-box bg-secondary">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <img class="img-profile rounded-circle __inline-14" alt=""
                                    src="{{asset('storage/app/public/profile/'.auth('customer')->user()->image)}}"
                                    onerror="this.src='{{asset('storage/app/public/profile/default_avatar.png')}}'">

                                </div>
                            </div>

                            <div class="navbar-tool-text">
                                <small>{{ translate('hello')}}, {{auth('customer')->user()->name}}</small>
                                {{ translate('my account')}}
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                             aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"
                               href="{{route('account-estate') }}"> {{ translate('my properties')}} </a>
                            <a class="dropdown-item"
                               href="{{route('user-account')}}"> {{ translate('my Profile')}}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="{{route('customer.auth.logout')}}">{{ translate('logout')}}</a>
                        </div>
                    </div>
                @else
                    <div class="dropdown">
                        <a class="navbar-tool {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}"
                           type="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="navbar-tool-icon-box bg-secondary">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.25 4.41675C4.25 6.48425 5.935 8.16675 8 8.16675C10.0675 8.16675 11.75 6.48425 11.75 4.41675C11.75 2.34925 10.0675 0.666748 8 0.666748C5.9325 0.666748 4.25 2.34925 4.25 4.41675ZM14.6667 16.5001H15.5V15.6667C15.5 12.4509 12.8825 9.83341 9.66667 9.83341H6.33333C3.11667 9.83341 0.5 12.4509 0.5 15.6667V16.5001H14.6667Z"
                                              fill="#1B7FED"/>
                                    </svg>

                                </div>
                            </div>
                        </a>
                        <div class="text-align-direction dropdown-menu __auth-dropdown dropdown-menu-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                             aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href=" {{ route("customer.auth.login") }}">
                                <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in')}}
                            </a>
                            <div class="dropdown-divider"></div>
                            
                            
                             <a class="dropdown-item" href=" {{ route("customer.auth.sign-up") }}">
                                <i class="fa fa-sign-in mr-2"></i> تسجيل جديد
                            </a>

                        </div>
                    </div>
                @endif








                <div class="dropdown">
                    <a class="navbar-tool ml-3" href="{{ route('map') }}" type="button" aria-haspopup="true" aria-expanded="false">
                        <div class="navbar-tool-icon-box bg-secondary" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                            <!-- أيقونة إضافة على شكل مربع -->

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" rx="4" fill="#1b4b7c"/>
                                <path d="M2.3 3.38L8.5 2.23L15.38 4.23L21.3 3.5V20.2L15.18 21.72L8.35 19.9L2.3 21V3.38ZM9.05 4.37L9.05 19.13L15.33 20.95L15.33 6.19L9.05 4.37Z" fill="white"/>
                            </svg>

                        </div>
                    </a>
                </div>



                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-md navbar-stuck-menu">
            <div class="container px-10px">
                <div class="collapse navbar-collapse text-align-direction" id="navbarCollapse">
                    <div class="w-100 d-md-none text-align-direction">
                        <!--<button class="navbar-toggler p-0" type="button" data-toggle="collapse"-->
                        <!--        data-target="#navbarCollapse">-->
                        <!--    <i class="tio-clear __text-26px"></i>-->
                        <!--</button>-->
                        
<!--                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">-->
<!--    <i class="tio-clear __text-26px"></i>-->
<!--</button>-->

            
            
             <button id="custom-close-btn" class="navbar-toggler p-0" type="button">
            <i class="tio-clear __text-26px"></i>
        </button>            
                        
                    </div>

                    <ul class="navbar-nav d-block d-md-none">
                        <li class="nav-item dropdown {{request()->is('/')?'active':''}}">
                            <a class="nav-link" href="{{route('zones-main')}}">{{ translate('home')}}</a>
                        </li>
                    </ul>

                    @php($categories = \App\Utils\CategoryManager::getCategoriesWithCountingAndPriorityWiseSorting(dataLimit: 11))

                    <ul class="navbar-nav mega-nav pr-lg-2 pl-lg-2 mr-2 d-none d-md-block __mega-nav">
                        <li class="nav-item {{!request()->is('/')?'dropdown':''}}">

                            <a class="nav-link dropdown-toggle category-menu-toggle-btn ps-0"
                               href="javascript:">
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M9.875 12.9195C9.875 12.422 9.6775 11.9452 9.32563 11.5939C8.97438 11.242 8.4975 11.0445 8 11.0445C6.75875 11.0445 4.86625 11.0445 3.625 11.0445C3.1275 11.0445 2.65062 11.242 2.29937 11.5939C1.9475 11.9452 1.75 12.422 1.75 12.9195V17.2945C1.75 17.792 1.9475 18.2689 2.29937 18.6202C2.65062 18.972 3.1275 19.1695 3.625 19.1695H8C8.4975 19.1695 8.97438 18.972 9.32563 18.6202C9.6775 18.2689 9.875 17.792 9.875 17.2945V12.9195ZM19.25 12.9195C19.25 12.422 19.0525 11.9452 18.7006 11.5939C18.3494 11.242 17.8725 11.0445 17.375 11.0445C16.1337 11.0445 14.2413 11.0445 13 11.0445C12.5025 11.0445 12.0256 11.242 11.6744 11.5939C11.3225 11.9452 11.125 12.422 11.125 12.9195V17.2945C11.125 17.792 11.3225 18.2689 11.6744 18.6202C12.0256 18.972 12.5025 19.1695 13 19.1695H17.375C17.8725 19.1695 18.3494 18.972 18.7006 18.6202C19.0525 18.2689 19.25 17.792 19.25 17.2945V12.9195ZM16.5131 9.66516L19.1206 7.05766C19.8525 6.32578 19.8525 5.13828 19.1206 4.4064L16.5131 1.79891C15.7813 1.06703 14.5937 1.06703 13.8619 1.79891L11.2544 4.4064C10.5225 5.13828 10.5225 6.32578 11.2544 7.05766L13.8619 9.66516C14.5937 10.397 15.7813 10.397 16.5131 9.66516ZM9.875 3.54453C9.875 3.04703 9.6775 2.57015 9.32563 2.2189C8.97438 1.86703 8.4975 1.66953 8 1.66953C6.75875 1.66953 4.86625 1.66953 3.625 1.66953C3.1275 1.66953 2.65062 1.86703 2.29937 2.2189C1.9475 2.57015 1.75 3.04703 1.75 3.54453V7.91953C1.75 8.41703 1.9475 8.89391 2.29937 9.24516C2.65062 9.59703 3.1275 9.79453 3.625 9.79453H8C8.4975 9.79453 8.97438 9.59703 9.32563 9.24516C9.6775 8.89391 9.875 8.41703 9.875 7.91953V3.54453Z"
                                          fill="currentColor"/>
                                </svg>
                                <span class="category-menu-toggle-btn-text">
                                قائمة مزدي الخدمة
                                </span>
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mega-nav1 pr-md-2 pl-md-2 d-block d-xl-none">
                        <li class="nav-item dropdown d-md-none">
                            <a class="nav-link dropdown-toggle ps-0"
                               href="javascript:" data-toggle="dropdown">
                                <i class="czi-menu align-middle mt-n1 me-2"></i>
                                <span class="me-4">
                                           قائمة مزدي الخدمة
                                </span>
                            </a>
                            <ul class="dropdown-menu __dropdown-menu-2 text-align-direction">
                                @php($categoryIndex=0)
                                @foreach($categories as $category)
                                    @php($categoryIndex++)
                                    @if($categoryIndex < 10)
                                        <li class="dropdown">

                                            <a <?php if ($category->childes->count() > 0) echo "" ?>
                                               href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                                                <span>{{$category['name']}}</span>

                                            </a>
                                            @if ($category->childes->count() > 0)
                                                <a data-toggle='dropdown' class='__ml-50px'>
                                                    <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} __inline-16"></i>
                                                </a>
                                            @endif

                                            @if($category->childes->count()>0)
                                                <ul class="dropdown-menu text-align-direction">
                                                    @foreach($category['childes'] as $subCategory)
                                                        <li class="dropdown">
                                                            <a href="{{route('products',['id'=> $subCategory['id'],'data_from'=>'category','page'=>1])}}">
                                                                <span>{{$subCategory['name']}}</span>
                                                            </a>

                                                            @if($subCategory->childes->count()>0)
                                                                <a class="header-subcategories-links"
                                                                   data-toggle='dropdown'>
                                                                    <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} __inline-16"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    @foreach($subCategory['childes'] as $subSubCategory)
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                               href="{{route('products',['id'=> $subSubCategory['id'],'data_from'=>'category','page'=>1])}}">{{$subSubCategory['name']}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                                <li class="__inline-17">
                                    <div>
                                     <a class="dropdown-item web-text-primary" href="#" data-bs-toggle="modal" data-bs-target="#comingSoonModal">
    عرض الكل 
</a>

                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item dropdown d-none d-md-block {{request()->is('/')?'active':''}}">
                            <a class="nav-link" href="{{route('zones-main')}}">{{ translate('home')}}</a>
                        </li>

                        @if(getWebConfig(name: 'product_brand'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                   data-toggle="dropdown">{{ __('messages.brand') }}</a>
                                <ul class="text-align-direction dropdown-menu __dropdown-menu-sizing dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} scroll-bar">
                                    @php($brandIndex=0)
                                    @foreach(\App\Utils\BrandManager::getActiveBrandWithCountingAndPriorityWiseSorting() as $brand)
                                        @php($brandIndex++)
                                        @if($brandIndex < 10)
                                            <li class="__inline-17">
                                                <div>
                                                    <a class="dropdown-item"
                                                       href="{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}">
                                                        {{$brand['name']}}
                                                    </a>
                                                </div>
                                                <div class="align-baseline">
                                                    @if($brand['brand_products_count'] > 0 )
                                                        <span class="count-value px-2">( {{ $brand['brand_products_count'] }} )</span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li class="__inline-17">
                                        <div>
                                            <a class="dropdown-item web-text-primary" href="{{route('brands')}}">
                                            عرض الكل 
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endif


                        @php($businessMode = getWebConfig(name: 'business_mode'))
                        @if ($businessMode == 'multi')
                            <li class="nav-item dropdown {{request()->is('/')?'active':''}}">
                                <a class="nav-link text-capitalize"
                                   href="{{route('zones-main')}}">{{ translate('zones')}}</a>
                            </li>
                        @endif

                        @if(auth('customer')->check())
                            <li class="nav-item d-md-none">
                                <a href="{{route('user-account')}}" class="nav-link text-capitalize">
                                    {{ translate('user_profile')}}
                                </a>
                            </li>
       <li class="nav-item d-md-none">
    <a href="{{ route('view-wishlist') }}" class="nav-link d-flex align-items-center">
        {{ translate('wishlist') }}
        <span class="ms-2 bg-primary text-white rounded-circle d-inline-block text-center" style="width: 24px; height: 24px; line-height: 24px; font-size: 12px;">
            {{ auth()->check() ? auth()->user()->wishlist()->count() : 0 }}
        </span>
    </a>
</li>


                        @else
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item pl-2" href="{{route('customer.auth.login')}}">
                                    <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in')}}
                                </a>
                                <div class="dropdown-divider"></div>
                            </li>
                            
                            
                        <li class="nav-item d-md-none">
    <a class="dropdown-item pl-2" href="{{ route("customer.auth.sign-up") }}">
        <i class="fa fa-user-plus mr-2"></i> تسجيل جديد
    </a>
    <div class="dropdown-divider"></div>
</li>


                        @endif

                        @if ($businessMode == 'multi')
                            @if(getWebConfig(name: 'seller_registration'))
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle text-white text-max-md-dark text-capitalize ps-2"
                                                type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ translate('service providers')}}
                                        </button>
                                        <div class="dropdown-menu __dropdown-menu-3 __min-w-165px text-align-direction"
                                             aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item text-capitalize" href="{{route('customer.auth.about-provider')}}">
                                                {{ translate('about service')}}
                                            </a>


                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{route('customer.auth.provider')}}">
                                                {{ translate('Join_as_a_service_provider')}}
                                            </a>

                                            <a class="dropdown-item" href="{{route('role.showLogin')}}">
                                                {{ translate('Service Provider Management')}}
                                            </a>
                                        </div>


                                        
                                    </div>
                                </li>
                            @endif
                        @endif
                    </ul>
                    @if(auth('customer')->check())
                        <div class="logout-btn mt-auto d-md-none">
                            <hr>
                            <a href="{{route('customer.auth.logout')}}" class="nav-link">
                                <strong class="text-base">{{ translate('logout')}}</strong>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="megamenu-wrap">
            <div class="container">
                <div class="category-menu-wrap">
                    <ul class="category-menu">
                        @foreach ($categories as $key=>$category)
                            <li>
                                <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{$category->name}}</a>
                                @if ($category->childes->count() > 0)
                                    <div class="mega_menu z-2">
                                        @foreach ($category->childes as $sub_category)
                                            <div class="mega_menu_inner">
                                                <h6>
                                                    <a href="{{route('products',['id'=> $sub_category['id'],'data_from'=>'category','page'=>1])}}">{{$sub_category->name}}</a>
                                                </h6>
                                                @if ($sub_category->childes->count() >0)
                                                    @foreach ($sub_category->childes as $sub_sub_category)
                                                        <div>
                                                            <a href="{{route('products',['id'=> $sub_sub_category['id'],'data_from'=>'category','page'=>1])}}">{{$sub_sub_category->name}}</a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endforeach
                        <li class="text-center">
                            <!--<a href="{{route('categories')}}" class="text-primary font-weight-bold justify-content-center">-->
                            <!--    {{ translate('View_All') }}-->
                            <!--</a>-->
                            
                                                               <a  class="text-primary font-weight-bold justify-content-center" href="#" data-bs-toggle="modal" data-bs-target="#comingSoonModal">
    {{ __('view_more') }}
</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>





    <div class="modal fade" id="verificationModal2" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verificationModalLabel">التحقق من الحساب عبر نفاذ</h5>
                    <!-- زر إغلاق الـ Modal -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ translate('Close') }}"></button>
                </div>
                <div class="modal-body">


                    <input type="hidden" id="user_id" class="form-control" readonly value="{{ auth('customer')->user()->id ??"" }}">
                    <label for="identity_number" class="form-label">{{ translate('Enter Your ID Number') }}</label>
                    <input type="text" class="form-control" id="identity_number" placeholder="{{ translate('Enter ID Number') }}">

                    <div id="loadingIndicator" style="display: none;">
                        <p>{{ __('Loading...') }}</p>
                        <!-- يمكنك استخدام أيقونة تحميل هنا، على سبيل المثال -->
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">{{ __('Loading...') }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" style="background-color: #001f3f; border-color: #001f3f;" class="btn btn-primary" id="verifyButton">{{ translate('Verify') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to display random value -->
    <div class="modal fade" id="randomValueModal" tabindex="-1" aria-labelledby="randomValueModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="randomValueModalLabel">{{ translate('Verification Result') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ translate('Close') }}"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <!-- دائرة لعرض الرقم بلون كحلي وحجم أصغر -->
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center"
                         style="width: 60px; height: 60px; font-size: 18px; background-color: #001f3f;">
                        <p id="randomValueText" class="mb-0"></p>


                    </div>















                    {{-- <p id="idNumber" class="mb-0"></p> --}}
                </div>



                <input type="hidden" id="idNumber" class="form-control">

                <input type="hidden" id="transId" class="form-control">

                <input type="hidden" id="user_id" class="form-control" value="{{auth('customer')->user()->id ??"" }}">
                <div class="modal-footer">
                    <!-- زر تأكيد عريض وأقصر طولا -->
                    {{-- <button type="button"  class="btn btn-success" id="confirmButton" style="width: 100%; height: 40px; font-size: 14px; background-color: #001f3f;">
                        {{ translate('Confirm') }}
                    </button> --}}
                </div>
            </div>
        </div>
    </div>





<div class="modal fade" id="comingSoonModal" tabindex="-1" aria-labelledby="comingSoonModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header" style="background-color: #001f3f; color: white;">
        <h5 class="modal-title d-flex align-items-center" id="comingSoonModalLabel" style="font-size: 1.5rem;">
          <i class="bi bi-hourglass-split me-2" style="font-size: 1.8rem;"></i> تنبيه
        </h5>
        <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body" style="font-size: 1.6rem;">
        <i class="bi bi-clock-history d-block mb-3" style="color: #001f3f; font-size: 2rem;"></i>
        قريبًا
      </div>
      <div class="modal-footer">
        <button type="button" class="btn px-4" style="background-color: #001f3f; color: white; font-size: 1.3rem;" data-bs-dismiss="modal">
          حسنا
        </button>
      </div>
    </div>
  </div>
</div>




@push('script')
<!-- Bootstrap 5 لا يعتمد على jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function() {
        // عند النقر على الزر
        $('#verificationButton2').click(function(e) {
            e.preventDefault(); // منع السلوك الافتراضي للرابط

            // التحقق من قيمة account_verification

             @if(auth('customer')->check())
            @if(auth('customer')->user()->account_verification == 0)
                // فتح الـ Modal
                $('#verificationModal2').modal('show');
            @else
//$('#verificationModal2').modal('show');

             window.location.href = '{{ route("add-license") }}';
            @endif
                    @else

                      window.location.href = '{{ route("customer.auth.login") }}';



                     @endif
        });



    });
</script>
    <script>
        "use strict";

        $(".category-menu").find(".mega_menu").parents("li")
            .addClass("has-sub-item").find("> a")
            .append("<i class='czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}'></i>");




               $(document).ready(function() {




// Function to get a specific cookie by name
                function getCookie(name) {
                    let value = "; " + document.cookie;
                    let parts = value.split("; " + name + "=");
                    if (parts.length === 2) return parts.pop().split(";").shift();
                }

// When the verify button is clicked
                $('#verifyButton').click(function() {
                    let idNumber = $('#identity_number').val();
                    let userId = $('#user_id').val();
                    let token = getCookie('BearerToken'); // Get the token from cookies

                    // Show loading indicator
                    $('#loadingIndicator').show();

                    // Send AJAX request
                    $.ajax({
                        url: '{{ route("nafath-validation") }}',
                        type: 'POST',
                        data: {
                            id_number: idNumber,
                            user_id : userId
                        },
                        headers: {
                            'Authorization': 'Bearer ' + token,  // Authorization Bearer token
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // CSRF token
                        },
                        success: function(response) {
                            // Hide loading indicator
                            $('#loadingIndicator').hide();

                            // Extract the random value from the response
                            let randomValue = response.random;

                            let transId = response.transId;

                            // Set the random value in the second modal
                            $('#randomValueText').text( randomValue);

                            $('#transId').val( transId);

                            $('#idNumber').val( idNumber);


                            $('#user_id').val( userId);





                            // Hide the verification modal
                            $('#verificationModal2').modal('hide');

                            // Show the random value modal
                            $('#randomValueModal').modal('show');
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            console.error('Error:', error);
                            $('#loadingIndicator').hide();  // Hide loading indicator on failure
                            alert('An error occurred: ' + xhr.responseJSON.message); // Show error message
                        }
                    });
                });



                // $('#confirmButton').on('click', function() {
                //     // اجمع البيانات التي تريد إرسالها
                //     var nationalId = $('#idNumber').val();
                //     var transId = $('#transId').val();
                //     var random = $('#randomValueText').text();
                //     var user_id = $('#user_id').val();

                //     $('#confirmButton').prop('disabled', true);
                //     $('#loading').show();


                //     $.ajax({
                //         url: '{{ route("check-request-status") }}',
                //         method: 'POST',
                //         data: {
                //             nationalId: nationalId,
                //             transId: transId,
                //             random: random,
                //             user_id : user_id,
                //             _token: '{{ csrf_token() }}' // إضافة CSRF token
                //         },
                //         success: function(response) {
                //             $('#loading').hide();
                //             $('#confirmButton').prop('disabled', false);
                //             // التعامل مع الاستجابة الناجحة
                //             if (response.message === 'COMPLETED') {


                //                 window.location.href = '{{ route("add-license") }}';
                //             } else {
                //                 alert('التحقق لم يكتمل بعد.');
                //             }
                //         },
                //         error: function(xhr, status, error) {

                //             $('#loading').hide();
                //             $('#confirmButton').prop('disabled', false);
                //             // التعامل مع الأخطاء
                //             alert('حدث خطأ أثناء معالجة الطلب.');
                //             console.log(xhr.responseText);
                //         }
                //     });
                // });



            });

            $(document).ready(function () {
    function checkRequestStatus() {
        var nationalId = $('#idNumber').val();
        var transId = $('#transId').val();
        var random = $('#randomValueText').text();
        var user_id = $('#user_id').val();

        if (!nationalId || !transId || !random || !user_id) {
            console.log("البيانات غير مكتملة، التحقق لم يتم إرساله.");
            return;
        }

        $('#confirmButton').prop('disabled', true);
        $('#loading').show();

        $.ajax({
            url: '{{ route("check-request-status") }}',
            method: 'POST',
            data: {
                nationalId: nationalId,
                transId: transId,
                random: random,
                user_id: user_id,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#loading').hide();
                $('#confirmButton').prop('disabled', false);

                if (response.message === 'COMPLETED') {
                    console.log("✅ التحقق ناجح، سيتم التوجيه...");
                    window.location.href = '{{ route("add-license") }}';
                } else {
                    console.log("⚠️ التحقق لم يكتمل بعد.");
                }
            },
            error: function (xhr, status, error) {
                $('#loading').hide();
                $('#confirmButton').prop('disabled', false);
                console.log("❌ حدث خطأ أثناء المعالجة:", xhr.responseText);
            }
        });
    }

    // تشغيل التحقق كل 3 ثوانٍ
    var interval = setInterval(checkRequestStatus, 3000);
});

    </script>



<script>
    $(document).on('keyup', '.search-bar-input', function () {
        let query = $(this).val();
        $.ajax({
            url: "{{ route('search') }}",
            type: "GET",
            data: { name: query },
            success: function (response) {
                let results = response.estates;
                let html = '';

                if (results.length > 0) {
                    results.forEach(function (estate) {
                        // استخراج الصورة الأولى من المصفوفة
                        let imageArray = JSON.parse(estate.images || '[]'); // تأكد من أن الصور موجودة
                        let imageUrl = imageArray.length > 0
                            ? `{{ asset('storage/app/public/estate/') }}/${imageArray[0]}`
                            : `{{asset("public/assets/images/default-estate.jpg")}}`; // صورة افتراضية إذا لم تكن هناك صور

                        html += `
                        <div class="card search-result-item">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="${imageUrl}" class="img-fluid" alt="Estate Image" width="100%" height="200">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${estate.category_name}</h5>
                                        <p class="card-text"><i class="fas fa-map-marker-alt"></i> ${estate.city} العنوان ${estate.address}  </p>
                                        <p class="card-text"><strong>السعر:</strong> ${estate.price} ريال</p>
                                        <a href="/details/${estate.id}" class="btn btn-primary btn-sm">عرض التفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });
                } else {
                    html = '<p class="text-center text-muted">لا توجد نتائج مطابقة.</p>';
                }

                $('.search-result-box').html(html);
            }
        });
    });
</script>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const closeBtn = document.getElementById('custom-close-btn');
        const collapseElement = document.getElementById('navbarCollapse');

        closeBtn.addEventListener('click', function () {
            const bsCollapse = bootstrap.Collapse.getInstance(collapseElement);

            if (bsCollapse) {
                bsCollapse.hide(); // يغلق القائمة إذا كانت مفتوحة
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const closeBtn = document.getElementById('custom-close-btn');
        const collapseElement = $('#navbarCollapse');

        closeBtn.addEventListener('click', function () {
            collapseElement.collapse('hide'); // Bootstrap 4 jQuery
        });
    });
</script>




@endpush
