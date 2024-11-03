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
            <table class="trip-routes-list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Legs') }}</th>
                        <th class="text-center">{{ __('Actions') }}</th>
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
        var addButton = '<br>';
    </script>

    @if (auth()->user()->can('add trip route'))
        <script>
            addButton = {
                text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">${addTripRouteTranslation}</span>`,
                className: 'add-new btn btn-primary mb-3 mt-2 mb-2 addTripRoute',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#addTripRouteModal'
                },
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                }
            }
        </script>
    @endif


    <!-- Modal -->
    @include('_partials/_modals/trips/modal-add-trip-route')
    @include('_partials/_modals/trips/modal-edit-trip-route')
    @include('_partials/_modals/trips/modal-show-trip-route')
    <!-- /Modal -->


@endsection
