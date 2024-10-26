@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp


@extends('layouts/layoutMaster')

@section('title', __('Orders'))

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/shipments/app-shipment-list.js') }}"></script>
@endsection

@section('content')
    <!-- Invoice List Widget -->

    <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
            <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                            <div>
                                <h3 class="mb-1">{{ $customersCount }}</h3>
                                <p class="mb-0">{{ __('Customers') }}</p>
                            </div>
                            <span class="avatar me-sm-4">
                                <span class="avatar-initial bg-label-primary rounded"><i
                                        class="ti ti-user ti-md"></i></span>
                            </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-4">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                            <div>
                                <h3 class="mb-1">{{ $shipmentsCount }}</h3>
                                <p class="mb-0">{{ __('Shipments') }}</p>
                            </div>
                            <span class="avatar me-lg-4">
                                <span class="avatar-initial bg-label-warning rounded"><i
                                        class="ti ti-package ti-md"></i></span>
                            </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                            <div>
                                <h3 class="mb-1">{{ $inProgressCount }}</h3>
                                <p class="mb-0">{{ __('In Progress') }}</p>
                            </div>
                            <span class="avatar me-sm-4">
                                <span class="avatar-initial bg-label-danger rounded"><i
                                        class="ti ti-truck ti-md"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="mb-1">{{ $deliveredCount }}</h3>
                                <p class="mb-0">{{ __('Delivered') }}</p>
                            </div>
                            <span class="avatar">
                                <span class="avatar-initial bg-label-success rounded"><i
                                        class="ti ti-checks ti-md"></i></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order List Table -->
    <div class="card">
        <div class="card-datatable table-responsive mt-3">
            <table class="shipment-list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ __('Tracking Number') }}</th>
                        <th>{{ __('Customer') }}</th>
                        <th>{{ __('Trip Route') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Payment') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>



    <script>
        var addShipmentTranslation = @json(__('Add Shipment'));
        var hideAddShipmentButton = false;
        var addButton = '<br>';
    </script>

    @if (Auth::check() && Auth::user()->hasRole('Customer'))
        <script>
            hideAddShipmentButton = true;
        </script>
    @endif

    @if (auth()->user()->can('add shipment'))
        <script>
            addButton = {
                text: `<i class="ti ti-plus ti-sm me-2"></i>${addShipmentTranslation}`,
                className: 'btn btn-primary mt-2 mb-2',
                action: function(e, dt, button, config) {
                    window.location = './shipments/create';
                }
            }
        </script>
    @endif



@endsection
