
<html lang="en" dir="rtl">
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('partials.__head')

<body data-layout="detached" data-topbar="colored">



<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<div class="container-fluid">
    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="container-fluid">
                    <div class="float-end">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect"
                                    id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                 aria-labelledby="page-header-search-dropdown">

                                <form class="p-3">
                                    <div class="m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..."
                                                   aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i
                                                        class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <img class="" src="{{ asset('/assets/images/flags/saudi.png') }}" alt="Header Language" height="16">
                            </button>
{{--                            <div class="dropdown-menu dropdown-menu-end">--}}


{{--                                <!-- item-->--}}

{{--                                <!-- item-->--}}
{{--                                <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                                    <img src="{{ asset('/assets/images/flags/saudi.png') }}" alt="user-image" class="me-1" height="12"> <span--}}
{{--                                        class="align-middle">Russian</span>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect"
                                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge rounded-pill bg-danger ">3</span>

                             
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                 aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small"> View All</a>
                                        </div>
                                    </div>
                                </div>
                                {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex illo dolores iste soluta nobis ipsum aliquid quod consequatur reiciendis amet modi aspernatur quam voluptates, velit dolorem ducimus vel omnis cupiditate!</p> --}}
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex align-items-start">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mt-0 mb-1">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex align-items-start">
                                            <img src="/assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs"
                                                 alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mt-0 mb-1">James Lemire</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex align-items-start">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="bx bx-badge-check"></i>

> Dev pro:
</span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mt-0 mb-1">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex align-items-start">
                                            <img src="/assets/images/users/avatar-4.jpg" class="me-3 rounded-circle avatar-xs"
                                                 alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 " href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (auth()->guard('admin')->check())
                                <img class="rounded-circle header-profile-user" src="{{ asset('storage/app/public/logo.png') }}" alt="Header Avatar">
                                @elseif (auth()->guard('user')->check() && auth()->guard('user')->user()->user_type == 'provider')
                                     <img class="rounded-circle header-profile-user"
     src="{{ auth()->guard('user')->user()?->provider?->image
        ? asset('storage/app/public/' . auth()->guard('user')->user()->provider->image)
        : asset('public/assets/back-end/img/160x160/img1.jpg') }}"
     alt="Header Avatar">
                                    @endif
{{--                                <span class="d-none d-xl-inline-block ms-1">{{ auth()->guard('user')->user()->name }}</span>--}}
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                {{-- <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i>
                                    Profile</a> --}}
                                {{-- <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> My
                                    Wallet</a> --}}
                                {{-- <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i
                                        class="bx bx-wrench font-size-16 align-middle me-1"></i> Settings</a>
                                <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i>

> Dev pro:
Lock screen</a> --}}
                                <div class="dropdown-divider"></div>
                                @if (auth()->guard('user')->check())

                                    <a class="dropdown-item text-danger" href="{{ route('agent.logout') }}"><i
                                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> Logout</a>
                                @else
                                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> Logout</a>
                                @endif
                            </div>
                        </div>



                    </div>
                    <div>
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="/assets/images/logo-sm.png" alt="" height="20">
                                </span>
                                <span class="logo-lg">
                                    <img src="/assets/images/logo-dark.png" alt="" height="17">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="/assets/images/logo-sm.png" alt="" height="20">
                                </span>
                                <span class="logo-lg">
                                    <img src="/assets/images/logo-light.png" alt="" height="19">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                                id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-inline-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="bx bx-search-alt"></span>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </header>
        <!-- ========== Left Sidebar Start ========== -->
        @if (auth()->guard('admin')->check())
            @include('partials.sidebars.__admin-sidebar')
        @endif


        @if (auth()->guard('user')->check() && auth()->guard('user')->user()->user_type == 'provider')
            @include('partials.sidebars.__service-provider-sidebar')
        @endif



        @if (auth()->guard('user')->check() && auth()->guard('user')->user()->user_type == 'agent')
            @include('partials.sidebars.__agent-side')
        @endif
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            {{-- <h4 class="page-title mb-0 font-size-18">Starter Page</h4> --}}

                            > Dev pro:
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                    <li class="breadcrumb-item active">لوحة التحكم</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        @yield('content')
                    </div>
                </div>

            </div>
            <!-- End Page-content -->


        </div>
        <!-- end main content-->
        @include('partials.__footer')
    </div>
    <!-- END layout-wrapper -->

</div>
<!-- end container-fluid -->


<!-- JAVASCRIPT -->
<!-- JAVASCRIPT -->

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>--}}
{{--    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>--}}
@stack('script_2')

<script src="{{ asset('/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('/assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{asset('/assets/js/sweet_alert.js') }}"></script>

<script src="{{ asset('/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('/assets/js/pages/datatables.init.js') }}"></script>

<script src="{{ asset('/assets/js/app.js') }}"></script>
<script src="{{ asset('/assets/js/pages/table-responsive.init.js')}}"></script>
<script src="{{ asset('/assets/libs/admin-resources/rwd-table/rwd-table.min.js')}}"></script>
<script src="{{ asset('/assets/js/pages/form_validation.init.js')}}"></script>
<script src="{{ asset('/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{ asset('/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{ asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

<!-- form advanced init -->
<script src="{{ asset('/assets/js/pages/form-advanced.init.js')}}"></script>


@yield('scripts')

{{--    <script>--}}
{{--        @php($fcm_credentials = \App\Helpers\Helpers::get_business_settings('fcm_credentials'))--}}
{{--        var firebaseConfig = {--}}
{{--            apiKey: "{{isset($fcm_credentials['apiKey']) ? $fcm_credentials['apiKey'] : ''}}",--}}
{{--            authDomain: "{{isset($fcm_credentials['authDomain']) ? $fcm_credentials['authDomain'] : ''}}",--}}
{{--            projectId: "{{isset($fcm_credentials['projectId']) ? $fcm_credentials['projectId'] : ''}}",--}}
{{--            storageBucket: "{{isset($fcm_credentials['storageBucket']) ? $fcm_credentials['storageBucket'] : ''}}",--}}
{{--            messagingSenderId: "{{isset($fcm_credentials['messagingSenderId']) ? $fcm_credentials['messagingSenderId'] : ''}}",--}}

> Dev pro:
{{--            appId: "{{isset($fcm_credentials['appId']) ? $fcm_credentials['appId'] : ''}}",--}}
{{--            measurementId: "{{isset($fcm_credentials['measurementId']) ? $fcm_credentials['measurementId'] : ''}}"--}}
{{--        };--}}
{{--        firebase.initializeApp(firebaseConfig);--}}
{{--        const messaging = firebase.messaging();--}}

{{--        function startFCM() {--}}

{{--            messaging--}}
{{--                .requestPermission()--}}
{{--                .then(function() {--}}
{{--                    return messaging.getToken()--}}
{{--                })--}}
{{--                .then(function(response) {--}}
{{--                    subscribeTokenToTopic(response, 'admin_message');--}}
{{--                    console.log('subscribed');--}}
{{--                }).catch(function(error) {--}}
{{--                console.log(error);--}}
{{--            });--}}
{{--        }--}}
{{--        @php($key = \App\Models\BusinessSetting::where('type', 'push_notification_key')->first())--}}

{{--        function subscribeTokenToTopic(token, topic) {--}}
{{--            fetch('https://iid.googleapis.com/iid/v1/' + token + '/rel/topics/' + topic, {--}}
{{--                method: 'POST',--}}
{{--                headers: new Headers({--}}
{{--                    'Authorization': 'key={{ $key ? $key->value : '' }}'--}}
{{--                })--}}
{{--            }).then(response => {--}}
{{--                if (response.status < 200 || response.status >= 400) {--}}
{{--                    throw 'Error subscribing to topic: ' + response.status + ' - ' + response.text();--}}
{{--                }--}}
{{--                console.log('Subscribed to "' + topic + '"');--}}
{{--            }).catch(error => {--}}
{{--                console.error(error);--}}
{{--            })--}}
{{--        }--}}

{{--        function getUrlParameter(sParam) {--}}
{{--            var sPageURL = window.location.search.substring(1);--}}
{{--            var sURLVariables = sPageURL.split('&');--}}
{{--            for (var i = 0; i < sURLVariables.length; i++) {--}}
{{--                var sParameterName = sURLVariables[i].split('=');--}}
{{--                if (sParameterName[0] == sParam) {--}}
{{--                    return sParameterName[1];--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}

{{--        function conversationList() {--}}
{{--            $.ajax({--}}
{{--                url: "{{ route('message.list') }}",--}}
{{--                success: function(data) {--}}
{{--                    $('#conversation-list').empty();--}}
{{--                    $("#conversation-list").append(data.html);--}}
{{--                    var user_id = getUrlParameter('user');--}}
{{--                    $('.customer-list').removeClass('conv-active');--}}
{{--                    $('#customer-' + user_id).addClass('conv-active');--}}
{{--                }--}}
{{--            })--}}
{{--        }--}}

{{--        function conversationView() {--}}
{{--            var conversation_id = getUrlParameter('conversation');--}}
{{--            var user_id = getUrlParameter('user');--}}
{{--            var url= '{{url('/')}}/abbaadRepo/message/view/'+conversation_id+'/' + user_id;--}}
{{--            $.ajax({--}}
{{--                url: url,--}}
{{--                success: function(data) {--}}
{{--                    $('#view-conversation').html(data.view);--}}
{{--                }--}}
{{--            })--}}
{{--        }--}}

{{--        function vendorConversationView() {--}}
{{--            var conversation_id = getUrlParameter('conversation');--}}
{{--            var user_id = getUrlParameter('user');--}}
{{--            var url= '{{url('/')}}/abbaadRepo/restaurant/message/'+conversation_id+'/' + user_id;--}}
{{--            $.ajax({--}}
{{--                url: url,--}}
{{--                success: function(data) {--}}
{{--                    $('#vendor-view-conversation').html(data.view);--}}
{{--                }--}}
{{--            })--}}
{{--        }--}}

> Dev pro:
{{--        function dmConversationView() {--}}
{{--            var conversation_id = getUrlParameter('conversation');--}}
{{--            var user_id = getUrlParameter('user');--}}
{{--            var url= '{{url('/')}}/abbaadRepo/delivery-man/message/'+conversation_id+'/' + user_id;--}}
{{--            $.ajax({--}}
{{--                url: url,--}}
{{--                success: function(data) {--}}
{{--                    $('#dm-view-conversation').html(data.view);--}}
{{--                }--}}
{{--            })--}}
{{--        }--}}


{{--        messaging.onMessage(function(payload) {--}}
{{--            console.log(payload.data);--}}
{{--            var conversation_id = getUrlParameter('conversation');--}}
{{--            var user_id = getUrlParameter('user');--}}
{{--            var url= '{{url('/')}}/abbaadRepo/message/view/'+conversation_id+'/' + user_id;--}}
{{--            console.log(url);--}}
{{--            $.ajax({--}}
{{--                url: url,--}}
{{--                success: function(data) {--}}
{{--                    $('#view-conversation').html(data.view);--}}
{{--                }--}}
{{--            })--}}
{{--            toastr.success('New message arrived', {--}}
{{--                CloseButton: true,--}}
{{--                ProgressBar: true--}}
{{--            });--}}
{{--            if($('#conversation-list').scrollTop() == 0){--}}
{{--                conversationList();--}}
{{--            }--}}
{{--            // playAudio();--}}
{{--            //         $('#popup-modal-msg').appendTo("body").modal('show');--}}
{{--            // const title = payload.notification.title;--}}
{{--            // const options = {--}}
{{--            //     body: payload.notification.body,--}}
{{--            //     icon: payload.notification.icon,--}}
{{--            // };--}}
{{--            // new Notification(title, options);--}}
{{--        });--}}
{{--        startFCM();--}}
{{--        conversationList();--}}

{{--        if(getUrlParameter('conversation')){--}}

{{--            conversationView();--}}
{{--            vendorConversationView();--}}
{{--            dmConversationView();--}}
{{--        }--}}
{{--    </script>--}}

</body>

</html>
