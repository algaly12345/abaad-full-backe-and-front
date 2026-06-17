@extends('layouts.admin')


@section('title','العروض')

@section('content')

<div class="card" id="app">
    <div class="card-body">

        <h4 class="card-title">تعديل العرض</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('service-provider.estaes.update-offer',$offer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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

                            <input value="{{ $offer->title }}" type="text" name="title" class="form-control"/ >

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
                                    <option {{ $offer->service_type_id == $serviceType->id ? 'selected' : '' }} value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">تحديد الاقسام</label>

                        <div class="input-group">



                            <select class="form-control" id="my-select" name="categories[]" multiple>
                                @foreach ($categories as $category)

                                <option  {{ in_array($category->id, $offer->categories->pluck('id')->all()) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name_ar }}</option>
                                @endforeach
                            </select>

                        </div>
                        <!-- input-group -->
                    </div>


                    <div class="mb-3">
                        <label class="form-label">تحديد المنطقه</label>

                        <div class="input-group">



                            <select class="form-control" id="my-select-zone" name="zones[]" multiple>
                                @foreach ($zones as $zone)


                                <option  {{ in_array($zone->id, $offer->zones->pluck('id')->all()) ? 'selected' : '' }} value="{{ $zone->id }}">{{ $zone->name_ar }}</option>
                                @endforeach
                            </select>

                        </div>
                        <!-- input-group -->
                    </div>


                    <div class="mb-3">
                        <label class="form-label">تحديد نوع العرض</label>

                        <div class="input-group">



                            <select class="form-control" name="offer_type" id="" @change="setOfferType($event)">
                                <option value="#"></option>
                                <option {{ $offer->offer_type == 'discount' ? 'selected' :' ' }} value="discount">
                                    خصم
                                </option>
                                <option {{ $offer->offer_type == 'price' ? 'selected' :'' }} value="price">
                                     سعر
                                </option>
                            </select>

                        </div>
                        <!-- input-group -->
                    </div>



                    <div class="mb-3" v-if="isPrice">
                        <label class="form-label"> السعر</label>
                        @error('service_price')

                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">

                            <input value="{{ $offer->service_price }}" type="number" name="service_price" class="form-control"/ >

                        </div>
                        <!-- input-group -->
                    </div>



                    <div class="mb-3" v-if="isDiscount">
                        <label class="form-label">الخصم</label>
                        @error('discount')

                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">

                            <input value="{{ $offer->discount }}" type="number" name="discount" class="form-control"/ >

                        </div>
                        <!-- input-group -->
                    </div>


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

                            <input value="{{ $offer->expiry_date }}" type="date" name="expiry_date" class="form-control"/ >

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

                           <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ $offer->description }}</textarea>

                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ارفاق صورة للعرض</label>
                        @error('image')

                        <span class="error-message">
                            {{ $message }}
                        </span>
                        @enderror
                        <div class="input-group">
                            <input type="file" class="form-control" name="image">
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

        created(){

              if(@json($offer->offer_type) == 'discount'){
                this.isDiscount = true
              }else{
                this.isPrice = true
              }
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
<script>
    $(document).ready(function() {
      $('#my-select-zone').select2();
    });
  </script>
@endsection
