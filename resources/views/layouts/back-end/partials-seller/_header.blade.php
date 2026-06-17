@php
    use App\Models\User;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Carbon;

    $vendor = User::find(auth('user')->id());
    $direction = Session::get('direction');
@endphp

@push('css_or_js')
<style>
    #headerMain,
    #headerMain .navbar,
    #headerMain .dropdown-menu,
    #headerMain .media,
    #headerMain .btn,
    #headerMain .dropdown-item,
    #headerMain .profile-name {
        font-family: 'Tajawal', sans-serif !important;
    }

    #headerMain{
        display: block !important;
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1030;
        padding: 0 18px;
    }

    #headerMain #header {
        margin-top: 14px;
        background: rgba(255,255,255,.82) !important;
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255,255,255,.75) !important;
        box-shadow: 0 14px 35px rgba(15,23,42,.08) !important;
        border-radius: 24px;
        min-height: 74px;
        padding-inline: 14px;
    }

    #headerMain .btn.btn-icon.btn-ghost-secondary {
        width: 46px;
        height: 46px;
        border-radius: 16px !important;
        background: rgba(255,255,255,.84) !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 6px 18px rgba(15,23,42,.04);
        color: #0f172a !important;
        transition: .25s ease;
    }

    #headerMain .btn.btn-icon.btn-ghost-secondary:hover {
        transform: translateY(-1px);
        border-color: rgba(37,99,235,.24) !important;
        box-shadow: 0 12px 26px rgba(37,99,235,.10);
    }

    #headerMain .navbar-dropdown-account-wrapper {
        padding: 7px 10px;
        border-radius: 18px;
        background: rgba(255,255,255,.72);
        border: 1px solid rgba(226,232,240,.88);
    }

    #headerMain .profile-name {
        color: #0f172a;
        font-size: 15px;
        font-weight: 800;
    }

    #headerMain .fz-12 {
        color: #64748b !important;
        font-size: 12px !important;
        font-weight: 600;
    }

    #headerMain .avatar.avatar-sm.avatar-circle {
        width: 46px;
        height: 46px;
        border-radius: 16px !important;
        overflow: hidden;
        border: 2px solid rgba(255,255,255,.95);
        box-shadow: 0 8px 18px rgba(15,23,42,.10);
    }

    #headerMain .avatar.avatar-sm.avatar-circle img,
    #headerMain .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #headerMain .navbar-dropdown-menu {
        border: 1px solid rgba(226,232,240,.9) !important;
        border-radius: 20px !important;
        box-shadow: 0 20px 36px rgba(15,23,42,.10) !important;
        overflow: hidden;
    }

    #headerMain .dropdown-item,
    #headerMain .dropdown-item-text,
    #headerMain .notification-data-view {
        font-weight: 700;
    }

    #headerMain .btn-status-danger {
        background: #ef4444 !important;
    }

    #headerMain .notification_data_new_count {
        top: 3px;
        right: 3px;
    }

    @media (max-width: 767.98px) {
        #headerMain {
            padding: 0 10px;
        }

        #headerMain #header {
            margin-top: 10px;
            border-radius: 18px;
            min-height: 62px;
            padding-inline: 10px;
        }

        #headerMain .btn.btn-icon.btn-ghost-secondary {
            width: 40px;
            height: 40px;
            border-radius: 14px !important;
        }

        #headerMain .navbar-dropdown-account-wrapper {
            padding: 4px 6px;
            border-radius: 14px;
            background: transparent;
            border: none;
        }

        #headerMain .d-none.d-md-block.media-body {
            display: none !important;
        }

        #headerMain .avatar.avatar-sm.avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 14px !important;
        }
    }
</style>
@endpush

<div id="headerMain">
    <header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container">
        <div class="navbar-nav-wrap w-100">
            <div class="navbar-brand-wrapper d-none d-sm-block d-xl-none">
                <a class="navbar-brand" href="{{ route('service-provider.dashboard') }}" aria-label="logo">
                    @if (isset($shop))
                        <img class="navbar-brand-logo"
                             src="{{ getStorageImages(path: $shop->image_full_url, type: 'backend-logo') }}"
                             alt="{{ translate('logo') }}"
                             height="40">
                    @else
                        <img class="navbar-brand-logo-mini"
                             src="{{ asset('public/assets/back-end/img/160x160/img1.jpg') }}"
                             alt="{{ translate('logo') }}" height="40">
                    @endif
                </a>
            </div>

            <div class="navbar-nav-wrap-content-left">
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-sm-3 d-xl-none">
                    <i class="tio-first-page navbar-vertical-aside-toggle-short-align"></i>
                    <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                       data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                       data-toggle="tooltip" data-placement="right" title="Expand"></i>
                </button>
            </div>

            <div class="navbar-nav-wrap-content-right"
                 style="{{ $direction === 'rtl' ? 'margin-left:unset; margin-right: auto' : 'margin-right:unset; margin-left: auto' }}">
                <ul class="navbar-nav align-items-center flex-row gap-xl-16px">

                    <li class="nav-item">
                        <div class="hs-unfold">
                            <a title="{{ translate('website_shop_view') }}"
                               class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                               href="" target="_blank"
                               data-toggle="tooltip"
                               data-custom-class="header-icon-title">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.3663 6.75C12.7069 3.6875 11.3007 1.75 10 1.75C8.69941 1.75 7.29316 3.6875 6.63379 6.75H13.3663Z" fill="#2563EB"/>
                                    <path d="M6.25 10.5C6.24985 11.3361 6.3056 12.1713 6.41688 13H13.5831C13.6944 12.1713 13.7502 11.3361 13.75 10.5C13.7502 9.66388 13.6944 8.82868 13.5831 8H6.41688C6.3056 8.82868 6.24985 9.66388 6.25 10.5Z" fill="#2563EB"/>
                                    <path d="M6.63379 14.25C7.29316 17.3125 8.69941 19.25 10 19.25C11.3007 19.25 12.7069 17.3125 13.3663 14.25H6.63379Z" fill="#2563EB"/>
                                    <path d="M14.6462 6.74965H18.5837C17.9921 5.40325 17.0932 4.21424 15.9591 3.27798C14.8249 2.34173 13.4872 1.68429 12.0531 1.3584C13.2387 2.40152 14.1687 4.33027 14.6462 6.74965Z" fill="#2563EB"/>
                                    <path d="M19.0331 8H14.8456C14.9487 8.82934 15.0003 9.66428 15 10.5C15.0001 11.3357 14.9483 12.1707 14.845 13H19.0325C19.4883 11.3645 19.4889 9.6355 19.0331 8Z" fill="#2563EB"/>
                                    <path d="M12.0531 19.6412C13.4874 19.3155 14.8254 18.6582 15.9598 17.7219C17.0941 16.7856 17.9932 15.5965 18.585 14.25H14.6475C14.1687 16.6694 13.2387 18.5981 12.0531 19.6412Z" fill="#2563EB"/>
                                    <path d="M5.35376 14.25H1.41626C2.008 15.5965 2.90712 16.7856 4.04147 17.7219C5.17582 18.6582 6.51382 19.3155 7.94813 19.6412C6.76126 18.5981 5.83126 16.6694 5.35376 14.25Z" fill="#2563EB"/>
                                    <path d="M7.94691 1.3584C6.5126 1.68411 5.1746 2.34147 4.04025 3.27774C2.9059 4.214 2.00678 5.40311 1.41504 6.74965H5.35254C5.83129 4.33027 6.76129 2.40152 7.94691 1.3584Z" fill="#2563EB"/>
                                    <path d="M4.99996 10.5C4.99987 9.66426 5.05164 8.82933 5.15495 8H0.967455C0.511662 9.6355 0.511662 11.3645 0.967455 13H5.15495C5.05164 12.1707 4.99987 11.3357 4.99996 10.5Z" fill="#2563EB"/>
                                </svg>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle media align-items-center gap-3 navbar-dropdown-account-wrapper dropdown-toggle-left-arrow dropdown-toggle-empty"
                               href="javascript:"
                               data-hs-unfold-options='{"target": "#notificationDropdown", "type": "css-animation"}'
                               title="{{ translate('Notifications') }}" data-toggle="tooltip"
                               data-custom-class="header-icon-title">
                                <i class="tio-notifications-on-outlined"></i>
                                @php($notification = App\Models\Notification::whereBetween('created_at', [auth('user')->user()->created_at, Carbon::now()])->where('sent_to', 'user')->whereDoesntHave('notificationSeenBy')->count())
                                @if($notification != 0)
                                    <span class="btn-status btn-sm-status btn-status-danger notification_data_new_count">{{ $notification }}</span>
                                @endif
                            </a>
                            <div id="notificationDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account py-0 overflow-hidden width--20rem">
                                @php($notification_data = App\Models\Notification::whereBetween('created_at', [auth('user')->user()->created_at, Carbon::now()])->where('sent_to', 'seller')->with('notificationSeenBy')->latest()->get())
                                @foreach ($notification_data as $item)
                                    <button class="dropdown-item position-relative notification-data-view" data-id="{{ $item->id }}">
                                        <span class="text-truncate pr-2 d-block">{{ translate($item->title) }}</span>
                                        <span class="fs-10">{{ $item->created_at->diffforHumans() }}</span>
                                        @if($item->notification_seen_by == null)
                                            <span class="badge-soft-danger float-right small py-1 px-2 rounded notification_data_new_badge{{ $item->id }}">{{ translate('new') }}</span>
                                        @endif
                                    </button>
                                    <div class="dropdown-divider"></div>
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle media align-items-center gap-3 navbar-dropdown-account-wrapper dropdown-toggle-left-arrow dropdown-toggle-empty"
                               href="javascript:"
                               data-hs-unfold-options='{"target": "#messageDropdown", "type": "css-animation"}'
                               title="{{ translate('Inbox') }}" data-toggle="tooltip"
                               data-custom-class="header-icon-title">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_5926_1152)">
                                        <path d="M16.6666 2.16699H3.33329C2.41663 2.16699 1.67496 2.91699 1.67496 3.83366L1.66663 18.8337L4.99996 15.5003H16.6666C17.5833 15.5003 18.3333 14.7503 18.3333 13.8337V3.83366C18.3333 2.91699 17.5833 2.16699 16.6666 2.16699ZM4.99996 8.00033H15V9.66699H4.99996V8.00033ZM11.6666 12.167H4.99996V10.5003H11.6666V12.167ZM15 7.16699H4.99996V5.50033H15V7.16699Z" fill="#2563EB"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_5926_1152">
                                            <rect width="20" height="20" fill="white" transform="translate(0 0.5)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <div id="messageDropdown" class="hs-unfold-content width--16rem dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account">
                                <div class="dropdown-divider"></div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker media align-items-center gap-3 navbar-dropdown-account-wrapper dropdown-toggle dropdown-toggle-left-arrow"
                               href="javascript:"
                               data-hs-unfold-options='{"target": "#accountNavbarDropdown", "type": "css-animation"}'>
                                <div class="d-none d-md-block media-body text-right">
                                    <h5 class="profile-name mb-0">{{ $vendor->name }}</h5>
                                    <span class="fz-12">{{ $vendor->id_nummber ?? $vendor->id_number }}</span>
                                </div>
                                <div class="avatar avatar-sm avatar-circle">
                                    <img src="{{ asset('storage/app/public/' . (optional(auth()->guard('user')->user()->provider)->image ?? 'default.png')) }}" alt="profile">
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                            </a>
                            <div id="accountNavbarDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account __w-16rem">
                                <div class="dropdown-item-text">
                                    <div class="media align-items-center text-break">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            <img class="avatar-img"
                                                 src="{{ getStorageImages(path: $vendor->image_full_url, type: 'backend-profile') }}"
                                                 alt="{{ translate('image_description') }}">
                                        </div>
                                        <div class="media-body">
                                            <span class="card-title h5">{{ $vendor->name }}</span>
                                            <span class="card-text">{{ $vendor->id_number }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('service-provider.profile.dispaly') }}">
                                    <span class="text-truncate pr-2">{{ translate('settings') }}</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:" data-toggle="modal" data-target="#sign-out-modal">
                                    <span class="text-truncate pr-2">{{ translate('logout') }}</span>
                                </a>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </header>
</div>

<div id="headerFluid" class="d-none"></div>
<div id="headerDouble" class="d-none"></div>
