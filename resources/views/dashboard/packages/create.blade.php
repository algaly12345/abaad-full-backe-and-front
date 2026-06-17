@extends('layouts.admin')


@section('title','الباقات')

@section('content')


<div class="card">
    <div class="card-body">

        <h4 class="card-title">أنشاء باقة أشتراك</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-6">
                   
                    <div class="mb-3">
                        <label class="form-label">أسم باقة الاشتراك </label>
                        @error('package_name')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <input type="text" name="package_name" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">سعر الباقة</label>
                        @error('price')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                         @enderror
                    <div class="input-group">
                            
                            <input type="number" name="price" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>
                   

                    <div class="mb-3">
                        <label class="form-label">مقدم خدمة او عقار </label>
                        @error('tergat')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                         @enderror
                    <div class="input-group">
                            
                            <select name="tergat" class="form-control" id="">
                                <option value="مقدم خدمة">مقدم خدمة</option>
                                <option value="عقار">عقار</option>
                            </select>
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    

                  
                </div>

                <div class="col-lg-6">
                   
                    <div class="mb-3">
                        <label class="form-label">صلاحية الباقة</label>
                        @error('validity')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <input type="number" name="validity" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">لون الباقة</label>
                        @error('color')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <select name="color" class="form-control" id="">
                                <option value="#FFD93D">ذهبي</option>
                                <option value="#FFF3E2">فضي</option>
                                <option value="#E5E4E2">بلاتيني</option>
                            </select>
                            
                        </div>
                        <!-- input-group -->
                    </div>


                      <div class="mb-3">
                        <label class="form-label">وصف الباقة</label>
                        @error('text')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            <input type="text" name="text" class="form-control"/ >
                            
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