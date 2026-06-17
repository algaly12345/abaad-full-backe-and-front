
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ asset('storage/'.auth()->guard('user')->user()->provider->image) }}" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="{{ route('service-provider.profile.dispaly') }}" class="text-dark fw-medium font-size-16">{{ auth()->guard('user')->user()->name }}</a>
                <p class="text-body mt-1 mb-0 font-size-13">مزود خدمه</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">






                <li>
                    <a href="{{ route('service-provider.profile.dispaly') }}" class=" waves-effect">
                        <i class="mdi mdi-calendar-text"></i>
                        <span>الملف الشخص</span>
                    </a>
                </li>



                <li>
                    <a href="{{ route('service-provider.profile.dispaly') }}" class=" waves-effect">
                        <i class="mdi mdi-calendar-text"></i>
                        <span>خدماتي</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('service-provider.profile.dispaly') }}" class=" waves-effect">
                        <i class="mdi mdi-calendar-text"></i>
                        <span>خدماتي</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('service-provider.estaes.index') }}" class=" waves-effect">
                        <i class="mdi mdi-calendar-text"></i>
                        <span>العقارات</span>
                    </a>
                </li>




                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>أدارة العروض </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        {{-- <li><a href="email-read.html">المكاتب العقارية </a></li>
                        <li><a href="email-read.html">اﻷفراد</a></li> --}}
                        <li class=""><a href="javascript: void(0);" class="has-arrow" aria-expanded="false">مرسلة من الادراة</a>
                            <ul class="sub-menu mm-collapse" aria-expanded="true" style="height: 0px;">
                                <li><a href="{{ route('service-provider.offers.pending') }}"> في الانتظار </a></li>
                                <li><a href="{{ route('service-provider.offers.accept') }}">تمت الموافقة</a></li>
                            </ul>
                        </li>

                        <li class=""><a href="javascript: void(0);" class="has-arrow" aria-expanded="false">عروضك المرسلة</a>
                            <ul class="sub-menu mm-collapse" aria-expanded="true" style="height: 0px;">
                                <li><a href="{{ route('service-provider.owner.offers.pending') }}"> في الانتظار </a></li>
                                <li><a href="{{ route('service-provider.owner.offers.accept') }}">تمت الموافقة</a></li>
                            </ul>
                        </li>



                    </ul>
                </li>







            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
