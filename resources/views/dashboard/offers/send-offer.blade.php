@extends('layouts.admin')

@section('title','أرسال العرض')
@section('content')



    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                   
                    
    
                    <h3 class="card-title mb-4">العرض</h3>
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
    
                </div>
            </div>
        </div>
    
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">أرسال العرض</div>
                      <form action="{{ route('send.offer.page.post',$offer->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">المنطقة</label>
                            @error('title')
                                
                            <span class="error-message">
                                {{ $message }}
                            </span>
                           @enderror
                            <div class="input-group">
                                
                                <select name="zone_id" id="" class="form-control">
                                    @foreach ($zones as $zone)
                                        
                                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <!-- input-group -->
                        </div>

                        <div class="mb-3">
                             <button class="btn btn-primary" type="submit">أرسال</button>
                            <!-- input-group -->
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>



@endsection