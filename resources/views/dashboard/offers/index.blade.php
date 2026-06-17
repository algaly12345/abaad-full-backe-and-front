@extends('layouts.admin')


@section('title','العروض')


@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">العروض</h4>
                 <a href="{{ route('offers.create') }}" class="btn btn-primary card-title">أنشاء</a>
            </div>

            <div class="table-responsive"> 
                <table class="table mb-0 datatable mdl-data-table data-table mb-0">

                    <thead>
                        <tr>
                            <th>عنوان العرض</th>
                            <th>سعر العرض</th>
                            <th>خصم العرض</th>
                            <th>نوع العرض</th>
                            <th>تاريخ العرض</th>
                            <th>حالة العرض</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                       {{-- @foreach ($offers as $key => $offer)
                       <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $offer->title }}</td>
                        <td>{{ $offer->service_price ?? '0' }}</td>
                        <td>{{ $offer->discount ?? '0' }}</td>
                        <td>{{ $offer->offer_type }}</td> 
                        <td>{{ $offer->expiry_date }}</td> 
                        <td>{{ $offer->isSended() }}</td> 
                        
                    </tr>
                       @endforeach --}}
                       
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
          ajax: "{{ route('offers.index') }}",
          columns: [
              {data: 'title', name: 'title'},
              {data: 'service_price', name: 'service_price'},
              {data: 'discount', name: 'discount'},
              {data: 'offer_type', name: 'offer_type'},
              {data: 'expiry_date', name: 'expiry_date'},
              {data: 'offer_status', name: 'offer_status',searchable:true},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>

@endsection