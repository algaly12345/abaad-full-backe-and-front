@extends('layouts.admin')


@section('title','المدراء')

@section('content')
<div class="card">
    <div class="card-body">

        <h4 class="card-title">أنشاء دور</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-4">
                   
                    <div class="mb-3">
                        <label class="form-label">أسم المدير</label>
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
                        <label class="form-label">البريد الالكتروني</label>
                        @error('email')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                        @enderror
                        <div class="input-group">
                            
                            <input type="email" name="email" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>


                    <div class="mb-3">
                        <label class="form-label">رقم الهاتف</label>
                        @error('phone')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                        @enderror
                        <div class="input-group">
                            
                            <input type="tel" name="phone" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">كلمة المرور</label>
                        @error('password')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                        @enderror
                        <div class="input-group">
                            
                            <input type="password" name="password" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    

                    
                </div>

                <div class="col-lg-8">
                   
                    <div class="mb-3">
                        <label class="form-label">الادوار</label>
                         <div class="row">
                            
                            @foreach ($roles  as $role)
                            <div class="col-4 d-flex justify-between">
                                <span class="m-auto">
                                    {{ $role->name }}
                                </span>
                                <div>
                                    <input name="selectedRoles[]" value="{{ $role->id }}" type="checkbox" id="switch{{ $role->id }}" switch="none" />
                                    <label class="form-label" for="switch{{ $role->id }}" data-on-label="نعم" data-off-label="لا"></label>
                                </div>
                            </div>
                            @endforeach
                            
                            
                            
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