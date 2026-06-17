@extends('layouts.admin')


@section('title','المراسلات')

@section('content')

    <div class="row">
        <div class="col-12">
            <!-- Left sidebar -->
            <div class="email-leftbar card">
{{--                <button type="button" class="btn btn-danger  w-100 waves-effect waves-light"--}}
{{--                        data-bs-toggle="modal" data-bs-target="#composemodal">--}}
{{--                    Compose--}}
{{--                </button>--}}
                @include('dashboard.messages.data')




                </div>

            <div class="email-rightbar mb-3">

                <div class="card">
                    <div class="btn-toolbar p-3" role="toolbar">
                        <div class="btn-group me-2 mb-2 mb-sm-0">
                            <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                    class="fa fa-inbox"></i></button>
                            <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                    class="fa fa-exclamation-circle"></i></button>
                            <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                    class="far fa-trash-alt"></i></button>
                        </div>
                        <div class="btn-group me-2 mb-2 mb-sm-0">
                            <button type="button"
                                    class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Updates</a>
                                <a class="dropdown-item" href="#">Social</a>
                                <a class="dropdown-item" href="#">Team Manage</a>
                            </div>
                        </div>
                        <div class="btn-group me-2 mb-2 mb-sm-0">
                            <button type="button"
                                    class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Updates</a>
                                <a class="dropdown-item" href="#">Social</a>
                                <a class="dropdown-item" href="#">Team Manage</a>
                            </div>
                        </div>

                        <div class="btn-group me-2 mb-2 mb-sm-0">
                            <button type="button"
                                    class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                More <i class="mdi mdi-dots-vertical ms-2"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Mark as Unread</a>
                                <a class="dropdown-item" href="#">Mark as Important</a>
                                <a class="dropdown-item" href="#">Add to Tasks</a>
                                <a class="dropdown-item" href="#">Add Star</a>
                                <a class="dropdown-item" href="#">Mute</a>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-8 col-nd-6" id="view-conversation">
                        <center class="mt-2">
                            <h4 class="initial-29">messages.viewconversation
                            </h4>
                        </center>
                        view here
                    </div>
                    {{--                    <div class="card-body">--}}
                    {{--                        <div class="mb-4 d-flex align-items-start">--}}
                    {{--                            <img class="d-flex me-3 rounded-circle avatar-sm"--}}
                    {{--                                 src="assets/images/users/avatar-2.jpg" alt="Generic placeholder image">--}}
                    {{--                            <div class="flex-1">--}}
                    {{--                                <h5 class="font-size-14 mt-1">Humberto D. Champion</h5>--}}
                    {{--                                <small class="text-muted">support@domain.com</small>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}

                    {{--                        <h4 class="mt-0 font-size-16">This Week's Top Stories</h4>--}}

                    {{--                        <p>Dear Lorem Ipsum,</p>--}}
                    {{--                        <p>Praesent dui ex, dapibus eget mauris ut, finibus vestibulum enim. Quisque--}}
                    {{--                            arcu leo, facilisis in fringilla id, luctus in tortor. Nunc vestibulum est--}}
                    {{--                            quis orci varius viverra. Curabitur dictum volutpat massa vulputate--}}
                    {{--                            molestie. In at felis ac velit maximus convallis.--}}
                    {{--                        </p>--}}
                    {{--                        <p>Sed elementum turpis eu lorem interdum, sed porttitor eros commodo. Nam eu--}}
                    {{--                            venenatis tortor, id lacinia diam. Sed aliquam in dui et porta. Sed bibendum--}}
                    {{--                            orci non tincidunt ultrices. Vivamus fringilla, mi lacinia dapibus--}}
                    {{--                            condimentum, ipsum urna lacinia lacus, vel tincidunt mi nibh sit amet lorem.--}}
                    {{--                        </p>--}}
                    {{--                        <p>Sincerly,</p>--}}
                    {{--                        <hr />--}}

                    {{--                        <div class="row">--}}
                    {{--                            <div class="col-xl-2 col-6">--}}
                    {{--                                <div class="card">--}}
                    {{--                                    <img class="card-img-top img-fluid" src="assets/images/small/img-3.jpg"--}}
                    {{--                                         alt="Card image cap">--}}
                    {{--                                    <div class="py-2 text-center">--}}
                    {{--                                        <a href="" class="fw-medium">Download</a>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="col-xl-2 col-6">--}}
                    {{--                                <div class="card">--}}
                    {{--                                    <img class="card-img-top img-fluid" src="assets/images/small/img-4.jpg"--}}
                    {{--                                         alt="Card image cap">--}}
                    {{--                                    <div class="py-2 text-center">--}}
                    {{--                                        <a href="" class="fw-medium">Download</a>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}

                    {{--                        <a href="javascript: void(0);" class="btn btn-secondary waves-effect mt-4"><i--}}
                    {{--                                class="mdi mdi-reply"></i> Reply</a>--}}
                    {{--                    </div>--}}

                </div>
                <!-- card -->
            </div>
            </div>
            <!-- End Left sidebar -->

            <!-- Right Sidebar -->






        </div>
        <!-- end Col -->

    </div>

{{--<div class="content container-fluid">--}}
{{--        <!-- Page Header -->--}}
{{--        <div class="page-header">--}}
{{--            <h1 class="page-header-title"> 'messages.conversationmessages.list'</h1>--}}
{{--        </div>--}}
{{--        <!-- End Page Header -->--}}

{{--        <div class="row g-3">--}}
{{--            <div class="col-lg-4 col-md-6">--}}
{{--                <!-- Card -->--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header border-0">--}}
{{--                        <div class="input-group input---group">--}}
{{--                            <div class="input-group-prepend border-right-0">--}}
{{--                                <span class="input-group-text border-right-0" id="basic-addon1"><i class="tio-search"></i></span>--}}
{{--                            </div>--}}
{{--                            <input type="text" class="form-control border-left-0 pl-1" id="serach" placeholder="messages.search" aria-label="Username"--}}
{{--                                aria-describedby="basic-addon1" autocomplete="off">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Body -->--}}
{{--                    <div class="card-body p-0 initial-19" id="conversation-list">--}}
{{--                        <div class="border-bottom"></div>--}}
{{--                        @include('dashboard.messages.data')--}}
{{--                    </div>--}}
{{--                    <!-- End Body -->--}}
{{--                </div>--}}
{{--                <!-- End Card -->--}}
{{--            </div>--}}
{{--            <div class="col-lg-8 col-nd-6" id="view-conversation">--}}
{{--                <center class="mt-2">--}}
{{--                    <h4 class="initial-29">messages.viewconversation--}}
{{--                    </h4>--}}
{{--                </center>--}}
{{--                 view here--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- End Row -->--}}
{{--    </div>--}}
@endsection

@push('script_2')
<script src="{{ asset('assets/js/spartan-multi-image-picker.js') }}"></script>

    <script>
        function viewConvs(url, id_to_active, conv_id, sender_id) {
            $('.customer-list').removeClass('conv-active');
            $('#' + id_to_active).addClass('conv-active');
            let new_url= "{{ route('message.list') }}" + '?conversation=' + conv_id+ '&user=' + sender_id;
            $.get({
                url: url,
                success: function(data) {
                    window.history.pushState('', 'New Page Title', new_url);
                    $('#view-conversation').html(data.view);
                    conversationList();
                }
            });

        }
        var page = 1;
        $('#conversation-list').scroll(function() {
            if ($('#conversation-list').scrollTop() + $('#conversation-list').height() >= $('#conversation-list')
                .height()) {
                page++;
                loadMoreData(page);
            }
        });

        function loadMoreData(page) {
            $.ajax({
                    url: "{{ route('message.list') }}" + '?page=' + page,
                    type: "get",
                    beforeSend: function() {

                    }
                })
                .done(function(data) {
                    if (data.html == " ") {
                        return;
                    }
                    $("#conversation-list").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }

        function fetch_data(page, query) {
            $.ajax({
                url: "{{ route('message.list') }}" + '?page=' + page + "&key=" + query,
                success: function(data) {
                    $('#conversation-list').empty();
                    $("#conversation-list").append(data.html);
                }
            })
        }

        $(document).on('keyup', '#serach', function() {
            var query = $('#serach').val();
            fetch_data(page, query);
        });
    </script>
@endpush
