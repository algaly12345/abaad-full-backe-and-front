@extends('layouts.admin')

@section('title','المحافظات')

@section('content')

    <div class="card">
        <div class="card-body">

            <h4 class="card-title">ارسال إشعار</h4>
            {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


            <form action="{{route('notification.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">العنوان</label>
                            <input id="notification_title" type="text" name="notification_title" class="form-control" placeholder="عنوان الإشعار" required maxlength="191">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">المنطقة</label>
                            <select id="zone" name="zone" class="form-control js-select2-custom" >
                                <option value="all">كل المناطق</option>
                                @foreach(\App\Models\Zone::orderBy('name')->get() as $z)
                                    <option value="{{$z['id']}}">{{$z['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="tergat">الى</label>

                            <select name="tergat" class="form-control" id="tergat" data-placeholder="example contact@company.com" required>
                                <option value="customer">للكل</option>
                                <option value="agent">المسوقين</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="mb-3">
                    <label for="formmessage">المحتوى :</label>
                    <textarea id="description"  name="description" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" id="submit" class="btn btn-primary">إرسال</button>
            </form>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">جميع الإشعارات </h4>
                <p class="card-title-desc">قائمة جميع الإشعارات للعملاء والمسوقين
                    rows editable.</p>

                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">
                        <thead>
                        <tr>
                            <th>المعرف</th>
                            <th>العنوان</th>
                            <th>الوصف</th>
                            <th>الي</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($notifications as $key => $notification)
                        <tr data-id="1">
                            <td data-field="id" style="width: 80px">1</td>
                            <td data-field="name">{{ $notification->title }}</td>
                            <td data-field="age">{{ $notification->description }}</td>
                            <td data-field="gender">{{ $notification->tergat }}</td>
                            <td style="width: 100px">
                                <a class="btn btn-outline-secondary btn-sm deleted" title="delete">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection
