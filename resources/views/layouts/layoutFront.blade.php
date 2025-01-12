@php
$configData = Helper::appClasses();
$isFront = true;
@endphp

@section('layoutContent')

@extends('layouts/commonMaster' )
@if(config('features.header'))
    @include('layouts/sections/navbar/navbar-front')
@endif
<!-- Sections:Start -->
@yield('content')
<!-- / Sections:End -->
@if(config('features.footer'))
    @include('layouts/sections/footer/footer-front')
@endif
@endsection
