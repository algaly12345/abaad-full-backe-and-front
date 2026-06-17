@extends('layouts.admin')


@section('title','العروض')


@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">العروض تمت الموافقة </h4>

            <div class="table-responsive">
                <table class="table mb-0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان العرض</th>
                            <th>سعر العرض</th>
                            <th>تاريخ العرض</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($offers as $key => $offer)
                       <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $offer->title }}</td>
                        <td>{{ $offer->service_price }}</td>
                        <td>{{ $offer->expiry_date }}</td> 
                         <td>
                            <a href="{{ route('service-provider.offers.display',$offer->id) }}" class="btn btn-success">
                           عرض
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