@extends('layouts.admin')

@section('title','التصنيفات')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title">تعديل البيانات</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-lg-6">
                   
                    <div class="mb-3">
                        <label class="form-label">أسم القسم</label>
                        @error('name')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <input value="{{ $category->name }}" type="text" name="name" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>



                    @if (!is_null($category->parent_id))
                    <div class="mb-3">
                        <label class="form-label">الاقسام الرئيسية</label>
                        @error('parent_id')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <select name="parent_id" id="" class="form-control">
                                <option value=""></option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ $parent->id == $category->parent_id ? 'selected' : '' }}>{{ $parent->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <!-- input-group -->
                    </div>
                    @endif
                   

                    

                    
                </div>


                <div class="col-lg-6">

                   
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