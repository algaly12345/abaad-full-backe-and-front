@extends('layouts.admin')


@section('title','الباقات')

@section('content')
 
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">باقات الاشتراكات</h4>
                 <a href="{{ route('packages.create') }}" class="btn btn-primary card-title">أنشاء</a>
            </div>

            <div class="table-responsive">
                <table class="table mb-0 datatable mdl-data-table data-table mb-0">

                    <thead>
                        <tr>
                            
                            
                            <th>أسم الباقة</th>
                            <th>سعر الباقة</th>
                            <th>صلاحية الباقة</th>
                            <th>لون الباقة</th>
                            <th>مقدم خدمة او عقار</th>
                            <th>وصف الباقة</th>
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
          ajax: "{{ route('packages.index') }}",
          columns: [
              {data: 'package_name', name: 'package_name'},
              {data: 'price', name: 'price'},
              {data: 'validity', name: 'validity'},
              {data: 'color', name: 'color'},
            //   {data: 'expiry_date', name: 'expiry_date'},
              {data: 'tergat', name: 'tergat',searchable:true},
              {data: 'text', name: 'text',searchable:true},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>

@endsection