<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ asset('public/assets/images/users/avatar-2.jpg') }}" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark fw-medium font-size-16">awad abayzeed</a>
                <p class="text-body mt-1 mb-0 font-size-13">system admins</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>





                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>الاقسام</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('categories.index') }}">الاقسام الرئيسية</a></li>
                        <li><a href="{{ route('categories.sub-categories') }}">الاقسام الفرعية</a></li>

                    </ul>
                </li>
                <li>
                    <a href="{{ route('packages.index') }}" class=" waves-effect">
                        <i class="mdi mdi-calendar-text"></i>
                        <span>الباقات</span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>أدارة التسويق العقاري</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('agents.index') }}">أدارة المسوقين </a></li>
                        <li><a href="{{ route('agents.real-estate-companies') }}">الشركات العقارية</a></li>
                        <li><a href="{{ route('agents.real-estate-offices') }}">المكاتب العقارية </a></li>
                        <li><a href="{{ route('agents.individuals') }}">اﻷفراد</a></li>

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>أدارة العروض العقارية</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('estate.index') }}">قائمة العروض </a></li>
                        <li><a href="{{ route('estate.create') }}">إضافة عرض</a></li>


                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>العروض و الخدمات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('service-providers.index') }}">أدارة مقدمين الخدمات</a></li>
                        <li><a href="{{ route('service-types.index') }}">أدارة الخدمات</a></li>
                        <li><a href="{{ route('offers.index') }}">أدارة العروض</a></li>
                        <li><a href="{{ route('offers.sent') }}">العروض المرسلة</a></li>
                        {{-- <li><a href="email-read.html">أرسال عرض</a></li> --}}
                        <li><a href="#">عروض موافق عليها</a></li>
                    </ul>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>إدارة المناطق</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('territories.index') }}">الاقاليم</a></li>
                        <li><a href="{{ route('provinces.index') }}">المقاطعات</a></li>
                        <li><a href="{{ route('zones.index') }}">المنطقه</a></li>
                    </ul>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-video-switch"></i>
                        <span>قسم الإعلان</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('banners.index') }}">الشريط المتحرك</a></li>
                        <li><a href="{{ route('notification.create') }}">ارسال اشعار</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-video-switch"></i>
                        <span>قسم المراسلات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('message.list') }}">مراسلات العروض</a></li>
{{--                        <li><a href="#">ارسال اشعار</a></li>--}}
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>إدارة الإعدادت التطبيق</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('territories.index') }}">الشروط والاحكام</a></li>
                        <li><a href="{{ route('provinces.index') }}">سياسة الخصوصية</a></li>
                        <li><a href="{{ route('zones.index') }}">من نحن</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>الصلاحيات و التحكم</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admins.index') }}">المدراء</a></li>
                        <li><a href="{{ route('roles.index') }}">اﻷدوار</a></li>
                        <li><a href="{{ route('permissions.index') }}">الصلاحيات</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
