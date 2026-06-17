@extends('layouts.admin')

@section('title','العرض')
@section('content')



    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">


                     <div class="d-flex justify-content-between">

                         <h3 class="card-title mb-4">العرض</h3>
                           <a class="btn btn-info" href="{{ url()->previous() }}">رجوع</a>


                     </div>
                    <div id="upcoming-task" class="pb-1 task-list">
                        <div class="card task-box">
                            <div class="card-body">

                                <div>
                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">عنوان العرض</a></h5>
                                    <p class="text-muted mb-4">{{ $offer->title }}</p>
                                </div>


                            </div>

                        </div>

                    </div>

                    <div id="upcoming-task" class="pb-1 task-list">
                        <div class="card task-box">
                            <div class="card-body">

                                <div>
                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">نوع الخدمة</a></h5>
                                    <p class="text-muted mb-4">{{ $offer->serviceType->name }}</p>
                                </div>


                            </div>

                        </div>

                    </div>


                    <div id="upcoming-task" class="pb-1 task-list">
                        <div class="card task-box">
                            <div class="card-body">

                                <div>
                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">تاريخ الانتهاء</a></h5>
                                    <p class="text-muted mb-4">{{ $offer->expiry_date }}</p>
                                </div>


                            </div>

                        </div>

                    </div>

                    <div id="upcoming-task" class="pb-1 task-list">
                        <div class="card task-box">
                            <div class="card-body">

                                <div>
                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">سعر الخدمة</a></h5>
                                    <p class="text-muted mb-4">{{ $offer->service_price }}</p>
                                </div>


                            </div>

                        </div>

                    </div>


                    <div id="upcoming-task" class="pb-1 task-list">
                        <div class="card task-box">
                            <div class="card-body">

                                <div>
                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">وصف العرض</a></h5>
                                    <p class="text-muted mb-4">{{ $offer->description }}</p>
                                </div>


                            </div>

                        </div>

                    </div>

                    <div id="upcoming-task" class="pb-1 task-list">
                        <div class="card task-box">
                            <div class="card-body">

                                <div>
                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">المناطق</a></h5>
                                    <p class="text-muted mb-4">
                                   @foreach($offer->zones as $zone)
                                        <span>{{ $zone->name_ar }},</span>
                                    @endforeach
                                </p>
                                </div>


                            </div>

                        </div>

                    </div>

                    <div id="upcoming-task" class="pb-1 task-list">
                        <div class="card task-box">
                            <div class="card-body">

                                <div>
                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">الاقسام</a></h5>
                                    <p class="text-muted mb-4">
                                   @foreach($offer->categories as $category)
                                        <span>{{ $category->name_ar }},</span>
                                    @endforeach
                                </p>
                                </div>


                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>



@endsection
