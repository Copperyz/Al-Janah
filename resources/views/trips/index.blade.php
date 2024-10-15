@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp


@extends('layouts/layoutMaster')

@section('title', __('Trips List'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-select-bs5/select.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/extends/forms-selects.js')}}"></script>
<script src="{{asset('assets/js/trips/app-trips-list.js')}}"></script>
<script src="{{asset('assets/js/extends/form-layouts.js')}}"></script>
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
                            <h3 class="mb-1">{{$customersCount}}</h3>
                            <p class="mb-0">{{__('Customers')}}</p>
                        </div>
                        <span class="avatar me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i
                                    class="ti ti-user ti-md"></i></span>
                        </span>
                    </div>
                    <hr class="d-none d-sm-block d-lg-none me-4">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                        <div>
                            <h3 class="mb-1">{{$tripsCount}}</h3>
                            <p class="mb-0">{{__('Trips')}}</p>
                        </div>
                        <span class="avatar me-lg-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i
                                    class="ti ti-file-invoice ti-md"></i></span>
                        </span>
                    </div>
                    <hr class="d-none d-sm-block d-lg-none">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                        <div>
                            <h3 class="mb-1">{{$deliveredCount}}</h3>
                            <p class="mb-0">{{__('Delivered')}}</p>
                        </div>
                        <span class="avatar me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i
                                    class="ti ti-checks ti-md"></i></span>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h3 class="mb-1">{{$inProgressCount}}</h3>
                            <p class="mb-0">{{__('In Progress')}}</p>
                        </div>
                        <span class="avatar">
                            <span class="avatar-initial bg-label-secondary rounded"><i
                                    class="ti ti-circle-off ti-md"></i></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shipment List Table -->
<div class="card">
    <div class="card-datatable table-responsive text-center">
        <table class="trips-list-table table border-top">
            <thead>
                <tr>
                    <th class="text-center">{{__('Tracking NO')}}</th>
                    <th class="text-center">{{__('Shipments')}}</th>
                    <th class="text-center">{{__('Status')}}</th>
                    <th class="text-center">{{__('Departure Date')}}</th>
                    <th class="text-center">{{__('Estimated Delivery Date')}}</th>
                    <th class="text-center">{{__('Actions')}}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<script>
var addTripTranslation = @json(__('Add Trip'));
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
var rowSelectedTranslation = @json(__('  You have selected  '));
var rows = @json(__('rows'));
var clickRow = @json(__('  Click a row to select it  '));
var onlyRow = @json(__('  Only 1 row selected  '));

var submitTranslation = @json(__('Submit'));
var cancelTranslation = @json(__('Cancel'));
var doneTranslation = @json(__('Done'));

var areYouSureTranslation = @json(__('Are you sure?'));
var areYouSureTextTranslation = @json(__('You will not be able to revert this!'));
</script>

@include('_partials/_modals/trips/modal-add-trip')
@include('_partials/_modals/trips/modal-edit-trip')
@include('_partials/_modals/trips/modal-add-tripshipment')


@endsection