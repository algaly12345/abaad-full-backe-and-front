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
                <table class="table mb-0">

                    <thead>
                        <tr>
                            <th>#</th>
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
                       @foreach ($offers as $key => $offer)
                       <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $offer->title }}</td>
                        <td>{{ $offer->service_price ?? '0' }}</td>
                        <td>{{ $offer->discount ?? '0' }}</td>
                        <td>{{ $offer->offer_type }}</td> 
                        <td>{{ $offer->expiry_date }}</td> 
                        <td>{{ $offer->isSended() }}</td> 
                        <td>
                            <a href="{{ route('offers.edit',$offer->id) }}" class="btn btn-success">تعديل</a>
                            <a href="" class="btn btn-danger">حذف</a>
                            <a href="{{ route('send.offer.page',$offer->id) }}" class="btn btn-dark">أرسال عرض</a>
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