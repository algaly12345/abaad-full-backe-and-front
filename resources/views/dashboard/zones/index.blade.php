@extends('layouts.admin')


{{-- <style>
    #map {
  height: 100%;
}

/* 
 * Optional: Makes the sample page fill the window. 
 */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
</style> --}}


@section('title','المناطق')

@section('content')


<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">المناطق</h4>

            <div class="table-responsive">
                <table class="table mb-0 datatable mdl-data-table data-table mb-0">

                    <thead>
                        <tr>
                          
                            <th>أسم المنطقة</th>
                            <th>أسم اﻷقليم</th>
                            <th>الحالة</th>
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
          ajax: "{{ route('zones.index') }}",
          columns: [
              {data: 'name', name: 'name'},
              {data: 'territory', name: 'territory'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>

@endsection



