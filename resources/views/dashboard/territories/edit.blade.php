@extends('layouts.admin')

@section('title','اﻷقاليم')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title">تعديل البيانات</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('territories.update',$territory->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-lg-6">
                   
                    <div class="mb-3">
                        <label class="form-label">أسم اﻷقليم</label>
                        @error('name')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <input type="text" value="{{ $territory->name }}" name="name" class="form-control"/ >
                            
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