@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp


@extends('layouts/layoutMaster')

@section('title', __('Show Shipment'))

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-invoice.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection


@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/shipments/app-shipment-items.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/offcanvas-add-payment.js') }}"></script> -->
    <script src="{{ asset('assets/js/offcanvas-send-invoice.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/shipments/add-payments.js') }}"></script>
@endsection

@section('content')

    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <div
                        class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                        <div>
                            <h4 class="fw-medium mb-2">{{ __('Shipment') }} #{{ $shipment->id }}</h4>
                            <div class="mb-2 pt-1">
                                <span>{{ __('Date') }} :</span>
                                <span class="fw-medium">{{ $shipment->date }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row p-sm-3 p-0">
                        <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                            <h6 class="mb-3">{{ __('Order Details') }}</h6>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pe-4">{{ __('Name') }}:</td>
                                        <td class="fw-medium">{{ $shipment->customer->first_name }}
                                            {{ $shipment->customer->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-4">{{ __('Phone') }}:</td>
                                        <td>{{ $shipment->customer->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-4">{{ __('Email') }}:</td>
                                        <td>{{ $shipment->customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-4">{{ __('Country') }}:</td>
                                        <td>{{ $shipment->customer->country->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-4">{{ __('City') }}:</td>
                                        <td>{{ $shipment->customer->city->name ?? '' }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                            <h6 class="mb-4">{{ __('Bill') }}:</h6>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pe-4">{{ __('Shipment Price') }}:</td>
                                        <td class="fw-medium">
                                            {{ number_format($shipment->shipmentPrice, 2) }}
                                            {{ __('LYD') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pe-4">{{ __('Packages cost') }}:</td>
                                        <td class="fw-medium">
                                            {{ number_format($shipment->amount, 2) }}
                                            {{ __('LYD') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pe-4">{{ __('Total') }}:</td>
                                        <td class="fw-medium">
                                            {{ number_format($shipment->amount + $shipment->shipmentPrice, 2) }}
                                            {{ __('LYD') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="table-responsive border-top">
                    <table class="shipment-items-table table m-0">
                        <thead>
                            <tr>
                                <th></th>
                                <th>{{ __('Good Type') }}</th>
                                <th>{{ __('Parcel Type') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th class="text-truncate">{{ __('Height') }}</th>
                                <th>{{ __('Width') }}</th>
                                <th>{{ __('Weight') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th class="cell-fit">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <!-- <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-medium">Note:</span>
                                <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!</span>
                            </div>
                        </div>
                    </div> -->
            </div>
        </div>
        <!-- /Invoice -->

        <!-- Invoice Actions -->
        <div class="col-xl-3 col-md-4 col-12 invoice-actions">
            <div class="card">
                <div class="card-body">
                    <!-- <button class="btn btn-primary d-grid w-100 mb-2" data-bs-toggle="offcanvas"
                            data-bs-target="#sendInvoiceOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="ti ti-send ti-xs me-2"></i>{{ __('Send Order') }}</span>
                        </button> -->
                    <!-- <button class="btn btn-label-secondary d-grid w-100 mb-2">
                            {{ __('Download') }}
                        </button> -->
                    <a class="btn btn-label-secondary d-flex align-items-center w-100 mb-2" target="_blank"
                        href="{{ url('payments/' . $shipment->id . '/print') }}">
                        <i class="ti ti-printer ti-xs me-2"></i>
                        {{ __('Print') }}
                    </a>
                    <a href="{{ route('shipments.edit', ['shipment' => $shipment->id]) }}"
                        class="btn btn-label-warning d-flex align-items-center w-100 mb-2">
                        <i class="ti ti-pencil ti-xs me-2"></i>
                        {{ __('Edit Order') }}
                    </a>
                    @if (!isset($payment))
                        <button class="btn btn-label-success d-grid w-100" data-bs-toggle="modal"
                            data-bs-target="#addPaymentModal">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="ti ti-currency-dollar ti-xs me-2"></i>{{ __('Add Payment') }}</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <!-- /Invoice Actions -->
    </div>

    <script>
        var shipmentId = '{{ $shipment->id }}';
        var urlStart = '../';
        var addItemTranslation = @json(__('Add Item'));
    </script>

    <!-- Offcanvas -->
    @include('_partials/_offcanvas/offcanvas-send-invoice')
    @include('_partials/_modals/shipments/modal-add-shipment-item')
    @include('_partials/_modals/shipments/modal-edit-shipment-item')
    @include('_partials/_modals/shipments/modal-add-payment')
    <!-- /Offcanvas -->
@endsection
