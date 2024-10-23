@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp


@extends('layouts/layoutMaster')

@section('title', __('Trip Routes'))

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/trips/app-trip-route-list.js') }}"></script>
    <script src="{{ asset('assets/js/extends/forms-extras.js') }}"></script>
    <script src="{{ asset('assets/js/extends/forms-selects.js') }}"></script>
@endsection

@section('content')

    <div class="card mb-3">
        <div class="card-header">
            <h4 class="card-title">{{ __('Trip Routes') }}</h4>
            <div class="d-flex justify-content-between align-items-center row gap-3 gap-md-0">
                <p>
                    {{ __('Trip routes can be managed and assigned specific settings or destinations, ensuring that administrators have control over the paths and destinations available for each route.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Trip List Table -->
    <div class="card">
        <div class="card-datatable table-responsive mt-3">
            <table class="trip-routes-list-table table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Legs') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <script>
        var addTripRouteTranslation = @json(__('Add Trip Route'));
        var tripPriceTranslation = @json(__('Trip Price'));
        var tripDetailsTranslation = @json(__('Trip Details'));
        var typeTranslation = @json(__('Type'));
        var selectTranslation = @json(__('Select'));
    </script>


    <!-- Modal -->
    @include('_partials/_modals/trips/modal-add-trip-route')
    @include('_partials/_modals/trips/modal-edit-trip-route')
    @include('_partials/_modals/trips/modal-show-trip-route')
    <!-- /Modal -->


@endsection
