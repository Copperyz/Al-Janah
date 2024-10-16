@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp


@extends('layouts/layoutMaster')

@section('title', __('Payments'))

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
<script src="{{asset('assets/js/extends/forms-extras.js')}}"></script>
<script src="{{asset('assets/js/extends/forms-selects.js')}}"></script>
<script src="{{asset('assets/js/payments/payments-list.js')}}"></script>
@endsection

@section('content')
<!-- Invoice List Widget -->

<div class="card mb-3">
        <div class="card-header">
            <h4 class="card-title">{{__('Payments')}}</h4>
            <div class="d-flex justify-content-between align-items-center row gap-3 gap-md-0">
                <p>
                    {{__('Payments can be managed and assigned specific settings or methods, ensuring that administrators have control over the payment options and processing rules available for each transaction.')}}
                </p>
            </div>
        </div>
</div>

<!-- Trip List Table -->
<div class="card">
    <div class="card-datatable table-responsive mt-3 ">
        <table class="payments-list-table table">
            <thead>
                <tr>
                    <th></th>
                    <th>{{__('Shipment')}}</th>
                    <th>{{__('Freight cost')}}</th>
                    <th>{{__('Trip fare')}}</th>
                    <th>{{__('Payment Method')}}</th>
                    <th>{{__('Date')}}</th>
                    <th>{{__('Status')}}</th>
                    <th class="cell-fit">{{__('Actions')}}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<script>
var addPaymentTranslation = @json(__('Add Payment'));

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

<!-- /Modal -->


@endsection