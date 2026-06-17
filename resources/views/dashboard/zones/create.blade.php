@extends('layouts.admin')


@section('title','مزودين الخدمات')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- CSS -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<style>
    #map {
        height: 350px;
    }

    @media only screen and (max-width: 768px) {

        /* For mobile phones: */
        #map {
            height: 200px;
        }
    }

</style>


@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    <div class="card">
        <div class="card-body">

            <h4 class="card-title">أنشاء مزود خدمة</h4>
            {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}



            <form action="{{ route('zones.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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

                                <select name="territory_id" id="" class="form-control">
                                    @foreach ($territories as $territory)

                                        <option value="{{ $territory->id }}">{{ $territory->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <!-- input-group -->
                        </div>

                        <div class="mb-3">
                            <label class="form-label">أسم المنطقه</label>
                            @error('name')

                            <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="input-group">

                                <input type="text" name="name" class="form-control" >

                            </div>
                            <!-- input-group -->
                        </div>


                    </div>
                    <div class="col-lg-6">
                        <div>

                            <div class="form-group mb-3 initial-hidden">
                                <label class="input-label"
                                       for="exampleFormControlInput1"><span class="input-label-secondary" title="draw_your_zone_on_the_map">أرسم المنطقه</span></label>
                                <textarea type="text" rows="8" name="coordinates"  id="coordinates" class="form-control" readonly></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="map-warper overflow-hidden rounded">
                                <input id="pac-input" class="controls rounded initial-8" title="search_your_location_here" type="text" placeholder="search_here"/>
                                <div id="map-canvas" class="h-100 m-0 p-0"></div>
                            </div>

                        </div>

                    </div>



                </div>
                <button class="btn btn-primary btn-lg" type="submit">حفظ</button>
            </form>
        </div>
    </div>

@endsection


@include('partials.__map')
