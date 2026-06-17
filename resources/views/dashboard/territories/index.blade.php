@extends('layouts.admin')

@section('title','الأقاليم')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title">أنشاء أقليم</h4>
        {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}


        <form action="{{ route('territories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-6">
                   
                    <div class="mb-3">
                        <label class="form-label">أسم الاقليم</label>
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
            <h4 class="card-title">الأقاليم</h4>

            <div class="table-responsive">
                <table class="table mb-0 datatable mdl-data-table data-table mb-0">

                    <thead>
                        <tr>
                            <th>أسم اﻷقليم</th>
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
    $(function () {
      
      var table = $('.data-table').DataTable({
          serverSide: true,
          ajax: "{{ route('territories.index') }}",
          columns: [
              {data: 'name', name: 'name'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>

@endsection