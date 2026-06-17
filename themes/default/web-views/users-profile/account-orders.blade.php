@extends('layouts.front-end.app')

@section('title', translate('my_Order_List'))

@section('content')

    <div class="container py-2 py-md-4 p-0 p-md-2 user-profile-container px-5px">
        <div class="row">
            @include('web-views.partials._profile-aside')

            <section class="col-lg-9 __customer-profile customer-profile-wishlist px-0">
                <div class="card __card d-none d-lg-flex web-direction customer-profile-orders h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between gap-2 mb-0 mb-md-3">
                            <h5 class="font-bold mb-0 fs-16">{{ translate('My_property_list') }}</h5>
                        </div>

                        @if($orders->count()>0)
                        <div class="table-responsive">
                            <table class="table __table __table-2 text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <td class="tdBorder">
                                            <div>
                                                <span class="d-block spandHeadO text-start text-capitalize">
                                                    {{ translate('My_property_list') }}
                                                </span>
                                            </div>
                                        </td>

                                        <td class="tdBorder">
                                            <div>
                                                <span class="d-block spandHeadO">
                                                    {{ translate('status') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="tdBorder">
                                            <div>
                                                <span class="d-block spandHeadO">
                                                    {{ translate('Number_of_views') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="tdBorder">
                                            <div>
                                                <span class="d-block spandHeadO">
                                                    {{ translate('action') }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="bodytr">
                                            <div class="media-order">
                                                <a href="{{ route('details', ['id'=>$order->id]) }}" class="d-block position-relative">
                                                    {{-- /test/details/${estate.id} --}}
                                                    {{-- <img alt="{{ translate('shop') }}"
                                                         src="{{ getStorageImages(path: $web_config['fav_icon'], type: 'shop') }}">
 --}}



                                            @php
                                            $images = json_decode($order->images, true); // Decode the JSON string to a PHP array
                                        @endphp

                                        @if (!empty($images) && isset($images[0]))
                                            <img class="border-lighter" alt="{{ translate('estate') }}"
                                                 src="{{ asset('storage/app/public/estate/' . $images[0]) }}">
                                        @else

                                        <img alt="{{ translate('estate') }}"
                                        src="{{ asset('public/assets/images/default-estate.jpg') }}">


                                        @endif

                                                </a>
                                                <div class="cont text-start">
                                                <h6 class="font-weight-bold m-0 mb-1">
                                                    <a href="{{ route('account-order-details', ['id'=>$order->id]) }}"
                                                        class="fs-14 font-semibold">
                                                        {{ translate('cateogry') }}  {{$order->category->name}}


                                                    </a>
                                                </h6>


                                                <h6 class="font-weight-bold m-0 mb-1">
                                                    <a href="{{ route('account-order-details', ['id'=>$order->id]) }}"
                                                        class="fs-14 font-semibold">
                                                        {{ translate('price') }}  {{$order->price}}


                                                    </a>
                                                </h6>
                                                    <span class="fs-12 font-weight-medium">
                                                        {{ $order->address }} {{ translate('address') }}
                                                    </span>
                                                    <div class="text-secondary-50 fs-12 font-semibold mt-1">
                                                        {{date('d M, Y h:i A',strtotime($order['created_at'])) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="bodytr">
                                            @if($order['status']=='disactive')
                                                <span class="status-badge rounded-pill __badge badge-soft-danger fs-12 font-semibold text-capitalize">
                                                    {{ translate($order['status'] =='disactive' ? 'Disactivated' : $order['status']) }}
                                                </span>
                                            @elseif($order['status']=='active' )
                                                <span class="status-badge rounded-pill __badge badge-soft-success fs-12 font-semibold text-capitalize">
                                                    {{ translate($order['status']=='active' ? 'Activated' : $order['status']) }}
                                                </span>
                                            @else
                                                <span class="status-badge rounded-pill __badge badge-soft-primary fs-12 font-semibold text-capitalize">
                                                    {{ translate($order['order_status']) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="bodytr">
                                            <div class="text-dark fs-13 font-bold">


                                                {{$order->view}}
                                            </div>
                                        </td>
                                        <td class="bodytr">
                                            <div class="__btn-grp-sm flex-nowrap">
                                                <!-- View Order Details -->
                                                <a href="{{ route('account-order-details', ['id' => $order->id]) }}"
                                                   class="btn-outline--info text-base __action-btn btn-shadow rounded-full" title="{{ translate('view_order_details') }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <!-- Download Invoice -->
                                                <a href="{{ route('generate-invoice', [$order->id]) }}"
                                                   class="btn-outline-success text-success __action-btn btn-shadow rounded-full" title="{{ translate('download_invoice') }}">
                                                    <i class="tio-download-to"></i>
                                                </a>

                                                <!-- Edit Order -->
                                                <a href=""
                                                {{-- {{ route('view-order-images', ['id' => $order->id]) }} --}}
                                                   class="btn-outline-primary text-primary __action-btn btn-shadow rounded-full" title="{{ translate('edit_order') }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <!-- View Images -->
                                                <a href="javascript:void(0);"
                                                {{-- {{ route('view-order-images', ['id' => $order->id]) }} --}}
                                                   class="btn-outline-warning text-warning __action-btn btn-shadow rounded-full" title="{{ translate('view_images') }}"  data-toggle="modal" data-target="#imagesModal"
                                                   onclick="loadImages({{ $order->id }})">
                                                    <i class="fa fa-image"></i>
                                                </a>



                                                <!-- View Video -->
                                                <a href=""
                                                {{-- {{ route('view-order-video', ['id' => $order->id]) }} --}}
                                                   class="btn-outline-danger text-danger __action-btn btn-shadow rounded-full" title="{{ translate('view_video') }}">
                                                    <i class="fa fa-video"></i>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                                    <img src="{{ theme_asset(path: 'public/assets/front-end/img/empty-icons/empty-orders.svg') }}" alt="" width="100">
                                    <h5 class="text-muted fs-14 font-semi-bold text-center">{{ translate('You_have_not_any_order_yet') }}!</h5>
                                </div>
                            </div>
                        @endif


                        <div class="card-footer border-0">
                            {{$orders->links() }}
                        </div>
                    </div>
                </div>

                <div class="bg-white d-lg-none web-direction">
                    <div class="card-body d-flex flex-column gap-3 customer-profile-orders py-0">

                        <div class="d-flex align-items-center justify-content-between gap-2 mb-0 mb-md-3">
                            <h5 class="font-bold mb-0 fs-16">{{ translate('my_Order') }}</h5>

                            <button class="profile-aside-btn btn btn--primary px-2 rounded px-2 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 9.81219C7 9.41419 6.842 9.03269 6.5605 8.75169C6.2795 8.47019 5.898 8.31219 5.5 8.31219C4.507 8.31219 2.993 8.31219 2 8.31219C1.602 8.31219 1.2205 8.47019 0.939499 8.75169C0.657999 9.03269 0.5 9.41419 0.5 9.81219V13.3122C0.5 13.7102 0.657999 14.0917 0.939499 14.3727C1.2205 14.6542 1.602 14.8122 2 14.8122H5.5C5.898 14.8122 6.2795 14.6542 6.5605 14.3727C6.842 14.0917 7 13.7102 7 13.3122V9.81219ZM14.5 9.81219C14.5 9.41419 14.342 9.03269 14.0605 8.75169C13.7795 8.47019 13.398 8.31219 13 8.31219C12.007 8.31219 10.493 8.31219 9.5 8.31219C9.102 8.31219 8.7205 8.47019 8.4395 8.75169C8.158 9.03269 8 9.41419 8 9.81219V13.3122C8 13.7102 8.158 14.0917 8.4395 14.3727C8.7205 14.6542 9.102 14.8122 9.5 14.8122H13C13.398 14.8122 13.7795 14.6542 14.0605 14.3727C14.342 14.0917 14.5 13.7102 14.5 13.3122V9.81219ZM12.3105 7.20869L14.3965 5.12269C14.982 4.53719 14.982 3.58719 14.3965 3.00169L12.3105 0.915687C11.725 0.330188 10.775 0.330188 10.1895 0.915687L8.1035 3.00169C7.518 3.58719 7.518 4.53719 8.1035 5.12269L10.1895 7.20869C10.775 7.79419 11.725 7.79419 12.3105 7.20869ZM7 2.31219C7 1.91419 6.842 1.53269 6.5605 1.25169C6.2795 0.970186 5.898 0.812187 5.5 0.812187C4.507 0.812187 2.993 0.812187 2 0.812187C1.602 0.812187 1.2205 0.970186 0.939499 1.25169C0.657999 1.53269 0.5 1.91419 0.5 2.31219V5.81219C0.5 6.21019 0.657999 6.59169 0.939499 6.87269C1.2205 7.15419 1.602 7.31219 2 7.31219H5.5C5.898 7.31219 6.2795 7.15419 6.5605 6.87269C6.842 6.59169 7 6.21019 7 5.81219V2.31219Z" fill="white"/>
                                </svg>
                            </button>
                        </div>

                        @foreach($orders as $order)
                            <div class="d-flex border-lighter rounded p-2 justify-content-between gap-2">
                                <div class="">
                                    <div class="media-order">
                                        <a href="{{ route('details', ['id'=>$order->id]) }}" class="d-block position-relative">
                                            {{-- @if($order->seller_is == 'seller') --}}


                                            @php
                                            $images = json_decode($order->images, true); // Decode the JSON string to a PHP array
                                        @endphp

                                        @if (!empty($images) && isset($images[0]))
                                            <img class="border-lighter" alt="{{ translate('shop') }}"
                                                 src="{{ asset('storage/app/public/estate/' . $images[0]) }}">
                                        @else

                                        <img class="border-lighter" alt="{{ translate('shop') }}"
                                        src="{{ asset('public/assets/images/default-estate.jpg') }}">


                                        @endif

                                        </a>
                                        <div class="cont text-start">
                                            <h6 class="font-weight-bold mb-1 fs-14">
                                                <a class="fs-12 font-semibold" href="{{ route('details', ['id'=>$order->id]) }}">
                                                  {{ $order->title }}
                                                </a>
                                            </h6>


                                            <h6 class="font-weight-bold mb-1 fs-14">
                                                <a class="fs-12 font-semibold" href="{{ route('details', ['id'=>$order->id]) }}">
                                                    {{ translate('price') }} :{{$order->price}}
                                                </a>
                                            </h6>
                                            <div class="d-flex flex-column gap-1 fs-12">
                                                <span class="fs-12 font-weight-normal">{{ $order->order_details_sum_qty }} {{ translate('items') }}</span>
                                                <div class="fs-11 font-semibold text-secondary-50">{{date('d M, Y h:i A',strtotime($order['created_at'])) }}</div>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <div class="text-nowrap fs-11 font-semibold text-secondary-50">{{ translate('Number_of_views') }} :</div>
                                                    <div class="text-dark fs-13 font-weight-bold">{{$order->view}}</div>
                                                </div>
                                                <div class="my-2">
                                                    @if($order['status']=='disactive')
                                                        <span class="status-badge __badge badge-soft-danger border-soft-danger text-capitalize">
                                                            {{ translate($order['status'] =='failed' ? 'disactive' : $order['status']) }}
                                                        </span>
                                                                @elseif($order['status']=='disactive' )
                                                                    <span class="status-badge __badge badge-soft-success border-soft-success text-capitalize">
                                                            {{ translate($order['status']=='processing' ? 'packaging' : $order['status']) }}
                                                        </span>
                                                                @else
                                                                    <span class="status-badge __badge badge-soft-primary border-soft-primary text-capitalize">
                                                            {{ translate($order['status']) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="__btn-grp-sm">
                                    <!-- View Order Details -->
                                    <a href="{{ route('details', ['id' => $order->id]) }}"
                                       class="btn-outline--info text-base __action-btn btn-shadow rounded-full" title="{{ translate('view_order_details') }}">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <!-- Download Invoice -->
                                      <!-- Delete Order -->

                                      {{-- {{ route('delete-order', [$order->id]) }} --}}
       <!-- Delete Order -->
       <a href="{{ route('delete-estate', [$order->id]) }}" title="{{ translate('delete_order') }}"
        class="btn-outline-danger text-danger __action-btn btn-shadow rounded-full"
        onclick="return confirm('{{ translate('Are you sure you want to delete this order?') }}');">
         <i class="fa fa-trash"></i>
     </a>
             <!-- Edit Order -->
                                    <a href=""
                                    {{-- {{ route('edit-order', ['id' => $order->id]) }} --}}
                                       class="btn-outline-primary text-primary __action-btn btn-shadow rounded-full" title="{{ translate('edit_order') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- View Images -->
                                  <!-- Button to Open Modal -->
<!-- Button to Open Modal -->
<a href="javascript:void(0);"
   class="btn-outline-warning text-warning __action-btn btn-shadow rounded-full"
   title="{{ translate('view_images') }}"
   data-toggle="modal" data-target="#imagesModal"
   onclick="loadImages({{ $order->id }})">
    <i class="fa fa-image"></i>
</a>

                                    <!-- View Video -->
                                    <a href=""
                                    {{-- {{ route('view-order-video', ['id' => $order->id]) }} --}}
                                       class="btn-outline-danger text-danger __action-btn btn-shadow rounded-full" title="{{ translate('view_video') }}">
                                        <i class="fa fa-video"></i>
                                    </a>
                                </div>

                            </div>




                        @endforeach

                        @if($orders->count()==0)
                            <div class="d-flex justify-content-center align-items-center h-100 pt-5">
                                <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                                    <img src="{{ theme_asset(path: 'public/assets/front-end/img/empty-icons/empty-orders.svg') }}" alt="" width="100">
                                    <h5 class="text-muted fs-14 font-semi-bold text-center">{{ translate('You_have_not_any_order_yet') }}!</h5>
                                </div>
                            </div>
                        @endif

                        <div class="card-footer border-0">
                            {{$orders->links() }}
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>



<!-- Modal for Viewing and Adding Images -->
<div class="modal fade" id="imagesModal" tabindex="-1" role="dialog" aria-labelledby="imagesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagesModalLabel">{{ translate('Property Images') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Display Existing Images -->
                <div class="row mb-4" id="imagesContainer">
                    <!-- Existing images will be loaded here dynamically -->
                </div>
                <hr>
                <!-- Section for uploading new images -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <h4 class="card-title mb-4">صور العقار</h4>
                            <div class="col-lg-8">
                                <div class="form-group m-0">
                                    <div>
                                        <div class="row" id="estate_imag"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                <button type="button" class="btn btn-primary" id="uploadImagesButton">{{ translate('Upload Images') }}</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                هل أنت متأكد من أنك تريد حذف هذه الصورة؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">حذف</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script src="{{ asset('public/assets/admin/js/vendor.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/theme.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/sweet_alert.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/toastr.js') }}"></script>
<script src="{{asset('public/assets/admin/js/owl.min.js')}}"></script>
<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/spartan-multi-image-picker.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/spartan-multi-image-picker.js') }}"></script>
<script>
    let imageToDelete = null;
    let propertyId = null;
    var baseUrl = "{{ url('/properties') }}";

    // Function to load images for a given property
    function loadImages(id) {
        propertyId = id;
        let url = `${baseUrl}/${encodeURIComponent(id)}/images`;

        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    let imagesContainer = $('#imagesContainer');
                    imagesContainer.empty(); // Clear any existing content

                    $.each(data.images, function(index, image) {
                        let imageHtml = `
                            <div class="col-md-4 mb-3">
                                <div class="position-relative" style="width: 100%; height: auto;">
                                    <img src="{{ asset('storage/app/public/estate/') }}/${image}" class="img-fluid rounded border" alt="Property Image" style="width: 100%; height: auto;">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                                        style="z-index: 10; border-radius: 50%; padding: 0; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;"
                                        onclick="prepareDeleteImage('${image}')">
                                        <i class="fa fa-trash" style="font-size: 16px;"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                        imagesContainer.append(imageHtml);
                    });
                } else {
                    alert(data.message);
                }
            },
            error: function() {
                alert('Failed to load images.');
            }
        });
    }

    // Function to prepare for image deletion
    function prepareDeleteImage(imageName) {
        console.log('Preparing to delete image:', imageName); // Debugging line
        imageToDelete = imageName;
        $('#confirmDeleteModal').modal('show'); // Show the confirmation modal
    }

    // Confirm delete button click handler
    $(document).on('click', '#confirmDeleteButton', function() {
        console.log('Confirm delete button clicked'); // Debugging line

        if (imageToDelete) {
            let deleteUrl = `${baseUrl}/${propertyId}/images/${encodeURIComponent(imageToDelete)}`;
            console.log('Deleting image with URL:', deleteUrl); // Debugging line

            $.ajax({
                url: deleteUrl,
                method: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.success) {
                        $('#confirmDeleteModal').modal('hide');
                        alert('Image deleted successfully.');
                        loadImages(propertyId); // Reload images after deletion
                    } else {
                        $('#confirmDeleteModal').modal('hide');
                        alert(data.message);
                    }
                },
                error: function(xhr) {
                    $('#confirmDeleteModal').modal('hide');
                    alert('Failed to delete the image: ' + xhr.responseText);
                    console.error('Failed to delete the image:', xhr.responseText);
                }
            });
        } else {
            console.log('No image selected for deletion'); // Debugging line
        }
    });




    $(document).ready(function() {
    // Initialize Spartan Multi Image Picker
    $("#estate_imag").spartanMultiImagePicker({
        fieldName: 'estate_image[]',  // The field name for images
        maxCount: 5,  // Maximum number of images
        rowHeight: '120px',
        groupClassName: 'col-lg-2 col-md-4 col-sm-4 col-6',
        maxFileSize: '',  // Optional: specify the maximum file size
        placeholderImage: {
            image: '{{ asset('assets/admin/img/400x400/img2.jpg') }}',  // Default placeholder image
            width: '100%'
        },
        dropFileLabel: "Drop Here",  // Label text for file drop area
        onAddRow: function(index, file) {
            console.log('Image added:', index);
        },
        onRenderedPreview: function(index) {
            console.log('Preview rendered:', index);
        },
        onRemoveRow: function(index) {
            console.log('Image removed:', index);
        },
        onExtensionErr: function(index, file) {
            toastr.error('{{ __('messages.please_only_input_png_or_jpg_type_file') }}', {
                CloseButton: true,
                ProgressBar: true
            });
        },
        onSizeErr: function(index, file) {
            toastr.error('{{ __('messages.file_size_too_big') }}', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    });





    $(document).on('click', '#uploadImagesButton', function() {
            let formData = new FormData();

            // Get files from input
            let files = $("#estate_image_upload")[0].files;
            if (files.length > 0) {
                $.each(files, function(index, file) {
                    formData.append('estate_image[]', file);
                });

                $.ajax({
                    url: `${baseUrl}/${propertyId}/images`,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#imagesModal').modal('hide');
                            alert('Images uploaded successfully.');
                            loadImages(propertyId); // Reload images after upload
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Failed to upload images: ' + xhr.responseText);
                        console.error('Failed to upload images:', xhr.responseText);
                    }
                });
            } else {
                alert('No images selected for upload.');
            }
        });


});






</script>



<script>
    $('#reset_btn').click(function(){
        $('#viewer').attr('src','{{asset('assets/admin/img/900x400/img1.jpg')}}');
        $('#estate_imag').attr('src','{{asset('assets/admin/img/900x400/img1.jpg')}}');
    })

    $('#reset_btn').click(function(){
        $('#viewer').attr('src','{{asset('assets/admin/img/900x400/img1.jpg')}}');
        $('#planed_image').attr('src','{{asset('assets/admin/img/900x400/img1.jpg')}}');
    })
</script>





@endpush
