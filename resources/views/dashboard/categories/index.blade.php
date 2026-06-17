@extends('layouts.admin')

@section('title','الاقسام')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title">{{ $title }}</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                            
                            <input type="text" name="name" class="form-control"/ >
                            
                        </div>
                        <!-- input-group -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الاقسام الرئيسية</label>
                        @error('parent_id')
                            
                        <span class="error-message">
                            {{ $message }}
                        </span>
                   @enderror
                        <div class="input-group">
                            
                            @php
                                if(request()->is('admin/categories/sub')){
                                    $parents =   App\Models\Category::all()->filter(function ($cate) {
                                    return $cate->parent_id == null;
                                });
                                }else{

                                    $parents = $categories->filter(function ($cate) {
                                        return $cate->parent_id == null;
                                    });
                                }

                
                            @endphp
                            
                            @if (request()->is('admin/categories/sub'))
                            <select name="parent_id" id="" class="form-control">
                                @foreach ($parents as $parent)

                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                            @endif
                            
                            
                        </div>
                        <!-- input-group -->
                    </div>

                  

                    
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




<div class="col-lg-12 ">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">الاقسام</h4>

            <div class="table-responsive"> 
                <table class="table mb-0 datatable mdl-data-table data-table mb-0">

                    <thead>
                        <tr>
                            <th>أسم التصنيف</th>
                            <th>التصنيف الرئيسي</th>
                            
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                       
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection



@section('scripts')

<script type="text/javascript">
    let pathname =  window.location.pathname;
        
        let url = "";
      
        if(pathname == "/admin/categories"){
           url =  "{{ route('categories.index') }}";
        }else if(pathname == "/admin/categories/sub"){
           url = "{{ route('categories.sub-categories') }}";
        }
    $(function () {
      
      var table = $('.data-table').DataTable({
          serverSide: true,
          ajax: url,
          columns: [
              {data: 'name', name: 'name'},
              {data: 'main_category', name: 'main_category'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>

@endsection