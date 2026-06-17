@extends('layouts.admin')


@section('title','الادوار')


@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title">أنشاء دور</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('roles.update',$role->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-lg-4">
                   
                    <div class="mb-3">
                        <label class="form-label">أسم الدور</label>
                        @error('name')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <input value="{{ $role->name }}" type="text" name="name" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    

                    
                </div>

                <div class="col-lg-8">
                   
                    <div class="mb-3">
                        <label class="form-label">الصلاحيات</label>
                         <div class="row">
                            
                            @foreach ($permissions  as $permission)
                            <div class="col-4 d-flex justify-between">
                                <span class="m-auto">
                                    {{ $permission->name }}
                                </span>
                                <div>
                                    <input {{ in_array($permission->id,$role->permissions->pluck('id')->toArray()) ? 'checked' : '' }} name="selectedPermissions[]" value="{{ $permission->id }}" type="checkbox" id="switch{{ $permission->id }}" switch="none" />
                                    <label class="form-label" for="switch{{ $permission->id }}" data-on-label="نعم" data-off-label="لا"></label>
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