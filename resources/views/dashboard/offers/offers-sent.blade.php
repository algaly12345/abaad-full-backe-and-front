@extends('layouts.admin')


@section('title','العروض')


@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">العروض المرسلة</h4>

            <div class="table-responsive">
                <table class="table mb-0 datatable mdl-data-table data-table mb-0">

                    <thead>
                        <tr>
                            
                            <th>عنوان العرض</th>
                            <th>سعر العرض</th>
                            <th>تاريخ العرض</th>
                            <th>حالة العرض</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    
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
          ajax: "{{ route('offers.sent') }}",
          columns: [
              {data: 'title', name: 'title'},
              {data: 'service_price', name: 'service_price'},
              {data: 'expiry_date', name: 'expiry_date'},
              {data: 'offer_status', name: 'offer_status',searchable:true},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>

@endsection