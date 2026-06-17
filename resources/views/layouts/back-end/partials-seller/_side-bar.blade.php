@php
    use Illuminate\Support\Facades\Session;
@endphp

@push('css_or_js')



<style>
    /* ═══════════════════════════════════════════
       SIDEBAR STYLING (MATCHING PREVIOUS DESIGN)
       Navy & Gold Theme
    ═══════════════════════════════════════════ */
    
    /* Font Import if needed, assuming Tajawal is in the main layout */
    #sidebarMain,
    #sidebarMain .navbar-nav,
    #sidebarMain .nav-link,
    #sidebarMain .nav-subtitle,
    #sidebarMain .navbar-vertical-aside-mini-mode-hidden-elements,
    #sidebarMain .form-control,
    #sidebarMain .search--form-group input {
        font-family: 'Tajawal', sans-serif !important;
    }

    #sidebarMain{
        display: block !important;
    }

    /* Main Sidebar Background - Navy Base with Gold/Blue Glows */
    #sidebarMain .navbar-vertical-aside{
        background-color: #0b1628 !important; /* Base Navy */
        background-image: 
            radial-gradient(circle at top right, rgba(201,151,74,.12), transparent 28%), /* Gold Glow */
            radial-gradient(circle at bottom left, rgba(37,99,235,.1), transparent 25%)  /* Blue Glow */
        !important;
        border-left: 1px solid rgba(255,255,255,.08) !important;
        box-shadow: 0 18px 55px rgba(0,0,0,.25) !important;
    }

    #sidebarMain .navbar-vertical-container,
    #sidebarMain .navbar-vertical-footer-offset{
        background: transparent !important;
    }

    /* Logo Area */
    #sidebarMain .navbar-brand-wrapper{
        background: transparent !important;
        border-bottom: 1px solid rgba(255,255,255,.07) !important;
        padding: 18px 14px !important;
    }

    #sidebarMain .navbar-brand{
        margin-left: 0 !important;
        margin-right: auto !important;
        margin-left: auto !important;
        justify-content: center !important;
        width: 100%;
    }

    #sidebarMain .navbar-brand-logo-mini{
        max-height: 42px !important;
        filter: drop-shadow(0 4px 12px rgba(0,0,0,.25));
    }

    #sidebarMain .close,
    #sidebarMain .navbar-vertical-aside-toggle{
        color: #e8b96a !important; /* Gold Light */
        background: rgba(255,255,255,.08) !important;
        border-radius: 12px !important;
    }

    /* Search Form */
    #sidebarMain .sidebar--search-form{
        padding-top: 18px !important;
        padding-bottom: 18px !important;
    }

    #sidebarMain .search--form-group{
        position: relative;
    }

    #sidebarMain .search--form-group .btn{
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 12px;
        left: auto;
        z-index: 2;
        color: #8ba4bc !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }

    #sidebarMain .search--form-group .form-control{
        height: 48px !important;
        border-radius: 14px !important;
        background: rgba(255,255,255,.06) !important;
        border: 1px solid rgba(255,255,255,.08) !important;
        color: #fff !important;
        padding-right: 44px !important;
        padding-left: 14px !important;
        font-size: 14px !important;
    }

    #sidebarMain .search--form-group .form-control::placeholder{
        color: #8ba4bc !important;
    }

    #sidebarMain .search--form-group .form-control:focus{
        background: rgba(255,255,255,.09) !important;
        border-color: rgba(201,151,74,.4) !important; /* Gold Focus */
        box-shadow: 0 0 0 3px rgba(201,151,74,.1) !important;
    }

    /* Subtitles */
    #sidebarMain .nav-subtitle{
        color: #64748b !important; /* Muted */
        font-size: 11px !important;
        font-weight: 800 !important;
        text-transform: uppercase;
        letter-spacing: .06em;
        padding: 8px 18px 10px !important;
    }

    /* Navigation Items */
    #sidebarMain .navbar-nav{
        padding: 0 10px 18px !important;
    }

    #sidebarMain .navbar-vertical-aside-has-menu,
    #sidebarMain .nav-item{
        margin-bottom: 4px !important;
    }

    #sidebarMain .nav-link{
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        min-height: 50px !important;
        padding: 12px 16px !important;
        border-radius: 14px !important;
        color: #dbe7ef !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        transition: all .25s ease !important;
        background: transparent !important;
        margin: 0 !important;
    }

    #sidebarMain .nav-link .nav-icon{
        font-size: 20px !important;
        min-width: 24px !important;
        color: #94a3b8 !important; /* Slate Muted */
        transition: all .25s ease !important;
    }

    /* Hover State */
    #sidebarMain .nav-link:hover{
        background: rgba(255,255,255,.06) !important;
        color: #fff !important;
        transform: translateX(-3px);
    }

    #sidebarMain .nav-link:hover .nav-icon{
        color: #e8b96a !important; /* Gold Hover */
    }

    /* Active State - Gradient Style */
    #sidebarMain .navbar-vertical-aside-has-menu.show > .nav-link,
    #sidebarMain .nav-link.active,
    #sidebarMain .navbar-vertical-aside-has-menu.active > .nav-link{
        background: linear-gradient(135deg, #2563eb, #7c3aed) !important; /* Blue to Purple Gradient */
        color: #fff !important;
        box-shadow: 0 8px 20px rgba(37,99,235,.25) !important;
    }

    #sidebarMain .navbar-vertical-aside-has-menu.show > .nav-link .nav-icon,
    #sidebarMain .nav-link.active .nav-icon,
    #sidebarMain .navbar-vertical-aside-has-menu.active > .nav-link .nav-icon{
        color: #fff !important;
    }

    #sidebarMain .navbar-vertical-aside-mini-mode-hidden-elements{
        font-size: 14px !important;
        font-weight: 700 !important;
        color: inherit !important;
    }

    #sidebarMain .navbar-nav.nav-tabs{
        border-bottom: none !important;
    }

    /* Scrollbar */
    #sidebarMain .simplebar-scrollbar:before{
        background: rgba(201,151,74,.3) !important; /* Gold Scrollbar */
    }

    /* Responsive */
    @media (max-width: 767.98px) {
        #sidebarMain .navbar-vertical-aside {
            width: 290px !important;
            border-radius: 0 24px 24px 0;
            overflow: hidden;
        }

        #sidebarMain .navbar-brand-wrapper {
            padding-top: 16px !important;
            padding-bottom: 16px !important;
        }

        #sidebarMain .nav-link {
            min-height: 48px !important;
            border-radius: 12px !important;
            font-size: 13px !important;
        }

        #sidebarMain .search--form-group .form-control {
            height: 44px !important;
            font-size: 13px !important;
        }
    }
</style>
@endpush

<div id="sidebarMain">
    <aside style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"
           class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered">
        <div class="navbar-vertical-container">
            <div class="navbar-brand-wrapper justify-content-between side-logo dashboard-navbar-side-logo-wrapper">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('service-provider.dashboard') }}" aria-label="Front">
                    <img class="navbar-brand-logo-mini for-web-logo max-h-40"
                         src="{{ asset('public/assets/images/logo_web.png') }}"
                         alt="{{ translate('logo') }}">
                </a>

                <button type="button" class="d-none js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                    <i class="tio-clear tio-lg"></i>
                </button>

                <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-3">
                    <i class="tio-first-page navbar-vertical-aside-toggle-short-align"></i>
                    <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                       data-template="<div class=&quot;tooltip d-none d-sm-block&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><div class=&quot;tooltip-inner&quot;></div></div>"></i>
                </button>
            </div>

            <div class="navbar-vertical-footer-offset pb-0">
                <div class="navbar-vertical-content">
                    <div class="sidebar--search-form pb-3 pt-4 mx-3">
                        <div class="search--form-group">
                            <button type="button" class="btn"><i class="tio-search"></i></button>
                            <input type="text" class="js-form-search form-control form--control" id="search-bar-input" placeholder="بحث في القائمة">
                        </div>
                    </div>

                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <li class="nav-item">
                            <small class="nav-subtitle">لوحة مزود الخدمة</small>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{ Request::is('user/dashboard*') ? 'show' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link {{ Request::is('user/dashboard*') ? 'active' : '' }}"
                               href="{{ route('service-provider.dashboard') }}">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">الرئيسية</span>
                            </a>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{ Request::is('user/questions/create') ? 'show' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link {{ Request::is('user/questions/create') ? 'active' : '' }}"
                               href="{{ route('service-provider.estaes.create-offer') }}">
                                <i class="tio-add-circle-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">إضافة عرض عقاري</span>
                            </a>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{ Request::is('user/questions/list') ? 'show' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link {{ Request::is('user/questions/list') ? 'active' : '' }}"
                               href="{{ route('service-provider.owner.offers.pending') }}">
                                <i class="tio-view-list-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">عروضي في العقارات</span>
                            </a>
                        </li>

                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="javascript:void(0)">
                                <i class="tio-map nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">مناطق عروضي</span>
                            </a>
                        </li>

                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="javascript:void(0)">
                                <i class="tio-chart-bar-1 nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">إحصاءات العروض</span>
                            </a>
                        </li>

                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('service-provider.profile.dispaly') }}">
                                <i class="tio-settings nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">الإعدادات</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>
