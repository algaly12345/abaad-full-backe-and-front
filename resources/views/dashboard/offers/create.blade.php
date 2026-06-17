@extends('layouts.admin')


@section('title','العروض')

@section('content')

<div class="card" id="app">
    <div class="card-body">

        <h4 class="card-title">أنشاء عرض</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-6">
                   
                    <div class="mb-3">
                        <label class="form-label">عنوان العرض</label>
                        @error('title')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <input type="text" name="title" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">اختار الخدمة</label>
                        @error('service_type_id')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <select name="service_type" class="form-control select-item" id="">
                                @foreach ($serviceTypes as $serviceType)
                                    <option value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <!-- input-group -->
                    </div>


                    {{-- <div class="mb-3">
                        <label class="form-label">تحديد نوع العرض</label>
                        
                        <div class="input-group">
                            
                           

                            <select class="form-control" name="offer_type" id="" @change="setOfferType($event)">
                                <option value="#"></option>
                                <option value="discount">
                                    خصم
                                </option>
                                <option value="price">
                                     سعر
                                </option>
                            </select>
                            
                        </div>
                        <!-- input-group -->
                    </div> --}}


                    <div class="mb-3">
                        <label class="form-label">تحديد الاقسام</label>
                        
                        <div class="input-group">
                            
                           

                            <select class="form-control" id="my-select" name="categories[]" multiple>
                                @foreach ($categories as $category)
                                    
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <!-- input-group -->
                    </div>



                    {{-- <div class="mb-3" v-if="isPrice">
                        <label class="form-label"> السعر</label>
                        @error('service_price')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <input type="number" name="service_price" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div> --}}

                    

                    {{-- <div class="mb-3" v-if="isDiscount">
                        <label class="form-label">الخصم</label>
                        @error('discount')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <input type="number" name="discount" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div> --}}

                    
                </div>

                <div class="col-lg-6">
                   
                    <div class="mb-3">
                        <label class="form-label">تاريخ الانتهاء</label>
                        @error('expiry_date')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <input type="date" name="expiry_date" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>

                  

                    <div class="mb-3">
                        <label class="form-label">وصف العرض</label>
                        @error('description')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                           <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    
                </div>


            </div>
            <button class="btn btn-primary btn-lg" type="submit">حفظ</button>
        </form>
    </div>
</div>

@endsection


@section('scripts')


<script>
    new Vue({
        el:"#app",
        data:{
            isDiscount:false,
            isPrice:false
        },
       
        methods:{
            setOfferType(event){
              
                if(event.target.value == 'discount'){
                    this.isDiscount = true
                    this.isPrice = false
                    
                }else{
                    this.isPrice = true
                    this.isDiscount = false
                    
                }
            }
        }
    })
</script>

<script>
    $(".select-item").select2({
      tags: true
     });
</script>

<script>
    $(document).ready(function() {
      $('#my-select').select2();
    });
  </script>
@endsection