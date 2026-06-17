@extends('layouts.admin')


@section('title','مزودين الخدمات')

@section('content')
 
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">مزودين الخدمات</h4>
                 <a href="{{ route('service-providers.create') }}" class="btn btn-primary card-title">أنشاء</a>
            </div>

            <div class="table-responsive">
                <table class="table mb-0 datatable mdl-data-table data-table mb-0">

                    <thead>
                        <tr>
                            
                            <th>أسم مزود الخدمة</th>
                            <th>المنطقة</th>
                            <th>رقم الجوال</th>
                            <th>الوظيفة</th>
                            <th>العنوان</th>
                            <th>البريد الالكتروني</th>
                            <th>الحالة </th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                       
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection


@section('scripts')

<script type="text/javascript">
    $(function () { 
      
      var table = $('.data-table').DataTable({
          serverSide: true,
          ajax: "{{ route('service-providers.index') }}",
          columns: [
              {data: 'name', name: 'name'},
              {data: 'zone_name', name: 'zone_name'},
              {data: 'phone', name: 'phone'},
              {data: 'job', name: 'job'},
            //   {data: 'expiry_date', name: 'expiry_date'},
              {data: 'address', name: 'address',searchable:true},
              {data: 'email', name: 'email',searchable:true},
              {data: 'status', name: 'status',searchable:true},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>

@endsection