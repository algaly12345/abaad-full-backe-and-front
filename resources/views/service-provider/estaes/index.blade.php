@extends('layouts.admin')

@section('title','العقارات')
@section('content')
<form action="{{ route('service-provider.estaes.index') }}" class="my-5">
  <div class="row">
    <div class="col-4">
        <div class="form-group">
          <label for="">أختار المنطقة</label>
          <select name="zone_id" class="form-control" id="">
            @foreach ($zones as $zone)
              
            <option value="{{ $zone->id }}">{{ $zone->name }}</option>
            @endforeach
          </select>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
           <button class="btn btn-success" type="submit">بحث</button>
        </div>
    </div>
    
  </div>
</form>
<div class="card">
  <div class="row">
    
    @foreach ($estaes as $estae)
    
    <div class="col-lg-4">
      <div class="card">
        <img src="https://images.unsplash.com/photo-1449844908441-8829872d2607?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-text">{{ $estae->short_description }}</h5>
          <p class="card-title">العنوان الوطني : {{ $estae->national_address }}</p>
          <p class="card-title"> السعر : {{ $estae->price }}</p>
          <ul class="list-group list-group-flush">
          @foreach (json_decode($estae->property,true) as $pro)
          <li class="list-group-item">{{ $pro['number'] }} {{ $pro['name'] }} </li>
          @endforeach
          
            
          </ul>
          <a href="{{ route('service-provider.estaes.create-offer',$estae->id) }}" class="btn btn-primary mt-3">أضافة عرض</a>
        </div>
      </div>
      
    </div>
    @endforeach
  </div>
</div>
  
@endsection