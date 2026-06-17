@extends('layouts.admin')


@section('title','قائمة العروض')

@section('content')
    <link href="{{ asset('assets/libs/admin-resources/rwd-table/rwd-table.min.css')}}" rel="stylesheet" type="text/css" />
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-2">
                                <label class="form-label" for="validationCustom03">City</label>
                                <select class="form-control" id="categories_filter" name="categories">
                                    <option value="">قسم العقار</option>
                                    @if(count($categories))
                                        @foreach($categories as $category)
                                            <option value="{{$category->name}}"  {{(Request::query('categories') && Request::query('categories')==$category->name)?'selected':''}}  >{{$category->name}}</option>
                                        @endforeach
                                    @endif


                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-2">
                                <label class="form-label" for="validationCustom04">المنطقة</label>
                                <select class="form-control" id="zones_filter" name="zones">
                                    <option value="">المنطقة</option>
                                    @if(count($zones))
                                        @foreach($zones as $category)
                                            <option value="{{$category->name}}"  {{(Request::query('zones') && Request::query('zones')==$category->name)?'selected':''}}  >{{$category->name}}</option>
                                        @endforeach
                                    @endif


                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
                        </div>



                        <div class="col-md-2">
                            <div class="mb-2">
                                <label class="form-label" for="validationCustom05">بحث برفم الإعلان</label>
                                <input type="text" class="form-control"  name="keyword" placeholder="ادخل رقم الإعلان" id="keyword">

                                <div class="invalid-feedback">
                                    Please provide a valid zip.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-2">

                                <label class="form-label" for="validationCustom05">بحث</label>
                                <br>
                                <button type="button" onclick="search_post()" class="btn btn-primary" >بحث</button>
                                <div class="invalid-feedback">
                                    Please provide a valid zip.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-2">

                                <label class="form-label" for="validationCustom05">بحث</label>
                                <br>
                                <a href="{{ route('estate.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> إضافة</a>
                                <div class="invalid-feedback">
                                    Please provide a valid zip.
                                </div>
                            </div>
                        </div>
                    </div>







                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>رقم الإعلان</th>
                                    <th data-priority="1">نوع الإعلان</th>
                                    <th data-priority="3">قسم الإعلان</th>
                                    <th data-priority="1">السعر</th>
                                    <th data-priority="3">المساحة</th>
                                    <th data-priority="3">المدينة</th>
                                    <th data-priority="6">المنطقة</th>
                                    <th data-priority="7">المعلن</th>
                                    <th data-priority="8">رقم الإعلان</th>
                                    <th data-priority="9">إجراء</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($estates as $index=>$estate)
                                <tr>

                                    <td>{{ $estate->ad_number }}</td>
                                    <td>{{ $estate->type_add }}</td>
                                    <td>{{ $estate->category->name }}</td>
                                    <td>{{ $estate->price }}</td>
                                    <td>{{ $estate->space }}</td>
                                    <td>{{ $estate->city }}</td>
                                    <td>{{ $estate->zone->name }}</td>
                                    @if($estate->users)
                                        <td>{{ $estate->users->name }}</td>
                                    @else
                                        <td style="color: red">لاتوجد محافظة</td>
                                    @endif
                                    <td>{{ $estate->advertiser_no }}</td>

                                    <td>
{{--                                        @if (auth()->user()->hasPermission('update_offices'))--}}
{{--                                            <a href="{{ route('dashboard.offices.edit', $category->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> تعديل</a>--}}
{{--                                        @else--}}
                                        <a href="{{ route('estate.edit', $estate->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> تعديل</a>
{{--                                        @endif--}}
{{--                                        @if (auth()->user()->hasPermission('delete_offices'))--}}
{{--                                            <form action="{{ route('dashboard.offices.destroy', $category->id) }}" method="post" style="display: inline-block">--}}
{{--                                                {{ csrf_field() }}--}}
{{--                                                {{ method_field('delete') }}--}}
{{--                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> حذف</button>--}}
{{--                                            </form><!-- end of form -->--}}
{{--                                        @else--}}
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> حذف</button>
{{--                                        @endif--}}
                                    </td>

                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

@endsection

@push('script_2')

    <script type="text/javascript">
        var query=<?php echo json_encode((object)Request::only(['categories','keyword','zones'])); ?>;


        function search_post(){

            console.log("-------------------search ")
            Object.assign(query,{'categories': $('#categories_filter').val()});
            Object.assign(query,{'zones': $('#zones_filter').val()});
            Object.assign(query,{'keyword': $('#keyword').val()});

            window.location.href="{{route('estate.index')}}?"+$.param(query);

        }

        function sort(value){
            Object.assign(query,{'sortByComments': value});
            window.location.href="{{route('estate.index')}}?"+$.param(query);
        }

        // function delete_post(url){
        //
        //     swal({
        //         title: "Are you sure?",
        //         text: "Once deleted, you will not be able to recover this post!",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //         .then((willDelete) => {
        //             if (willDelete) {
        //                 $('#post_delete_form').attr('action',url);
        //                 $('#post_delete_form').submit();
        //             }
        //         });
        //
        //
        // }


    </script>
@endpush
