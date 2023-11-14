@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp


@extends('layouts/layoutMaster')

@section('title', __('Shipments List'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />

@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{asset('assets/vendor/libs/autosize/autosize.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

@endsection

@section('page-script')
<script src="{{asset('assets/js/app-shipment-route-list.js')}}"></script>
<script src="{{asset('assets/js/forms-extras.js')}}"></script>
<script src="{{asset('assets/js/forms-selects.js')}}"></script>
@endsection

@section('content')
<!-- Invoice List Widget -->



<!-- Shipment List Table -->
<div class="card">
    <div class="card-datatable table-responsive">
        <table class="shipment-routes-list-table table border-top">
            <thead>
                <tr>
                    <th></th>
                    <th>{{__('Type')}}</th>
                    <th>{{__('Legs')}}</th>
                    <th>{{__('Shipment Price')}}</th>
                    <th class="cell-fit">{{__('Actions')}}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<script>
var addShipmentRouteTranslation = @json(__('Add Shipment Route'));
var shipmentPriceTranslation = @json(__('Shipment Price'));
var shipmentDetailsTranslation = @json(__('Shipment Details'));
var typeTranslation = @json(__('Type'));
var selectTranslation = @json(__('Select'));
var startTranslation = @json(__('Start'));
var transitTranslation = @json(__('Transit'));
var endTranslation = @json(__('End'));
var countryTranslation = @json(__('Country'));





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


<!-- Modal -->
@include('_partials/_modals/modal-add-shipment-route')
@include('_partials/_modals/modal-edit-shipment-route')
@include('_partials/_modals/modal-show-shipment-route')
<!-- /Modal -->


@endsection