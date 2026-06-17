@extends('layouts.admin')

@section('title','المحافظات')
@section('content')
<div class="card" style="padding: 30px">
    <div class="card-body">

        <h4 class="card-title">تعديل البيانات</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('provinces.update',$province->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-lg-6">
                   
                    <div class="mb-3">
                        <label class="form-label">أسم المنطقة</label>
                        @error('zone_id')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <select name="zone_id" id="" class="form-control">
                                @foreach ($zones as $zone)
                                    
                                <option {{ $province->zone_id == $zone->id ? 'selected' : '' }} value="{{ $zone->id }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">أسم المحافظة</label>
                        @error('name')
                            
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                           @enderror
                        <div class="input-group">
                            
                            <input type="text" value="{{ $province->name }}" name="name" class="form-control"/ >
                            
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