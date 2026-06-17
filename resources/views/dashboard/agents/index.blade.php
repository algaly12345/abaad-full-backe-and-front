@extends('layouts.admin')

@section('title','المسوقين')

@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            


            <div class="d-flex justify-content-between">
                <h4 class="card-title">{{ $title }}</h4>
                  
                 <a href="{{ route('agents.create') }}" class="btn btn-primary card-title">أنشاء</a>
            </div>
              

            <div class="table-responsive">

                 
                
                <table class="table mb-0 datatable mdl-data-table data-table mb-0">

                    <thead>
                        <tr>
                           
                            <th>أسم المسوق</th>
                            <th>رقم الجوال</th>
                            <th>المنطقة</th>
                            <th>رقم السجل التجاري</th>
                            <th>رقم الهوية</th>
                            <th>البريد الالكتروني</th>
                            <th>الحالة</th>
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
       
        //  if(pathname == "/admin/agents"){
        //     url =  "{{ route('agents.index') }}";
        //  }else if(pathname == "/admin/agents/real-estate-offices"){
        //     url = "{{ route('agents.real-estate-offices') }}";
        //  }else if(pathname == "/admin/agents/real-estate-companies"){
        //     url = "{{ route('agents.real-estate-companies') }}";
        //  }else if(pathname == "/admin/agents/individuals"){
        //     url = "{{ route('agents.individuals') }}";
        //  }

       switch(pathname) {
          case "/admin/agents": 
          url = "{{ route('agents.index') }}";
          break;
          case "/admin/agents/real-estate-offices": 
          url =  "{{ route('agents.real-estate-offices') }}";
          break;

          case "/admin/agents/real-estate-companies": 
          url = "{{ route('agents.real-estate-companies') }}";
          break;
          case "/admin/agents/individuals": 
          url = "{{ route('agents.individuals') }}";
          break;
       }

    //  
          
    $(function () {
      
      var table = $('.data-table').DataTable({
          serverSide: true,
          ajax: url,
          columns: [
              {data: 'name', name: 'name'},
              {data: 'phone', name: 'phone'},
              {data: 'zone', name: 'zone'},
              {data: 'commercial_registerion_no', name: 'commercial_registerion_no'},
              {data: 'ideintity', name: 'ideintity'},
              {data: 'email', name: 'email'},
              {data: 'status', name: 'status'},
            
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>

@endsection
