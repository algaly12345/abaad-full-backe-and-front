@extends('layouts.front-end.app')

@section('title', translate('privacy_policy'))

@section('content')
    <div class="container py-5 rtl text-align-direction">
        <h2 class="text-center mb-3 headerTitle">{{translate('privacy_policy')}}</h2>
        <div class="card __card">
            @if(app()->getLocale() == 'ar')
            {{$web_config['privacy_policy_web_ar']->value}}
        @else
            {{$web_config['privacy_policy_web']->value}}
        @endif
    </div>
        </div>
    </div>
@endsection
