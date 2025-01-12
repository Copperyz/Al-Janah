@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Reports'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/countries/add-country.js') }}"></script>
    <script src="{{ asset('assets/js/extends/forms-selects.js') }}"></script>
    <script src="{{asset('assets/js/extends/form-wizard-numbered.js')}}"></script>
    <script src="{{asset('assets/js/extends/form-wizard-validation.js')}}"></script>
@endsection

@section('content')

    <!-- <div class="card mb-3">
        <div class="card-header">
            <h4 class="card-title">{{ __('Countries') }}</h4>
            <div class="d-flex justify-content-between align-items-center row gap-3 gap-md-0">
                <p>
                    {{ __('Countries can be managed and assigned specific settings or regions, ensuring that administrators have control over the options and features available for each country.') }}
                </p>
            </div>
        </div>
    </div> -->

    @if (auth()->user()->can('add country'))
    <div class="col-12 col-sm-6 col-lg-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="mb-3 ti ti-file-text ti-lg"></i>
                <h5>Creat New Report</h5>
                <p>Enhance your application security by enabling two factor authentication.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#twoFactorAuth"> New Report </button>
            </div>
        </div>
    </div>
    @endif

    <div class="row mt-3">
        @foreach ($reports as $report)
        <div class="col-12 col-sm-6 col-lg-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="mb-3 ti ti-file-text ti-lg"></i>
                <h5>{{$report->name}}</h5>
                <p>Enhance your application security by enabling two factor authentication.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#twoFactorAuth"> New Report </button>
            </div>
        </div>
    </div>
        @endforeach
    </div>

@include('_partials/_modals/reports/add-report')

@endsection
