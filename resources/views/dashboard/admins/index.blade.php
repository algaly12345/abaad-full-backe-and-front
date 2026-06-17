@extends('layouts.admin')

@section('title','المدراء')


@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">المدراء</h4>

            <div class="table-responsive">
                <table class="table mb-0 datatable mdl-data-table data-table mb-0">

                    <thead>
                        <tr>
                            {{-- <th>#</th> --}}
                            <th>أسم المدير</th>
                            <th>رقم الجوال</th>
                            <th>البريد الالكتروني</th>
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
          ajax: "{{ route('admins.index') }}",
          columns: [
              {data: 'name', name: 'name'},
              {data: 'phone', name: 'phone'},
              {data: 'email', name: 'email'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
</script>

@endsection