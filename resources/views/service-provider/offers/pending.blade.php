
@extends('layouts.back-end.app-seller')


@section('title', '      إضافة خدمة للعروض العقارية')
@push('css_or_js')


@section('content')


<div class="content container-fluid">

    <div class="mb-3">
        <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
            <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/inhouse-business-chart-list.png') }}" alt="">
           قائمة  المشاهد
            <span class="badge badge-soft-dark radius-50 fz-14 ml-1">
                {{ $credits->total() }}
            </span>
        </h2>
    </div>

    <div class="card-body">
        <h4 class="card-title">العروض الفي الانتظار</h4>

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

                     <a href="{{ route('service-provider.offers.status.accept',$offer->id) }}" class="btn btn-dark">
                        قبول
                       </a>
                </td>
                </tr>
                   @endforeach

                </tbody>
            </table>
        </div>

    </div>




</div>

@endsection
