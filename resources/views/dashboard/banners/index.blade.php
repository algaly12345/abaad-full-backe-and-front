@extends('layouts.admin')

@section('title','المحافظات')

@section('content')

    <div class="card">
        <div class="card-body">

            <h4 class="card-title">اللافنة المتحرطة</h4>
            {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">الوصف</label>
                            <input id="title" type="text" name="title" class="form-control" placeholder="عنوان الإشعار" required maxlength="191">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">المنطقة</label>
                            <select id="zone" name="zone_id" class="form-control js-select2-custom" >
                                <option value="all">كل المناطق</option>
                                @foreach(\App\Models\Zone::orderBy('name')->get() as $z)
                                    <option value="{{$z['id']}}">{{$z['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">مقدمين الخدمة</label>
                            <select id="provider_id" name="provider_id" class="form-control js-select2-custom" >
                                <option value="all">مقدم الخدمة</option>
                                @foreach(\App\Models\User::where("user_type","provider")->where("is_active","active")->orderBy('name')->get() as $z)
                                    <option value="{{$z['id']}}">{{$z['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">صورة اللافتة</label>
                        <div class="form-group mt-auto">
                            <div style="text-align: center;">
                                <img style="height: 200px; width: 400px" class="initial-2" id="viewer"
                                     src="{{asset('assets/images/900x400/img1.jpg')}}" alt="campaign image"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-group mt-auto">
                        <div class="custom-file">
                            <input height="300" type="file" name="image" id="customFileEg1" class="custom-file-input"
                                   accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                            <label class="custom-file-label" for="customFileEg1">اختر</label>
                        </div>
                    </div>
                </div>



                <button type="submit" id="submit" class="btn btn-primary">إرسال</button>
            </form>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">القائمة</h4>


                <div class="table-responsive">
                    <table class="table table-bordered mb-0">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>وصف مختصر </th>
                            <th>مقدم الخدمة</th>
                            <th>الحالة</th>
                            <th>الإجراء</th>
                        </tr>
                        </thead>
                        <tbody>
                                                @foreach ($banners as $key => $banner)
                        <tr>
                            <th scope="row">1</th>
                            <td>
                                        <span class="media align-items-center">
                                            <img class="avatar avatar-lg mr-3 avatar--3-1" src="{{ storage_path().'/images/'.$banner->image }}/{{$banner['image']}}"
                                                 onerror="this.src='{{asset('assets/images/900x400/img1.jpg')}}'" alt="{{$banner->title}} image">
                                            <div class="media-body">
                                                <h5 class="text-hover-primary mb-0">{{Str::limit($banner['title'], 25, '...')}}</h5>
                                            </div>
                                        </span>
                            </td>
                            <td>{{ $banner->title }}</td>
                            <td>{{ $banner->title }}</td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn" href=""title="edit"><i class="tio-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn" href="javascript:" onclick="form_alert('banner-{{$banner['id']}}','Want to delete this banner')" title="delete" ><i class="tio-delete-outlined"></i>
                                    </a>
                                    <form action="{{route('banners.delete',[$banner['id']])}}"
                                          method="post" id="banner-{{$banner['id']}}">
                                        @csrf @method('delete')
                                    </form>
                                </div>
                            </td>
                        </tr>
                                                @endforeach
                        </tbody>
                    </table>
                </div>

            </div>









            <div class="card-body">
{{--                <h4 class="card-title">جميع الإشعارات </h4>--}}
{{--                <p class="card-title-desc">قائمة جميع الإشعارات للعملاء والمسوقين--}}
{{--                    rows editable.</p>--}}

{{--                <div class="table-responsive">--}}
{{--                    <table class="table table-editable table-nowrap align-middle table-edits">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>المعرف</th>--}}
{{--                            <th>العنوان</th>--}}
{{--                            <th>الوصف</th>--}}
{{--                            <th>الي</th>--}}
{{--                            <th>حذف</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach ($banners as $key => $banner)--}}
{{--                        <tr data-id="1">--}}
{{--                            <td data-field="id" style="width: 80px">1</td>--}}
{{--                            <td data-field="name">{{ $notification->title }}</td>--}}
{{--                            <td data-field="age">{{ $notification->description }}</td>--}}
{{--                            <td data-field="gender">{{ $notification->tergat }}</td>--}}
{{--                            <td style="width: 100px">--}}
{{--                                <a class="btn btn-outline-secondary btn-sm deleted" title="delete">--}}
{{--                                    <i class="fas fa-pencil-alt"></i>--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}

{{--            </div>--}}
        </div>
    </div>


@endsection

@push('script_2')
    <script>

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            console.log("omrtomrt")
            readURL(this);
        });
    </script>

    <script>
        $('#reset_btn').click(function(){
            $('#zone').val(null).trigger('change');
            $('#choice_item').val(null).trigger('change');
            $('#viewer').attr('src','{{asset('assets/images/900x400/img1.jpg')}}');
        })
    </script>
@endpush
