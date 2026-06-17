@extends('layouts.admin')

@section('title','العقارات')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title">أنشاء عقار</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-4">
                   
                    <div class="mb-3">
                        <label class="form-label">أسم التصنيف</label>
                        @error('name')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <input type="text" name="name" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الموقع</label>
                        @error('position')
                            
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                           @enderror
                        <div class="input-group">
                            
                            <input type="text" name="position" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    
                </div>

                
                <div class="col-lg-4">
                    <div class="mt-4 mt-lg-0 mb-3">
                        <label class="form-label">الصورة</label>
                        @error('image')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="position-relative">
                           
                            <input type="file" name="image" class="form-control" >
                        </div>
                    </div>
                </div>

            </div>
            <button class="btn btn-primary btn-lg" type="submit">حفظ</button>
        </form>
    </div>
</div>



@endsection