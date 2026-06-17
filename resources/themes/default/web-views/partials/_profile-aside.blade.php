<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="col-lg-3">
    <div class="profile-aside-overlay d-lg-none"></div>
    <div class="__customer-sidebar user-profile-aside" id="shop-sidebar">
        <div class="d-flex justify-content-end d-lg-none">
            <button class="profile-aside-close-btn btn"><i class="tio-clear fs-5"></i></button>
        </div>
        <div>
            <div>
                <div class="widget-title">
                    <a class="{{Request::is('user-account*')?'active-menu':''}}" href="{{route('user-account')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <g clip-path="url(#clip0_776_10768)">
                                <path d="M10 0.000488281C4.47773 0.000488281 0 4.47734 0 10C0 15.5228 4.47729 19.9996 10 19.9996C15.5231 19.9996 20 15.5228 20 10C20 4.47734 15.5231 0.000488281 10 0.000488281ZM10 2.99047C11.8273 2.99047 13.308 4.47163 13.308 6.29804C13.308 8.12488 11.8273 9.6056 10 9.6056C8.17359 9.6056 6.69288 8.12488 6.69288 6.29804C6.69288 4.47163 8.17359 2.99047 10 2.99047ZM9.9978 17.3852C8.17535 17.3852 6.50619 16.7215 5.21875 15.6229C4.90512 15.3554 4.72415 14.9632 4.72415 14.5516C4.72415 12.6992 6.22332 11.2168 8.07608 11.2168H11.9248C13.778 11.2168 15.2715 12.6992 15.2715 14.5516C15.2715 14.9636 15.0914 15.355 14.7773 15.6225C13.4903 16.7215 11.8207 17.3852 9.9978 17.3852Z" fill="currentColor"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_776_10768">
                                <rect width="20" height="20" fill="currentColor"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span class="aside-link">
                            {{translate('profile_info')}}
                        </span>
                    </a>
                </div>
            </div>






                <div class="widget-title">
                    <a class="{{(Request::is('/create-estate') || Request::is('user-coupons*')) ? 'active-menu' : ''}}" id="verificationButton3"
                       href="" >
                        <span>
                            <!-- أيقونة جديدة تمثل إضافة عقار -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 0L0 10h3v10h4v-6h6v6h4V10h3L10 0z" fill="currentColor"/>
                            </svg>
                        </span>
                        <span class="aside-link">{{ translate('Add a new ad') }}</span>
                    </a>
                </div>





            <div class="widget-title">
                <a class="{{Request::is('account-estate*') || Request::is('account-order-details*') || Request::is('track-order*') ? 'active-menu' :''}}" href="{{route('account-estate') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2917 2.49984V18.3332C17.2917 18.5648 17.1633 18.7773 16.9583 18.8857C16.7533 18.994 16.5058 18.9798 16.3142 18.849L14.235 17.4298L12.2692 18.8407C12.0333 19.0107 11.7117 18.9948 11.4933 18.8032L10 17.4973L8.50666 18.8032C8.28833 18.9948 7.96666 19.0107 7.73083 18.8407L5.765 17.4298L3.68583 18.849C3.49416 18.9798 3.24666 18.994 3.04166 18.8857C2.83666 18.7773 2.70833 18.5648 2.70833 18.3332V2.49984C2.70833 1.69484 3.36083 1.0415 4.16666 1.0415H15.8333C16.6392 1.0415 17.2917 1.69484 17.2917 2.49984ZM6.66666 8.95817H13.3333C13.6783 8.95817 13.9583 8.67817 13.9583 8.33317C13.9583 7.98817 13.6783 7.70817 13.3333 7.70817H6.66666C6.32166 7.70817 6.04166 7.98817 6.04166 8.33317C6.04166 8.67817 6.32166 8.95817 6.66666 8.95817ZM6.66666 5.62484H13.3333C13.6783 5.62484 13.9583 5.34484 13.9583 4.99984C13.9583 4.65484 13.6783 4.37484 13.3333 4.37484H6.66666C6.32166 4.37484 6.04166 4.65484 6.04166 4.99984C6.04166 5.34484 6.32166 5.62484 6.66666 5.62484ZM6.66666 12.2915H10C10.345 12.2915 10.625 12.0115 10.625 11.6665C10.625 11.3215 10.345 11.0415 10 11.0415H6.66666C6.32166 11.0415 6.04166 11.3215 6.04166 11.6665C6.04166 12.0115 6.32166 12.2915 6.66666 12.2915Z" fill="currentColor"/>
                    </svg>
                    <span class="aside-link">
                        {{translate('My ads')}}
                    </span>
                </a>
            </div>
        </div>







        {{-- {{route('wishlists')}} --}}


        <div>
            <div class="widget-title">
                <a class="{{Request::is('wishlists*')?'active-menu':''}}" href="{{route('view-wishlist') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <g clip-path="url(#clip0_776_10778)">
                        <path d="M10 20C15.5228 20 20 15.5228 20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10C0 15.5228 4.47715 20 10 20Z" fill="currentColor"/>
                        <path d="M15.3906 8.88909C15.243 9.72854 14.9023 10.4907 14.4418 11.2C13.8281 12.1457 13.0445 12.9297 12.1676 13.6293C11.6519 14.037 11.1127 14.414 10.5527 14.7582C10.2012 14.975 9.83984 14.9965 9.48711 14.7817C8.50508 14.1836 7.58594 13.5024 6.7707 12.6871C6.16992 12.086 5.65 11.4227 5.24414 10.6739C4.79883 9.85354 4.52539 8.97932 4.53125 8.03909C4.5375 7.06643 4.93281 6.27112 5.70625 5.67542C6.2832 5.23128 6.94336 5.03518 7.66797 5.07229C8.28008 5.10354 8.81602 5.35081 9.30039 5.70862C9.53125 5.87932 9.9832 6.28675 9.99063 6.29456C10.1859 6.12776 10.3723 5.95745 10.5707 5.80315C11.0215 5.45159 11.5141 5.18557 12.0875 5.10276C12.8895 4.98557 13.6191 5.18089 14.268 5.65823C14.8547 6.08251 15.2601 6.71219 15.4035 7.4219C15.5078 7.91018 15.475 8.4012 15.3906 8.88909Z" fill="white"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_776_10778">
                        <rect width="20" height="20" fill="white"/>
                        </clipPath>
                    </defs>
                    </svg>
                    <span class="aside-link">{{translate('wish_list')}}</span>
                </a>
            </div>
        </div>

        {{-- {{route('chat', ['type' => $business_mode == 'multi' ? 'vendor' : 'delivery-man'])}} --}}
        @php($business_mode = getWebConfig(name: 'business_mode'))
        <div>
            <div class="widget-title">
                <a class="{{Request::is('chat/vendor')?'active-menu': '' }} {{Request::is('chat/delivery-man')?'active-menu': '' }}" href="#">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <g clip-path="url(#clip0_776_10801)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0032 0.00341797C15.526 0.00341797 20.0032 4.47947 20.0032 10.0048C20.0032 15.5273 15.526 20.0034 10.0032 20.0034C4.48041 20.0034 0.00326538 15.5275 0.00326538 10.0048C0.00326538 4.47947 4.48069 0.00341797 10.0032 0.00341797ZM3.75323 13.7922L8.25713 9.92588L3.75514 6.06123C3.75389 6.07194 3.75324 6.08271 3.75319 6.0935L3.75323 13.7922ZM8.67315 10.2831L4.12803 14.185H15.8787L11.3332 10.2831L10.1794 11.2736C10.1299 11.3159 10.0668 11.339 10.0017 11.3386C9.93653 11.3382 9.8737 11.3144 9.82467 11.2715L8.67315 10.2831ZM11.7494 9.92588L16.2533 13.7922V6.0935C16.2534 6.08271 16.2527 6.07192 16.2512 6.06123L11.7494 9.92596L11.7494 9.92588ZM4.30834 5.82178L10.0032 10.7105L15.698 5.82178H4.30834Z" fill="currentColor"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_776_10801">
                            <rect width="20" height="20" fill="white"/>
                            </clipPath>
                        </defs>
                        </svg>
                    </span>
                    <span class="aside-link">{{translate('inbox')}}</span>
                </a>
            </div>
        </div>

        <div>
            <div class="widget-title">
                <a class="{{Request::is('account-address*')?'active-menu':''}}"
                    href="{{route('privacy-policy')}}"">
                    <span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1.25C6.90062 1.25 4.375 3.835 4.375 7.03125C4.375 8.74875 5.20937 10.5719 6.2375 12.1325C7.72125 14.3856 9.5775 16.085 9.5775 16.085C9.81688 16.3044 10.1831 16.3044 10.4225 16.085C10.4225 16.085 12.2788 14.3856 13.7625 12.1325C14.7906 10.5719 15.625 8.74875 15.625 7.03125C15.625 3.835 13.0994 1.25 10 1.25ZM10 3.75C11.7244 3.75 13.125 5.15062 13.125 6.875C13.125 8.59938 11.7244 10 10 10C8.27562 10 6.875 8.59938 6.875 6.875C6.875 5.15062 8.27562 3.75 10 3.75ZM10 5C8.965 5 8.125 5.84 8.125 6.875C8.125 7.91 8.965 8.75 10 8.75C11.035 8.75 11.875 7.91 11.875 6.875C11.875 5.84 11.035 5 10 5ZM6.21562 13.5631C6.17437 13.5656 6.13313 13.5731 6.09125 13.5837C5.065 13.8537 4.26375 14.2344 3.78062 14.6569C3.33562 15.0475 3.125 15.4919 3.125 15.9375C3.125 16.4719 3.44 17.0156 4.09938 17.4612C5.20625 18.2081 7.43062 18.75 10 18.75C12.5694 18.75 14.7937 18.2081 15.9006 17.4606C16.56 17.0156 16.875 16.4719 16.875 15.9375C16.875 15.4919 16.6644 15.0475 16.2194 14.6569C15.7363 14.2344 14.935 13.8537 13.9087 13.5837C13.5756 13.4956 13.2331 13.695 13.1456 14.0294C13.0575 14.3631 13.2575 14.705 13.5913 14.7925C14.2675 14.9712 14.8275 15.1944 15.2163 15.46C15.4431 15.6163 15.625 15.7512 15.625 15.9375C15.625 16.0319 15.5594 16.1125 15.4788 16.1975C15.3156 16.3688 15.0731 16.5225 14.7744 16.665C13.6975 17.1794 11.9581 17.5 10 17.5C8.04188 17.5 6.3025 17.1794 5.22563 16.665C4.92688 16.5225 4.68438 16.3688 4.52125 16.1975C4.44063 16.1125 4.375 16.0319 4.375 15.9375C4.375 15.7512 4.55687 15.6163 4.78375 15.46C5.1725 15.1944 5.7325 14.9712 6.40875 14.7925C6.7425 14.705 6.9425 14.3631 6.85438 14.0294C6.7775 13.7369 6.50562 13.5469 6.21562 13.5631Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <span class="aside-link">
                        {{ translate('privacy policy') }}
                    </span>
                </a>
            </div>
        </div>
        <div>
            {{-- {{ route('account-tickets') }} --}}
            <div class="widget-title">
                {{-- <a class="{{(Request::is('account-ticket*') || Request::is('support-ticket*'))?'active-menu':''}}" --}}

                <a href="javascript:void(0);" 
   data-toggle="modal" 
   data-target="#createTicketModal"
   class="{{(Request::is('account-ticket*') || Request::is('support-ticket*'))?'active-menu':''}}">
   
   


              
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2276 2.69576C8.80626 2.64842 7.37026 3.0362 6.13048 3.86376C4.73803 4.7942 3.76492 6.1682 3.3167 7.7042C3.19292 7.68909 3.0447 7.69576 2.8687 7.74553C2.21159 7.93198 1.71737 8.47042 1.49515 8.94464C1.20692 9.56264 1.08537 10.38 1.21359 11.2238C1.34092 12.0649 1.69626 12.7582 2.1407 13.1886C2.58648 13.6193 3.08981 13.7593 3.58981 13.6542C4.33426 13.4953 4.70337 13.3764 4.59915 12.6829L4.09448 9.32087C4.19626 7.50131 5.13826 5.78842 6.71381 4.73509C8.8227 3.32642 11.5876 3.41664 13.5991 4.96087C14.9985 6.03376 15.8109 7.64131 15.9047 9.32887L15.5518 11.6806C14.7647 13.8346 12.8134 15.3266 10.5554 15.5384H9.05181C8.66381 15.5384 8.35137 15.8509 8.35137 16.2384V16.6078C8.35137 16.9955 8.66381 17.308 9.05181 17.308H10.9476C11.3354 17.308 11.6465 16.9955 11.6465 16.6078V16.4146C13.3491 15.9991 14.8354 14.9526 15.8031 13.4933L16.4105 13.6544C16.9047 13.7826 17.414 13.6193 17.8596 13.1889C18.304 12.7582 18.6591 12.0651 18.7867 11.224C18.9154 10.3802 18.7903 9.5642 18.5054 8.94487C18.2194 8.32553 17.7934 7.9322 17.3016 7.79109C17.0956 7.73176 16.872 7.70998 16.6803 7.7042C16.2749 6.31531 15.4405 5.0522 14.2378 4.12998C13.0554 3.22264 11.6489 2.74242 10.2276 2.69576Z" fill="currentColor"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.4465 8.74397C12.9476 8.74397 13.3538 9.1502 13.3549 9.65264C13.3538 10.1538 12.9476 10.5611 12.4465 10.5611C11.944 10.5611 11.5367 10.1538 11.5367 9.65264C11.5367 9.15042 11.9443 8.74397 12.4465 8.74397ZM9.99982 8.74397C10.502 8.74397 10.9083 9.1502 10.9083 9.65264C10.9083 10.1538 10.502 10.5611 9.99982 10.5611C9.49715 10.5611 9.09093 10.1538 9.09093 9.65264C9.09093 9.15042 9.49715 8.74397 9.99982 8.74397ZM7.55404 8.74397C8.05515 8.74397 8.46249 9.1502 8.46249 9.65264C8.46249 10.1538 8.05515 10.5611 7.55404 10.5611C7.05182 10.5611 6.64537 10.1538 6.64537 9.65264C6.64537 9.15042 7.05182 8.74397 7.55404 8.74397ZM9.99982 4.84131C7.33537 4.84131 5.18826 6.91775 5.18826 9.65264C5.18826 10.9662 5.68493 12.1271 6.49404 12.9789L6.20693 14.266C6.11226 14.6895 6.40604 14.9744 6.78671 14.7624L8.0436 14.0613C8.64093 14.3206 9.3016 14.464 9.99982 14.464C12.6652 14.464 14.8109 12.3889 14.8109 9.65264C14.8109 6.91775 12.6652 4.84131 9.99982 4.84131Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <span class="aside-link">
                        {{translate('support_ticket')}}
                    </span>
                </a>
            </div>
        </div>








        {{-- <div>
            <div class="widget-title">
                <a class="" href="{{route('track-order.index') }}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4.96896 16.4421C4.2419 16.4421 3.65039 15.8507 3.65039 15.1236C3.65039 14.3965 4.2419 13.8051 4.96896 13.8051H10.0151C11.3237 13.8051 12.3884 12.7404 12.3884 11.4318C12.3884 10.1232 11.3237 9.05859 10.0151 9.05859H6.45639V10.1133H10.0151C10.7422 10.1133 11.3337 10.7048 11.3337 11.4319C11.3337 12.1589 10.7422 12.7504 10.0151 12.7504H4.96896C3.66034 12.7504 2.5957 13.815 2.5957 15.1236C2.5957 16.4322 3.66034 17.4968 4.96896 17.4968H13.5441V16.4421H4.96896Z" fill="currentColor"/>
                            <path d="M5.8857 4.04139C4.76801 2.9237 2.95592 2.9237 1.83827 4.04139C0.720578 5.15908 0.720578 6.97117 1.83827 8.08883L3.862 10.1126L5.8857 8.08883C7.00339 6.97114 7.00339 5.15904 5.8857 4.04139ZM3.84506 6.9311C3.35396 6.9311 2.95585 6.53299 2.95585 6.04189C2.95585 5.55079 3.35396 5.15265 3.84506 5.15265C4.33615 5.15265 4.7343 5.55076 4.7343 6.04189C4.7343 6.53299 4.33619 6.9311 3.84506 6.9311Z" fill="currentColor"/>
                            <path d="M18.1621 11.4242C17.0444 10.3065 15.2323 10.3065 14.1146 11.4242C12.9969 12.5419 12.9969 14.354 14.1146 15.4716L16.1384 17.4954L18.1621 15.4716C19.2798 14.354 19.2798 12.5419 18.1621 11.4242ZM16.1214 14.3139C15.6303 14.3139 15.2322 13.9158 15.2322 13.4247C15.2322 12.9336 15.6303 12.5355 16.1214 12.5355C16.6125 12.5355 17.0107 12.9336 17.0107 13.4247C17.0107 13.9158 16.6126 14.3139 16.1214 14.3139Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <span class="aside-link">{{translate('track_order')}}</span>
                </a>
            </div>
        </div> --}}

        <div class="d-lg-none">
            <div class="widget-title">
                <a class="d-flex align-items-center gap-2 customer-account-delete-by-route" href="javascript:"
                    data-route="{{ route('account-delete',[auth('customer')->id()]) }}"
                    data-message="{{translate('want_to_delete_this_account')}}?">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.26053 3.00537C7.26056 2.88415 7.30871 2.76789 7.39441 2.68215C7.48011 2.59641 7.59634 2.54819 7.71757 2.54811L12.2877 2.54785C12.4089 2.54813 12.5251 2.59648 12.6108 2.68229C12.6965 2.7681 12.7446 2.88438 12.7447 3.00563V4.13591H7.26053V3.00537ZM14.7747 18.3723C14.763 18.5506 14.6837 18.7176 14.5529 18.8392C14.4222 18.9609 14.2498 19.0279 14.0712 19.0267H5.88149C5.70294 19.0262 5.53119 18.9582 5.40071 18.8363C5.27024 18.7144 5.19071 18.5477 5.1781 18.3696L4.47728 8.11776H15.5227L14.7749 18.3722L14.7747 18.3723ZM16.5954 7.18926H3.41016V6.12712C3.41035 5.84542 3.52233 5.57531 3.7215 5.3761C3.92067 5.17689 4.19075 5.06486 4.47245 5.0646L15.533 5.06425C15.8146 5.06468 16.0846 5.17681 16.2838 5.37605C16.4829 5.57528 16.5948 5.84535 16.5951 6.12703V7.18916L16.5954 7.18926ZM7.87976 16.5828C7.87976 16.6437 7.89176 16.7041 7.91509 16.7604C7.93842 16.8167 7.97261 16.8679 8.01571 16.911C8.05882 16.9541 8.10999 16.9883 8.1663 17.0116C8.22262 17.0349 8.28298 17.0469 8.34394 17.0469C8.4049 17.0469 8.46526 17.0349 8.52158 17.0116C8.57789 16.9883 8.62907 16.9541 8.67217 16.911C8.71527 16.8679 8.74946 16.8167 8.77279 16.7604C8.79612 16.7041 8.80813 16.6437 8.80813 16.5828V10.0732C8.80715 9.95083 8.75785 9.83375 8.67095 9.74752C8.58405 9.66128 8.4666 9.61287 8.34418 9.61283C8.22176 9.61279 8.10427 9.66112 8.01732 9.74729C7.93036 9.83347 7.88098 9.95051 7.87992 10.0729V16.5828H7.87976ZM11.1917 16.5828C11.1917 16.7059 11.2406 16.824 11.3277 16.911C11.4147 16.9981 11.5328 17.047 11.6559 17.047C11.7791 17.047 11.8972 16.9981 11.9842 16.911C12.0713 16.824 12.1202 16.7059 12.1202 16.5828V10.0732C12.1192 9.95081 12.0699 9.83372 11.983 9.74747C11.8961 9.66122 11.7786 9.61281 11.6562 9.61277C11.5337 9.61272 11.4162 9.66106 11.3293 9.74725C11.2423 9.83343 11.1929 9.95049 11.1919 10.0729L11.1917 16.5828Z" fill="#F62A2E"/>
                        </svg>
                    </span>
                    <span class="text-capitalize aside-link">{{translate('delete_account')}}</span>
                </a>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="verificationModal3" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verificationModalLabel">التحقق من الحساب عبر نفاذ</h5>
                <!-- زر إغلاق الـ Modal -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ translate('Close') }}"></button>
            </div>
            <div class="modal-body">


                <input type="hidden" id="user_id" class="form-control" readonly value="{{ auth('customer')->user()->id ??"" }}">
                <label for="identity_number3" class="form-label">{{ translate('Enter Your ID Number') }}</label>
                <input type="text" class="form-control" id="identity_number3" placeholder="{{ translate('Enter ID Number') }}">

                <div id="loadingIndicator" style="display: none;">
                    <p>{{ __('Loading...') }}</p>
                    <!-- يمكنك استخدام أيقونة تحميل هنا، على سبيل المثال -->
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">{{ __('Loading...') }}</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" style="background-color: #001f3f; border-color: #001f3f;" class="btn btn-primary" id="verifyButton3">{{ translate('Verify') }}</button>
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




<div class="modal fade" id="createTicketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ticketModalLabel">{{ translate('Create Support Ticket') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="supportTicketForm" method="POST" action="{{ route('support-ticket') }}">
            @csrf
            <div class="form-group">
              <label>{{ translate('Subject') }}</label>
              <input type="text" name="subject" class="form-control" required>
            </div>
            <div class="form-group">
              <label>{{ translate('Message content') }}</label>
              <textarea name="message" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn text-white w-100" style="background-color: #001f3f;">
                {{ translate('Send') }}
            </button>
            
          </form>
        </div>
      </div>
    </div>
  </div>
  




@push('script')

<script>

    
$(document).ready(function() {
    // عند النقر على الزر
    $('#verificationButton3').click(function(e) {
        e.preventDefault(); // منع السلوك الافتراضي للرابط

        // التحقق من قيمة account_verification

         @if(auth('customer')->check())
        @if(auth('customer')->user()->account_verification == 0)
            // فتح الـ Modal
            $('#verificationModal3').modal('show');
        @else

$('#verificationModal3').modal('show');

            //  window.location.href = '{{ route("add-license") }}';
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
            $('#verifyButton3').click(function() {
                let idNumber = $('#identity_number3').val();
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
                        $('#verificationModal3').modal('hide');

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



@endpush
