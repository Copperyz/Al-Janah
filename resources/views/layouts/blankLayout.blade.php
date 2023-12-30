@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();

/* Display elements */
$customizerHidden = ($customizerHidden ?? '');

@endphp



@section('layoutContent')
@extends('layouts/commonMaster' )

<!-- Content -->
@yield('content')
<!--/ Content -->


@endsection