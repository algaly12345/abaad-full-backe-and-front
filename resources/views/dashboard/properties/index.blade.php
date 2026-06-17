@extends('layouts.admin')

@section('title','الخصائص')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title">أنشاء خاصية</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-6">
                   
                    <div class="mb-3">
                        <label class="form-label">أسم الخاصية</label>
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

                    

                    
                </div>


            </div>
            <button class="btn btn-primary btn-lg" type="submit">حفظ</button>
        </form>
    </div>
</div>


<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">الخصائص</h4>

            <div class="table-responsive">
                <table class="table mb-0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>أسم الخاصية</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($properties as $key => $property)
                       <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $property->name }}</td>
                        <td>
                            <a href="{{ route('properties.edit',$property->id) }}" class="btn btn-success">تعديل</a>
                            <a href="" class="btn btn-danger">حذف</a>
                        </td>
                    </tr>
                       @endforeach
                       
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


@endsection