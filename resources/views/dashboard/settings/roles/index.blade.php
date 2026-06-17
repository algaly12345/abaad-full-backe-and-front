@extends('layouts.admin')

@section('title','الادوار')

@section('content')


<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
          

            <div class="d-flex justify-content-between">
                <h4 class="card-title">الادوار</h4>
                 <a href="{{ route('roles.create') }}" class="btn btn-primary card-title">أنشاء</a>
            </div>

            <div class="table-responsive">
                <table class="table mb-0 datatable mdl-data-table data-table mb-0">

                    <thead>
                        <tr>
                            
                            <th>أسم الدور</th>
                            <th>الصلاحيات</th>
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

<script>
    $(function () {
     
     var table = $('.data-table').DataTable({
         serverSide: true,
         ajax: "{{ route('roles.index') }}",
         columns: [
             {data: 'name', name: 'name'},
             {data: 'permissions', name: 'permissions'},
            
             {data: 'action', name: 'action', orderable: false, searchable: false},
         ]
     });
     
   });
</script>
@endsection