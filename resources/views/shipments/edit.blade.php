@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp


@extends('layouts/layoutMaster')

@section('title', __('Edit Shipment'))

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
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/shipments/app-shipment-items.js') }}"></script>
    <script src="{{ asset('assets/js/extends/offcanvas-add-payment.js') }}"></script>
    <script src="{{ asset('assets/js/extends/offcanvas-send-invoice.js') }}"></script>
    <script src="{{ asset('assets/js/shipments/app-shipment-edit.js') }}"></script>
    <script src="{{ asset('assets/js/extends/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/extends/form-layouts.js') }}"></script>
@endsection

@section('content')
    <div class="row invoice-edit">
        <!-- Invoice Edit-->
        <div class="col-lg-10 col-12 mb-lg-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <form class="source-item pt-4 px-0 px-sm-4" id="editShipmentForm">
                        <div class="row p-0 p-sm-4">
                            <!-- First Column -->
                            <div class="col-md-12 mb-md-0 mb-3">
                                <div class="mb-3 col-md-12">
                                    <label for="customer_id" class="form-label me-4 fw-medium">{{ __('Customer') }}</label>
                                    <select id="customer_id" class="select2 form-select form-select-lg"
                                        data-allow-clear="true" name="customer_id">
                                        <option disabled selected>{{ __('Select') }}</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                @if ($customer->id == $shipment->customer_id) selected @endif>
                                                @if ($customer->customer_code)
                                                    {{ $customer->customer_code }}
                                                    -
                                                @endif
                                                {{ $customer->first_name }} {{ $customer->last_name }}
                                                @if ($customer->email)
                                                    - {{ $customer->email }}
                                                @endif
                                                @if ($customer->phone)
                                                    - {{ $customer->phone }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="html5-datetime-local-input"
                                            class="form-label me-4 fw-medium">{{ __('Date') }}</label>
                                        <input class="form-control date-picker" id="datePicker" type="datetime-local"
                                            value="{{ $shipment->orderDate }}" placeholder="{{ __('Enter date') }}"
                                            name="date" />
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="salesperson"
                                            class="form-label me-4 fw-medium">{{ __('Amount') }}</label>
                                        <input type="text" class="form-control" id="salesperson"
                                            placeholder="{{ __('Enter amount') }}" name="amount"
                                            value="{{ $shipment->amount }}" />
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="currency_id" class="form-label me-4 fw-medium">{{ __('Currency') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select id="currency_id" class="select2 form-select form-select-lg"
                                            data-allow-clear="true" name="currency_id">
                                            <option disabled selected>{{ __('Select') }}</option>
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->id }}"
                                                    @if ($currency->id == $shipment->currency_id) selected @endif>
                                                    {{ $currency->name }} ( {{ $currency->symbol }} )
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <!-- Second Column -->
                            <div class="col-md-6 mb-md-0 mb-3">
                            </div>
                        </div>
                        <div class="row px-0 px-sm-4">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="note" class="form-label fw-medium">{{ __('Notes') }}</label>
                                    <textarea class="form-control" rows="2" id="notes" placeholder="" value="{{ $shipment->notes }}"
                                        name="notes">{{ $shipment->notes }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row p-0 p-sm-4">
                            <div class="col-md-6 mb-md-0 mb-3">
                            </div>
                        </div>
                    </form>
                    <hr class="my-3 mx-n4" />

                    <div class="table-responsive">
                        <table class="shipment-items-table table mt-3">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ __('Parcel Type') }}</th>
                                    <th>{{ __('Good Type') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th class="text-truncate">{{ __('Height') }}</th>
                                    <th>{{ __('Width') }}</th>
                                    <th>{{ __('Weight') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Invoice Edit-->

        <!-- Invoice Actions -->
        <div class="col-lg-2 col-12 invoice-actions">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex my-2">
                        <button type="button"
                            class="btn btn-label-danger w-100 cancelButton me-2">{{ __('Cancel') }}</button>
                        <button type="button"
                            class="btn btn-label-primary w-100 submitButton">{{ __('Submit') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Invoice Actions -->
    </div>


    <script>
        var errorTranslation = @json(__('The given data was invalid'));
        var requiredFieldsTranslation = @json(__('Please fill in all required fields'));
        var shipmentId = '{{ $shipment->id }}';
        var urlStart = '../../';
        var addItemTranslation = @json(__('Add Item'));
        var exportTranslation = @json(__('Export'));
        var searchTranslation = @json(__('Search'));
        var showTranslation = @json(__('Show'));
        var showingTranslation = @json(__('Showing'));
        var toTranslation = @json(__('to'));
        var ofTranslation = @json(__('of'));
        var nextTranslation = @json(__('Next'));
        var previousTranslation = @json(__('Previous'));
        var noEntriesAvailableTranslation = @json(__('No entries available'));
        var entriesTranslation = @json(__('entries'));

        var submitTranslation = @json(__('Submit'));
        var cancelTranslation = @json(__('Cancel'));
        var doneTranslation = @json(__('Done'));

        var areYouSureTranslation = @json(__('Are you sure?'));
        var areYouSureTextTranslation = @json(__('You will not be able to revert this!'));
    </script>

    <!-- Offcanvas -->
    @include('_partials/_offcanvas/offcanvas-send-invoice')
    @include('_partials/_offcanvas/offcanvas-add-payment')
    @include('_partials/_modals/shipments/modal-add-shipment-item')
    @include('_partials/_modals/shipments/modal-edit-shipment-item')
    <!-- /Offcanvas -->
@endsection
