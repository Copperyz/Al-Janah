@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp


@extends('layouts/layoutMaster')

@section('title', __('Show Order'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-invoice.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
@endsection


@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/app-order-items.js')}}"></script>
<script src="{{asset('assets/js/offcanvas-add-payment.js')}}"></script>
<script src="{{asset('assets/js/offcanvas-send-invoice.js')}}"></script>
@endsection

@section('content')

<div class="row invoice-preview">
    <!-- Invoice -->
    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
        <div class="card invoice-preview-card">
            <div class="card-body">
                <div
                    class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                    <div class="mb-xl-0 mb-4">
                        <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                            @include('_partials.macros',["height"=>20,"withbg"=>''])
                            <span class="app-brand-text fw-bold fs-4">
                                {{ config('variables.templateName') }}
                            </span>
                        </div>
                        <p class="mb-2">Office 149, 450 South Brand Brooklyn</p>
                        <p class="mb-2">San Diego County, CA 91905, USA</p>
                        <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                    </div>
                    <div>
                        <h4 class="fw-medium mb-2">{{__('Order')}} #{{$order->id}}</h4>
                        <div class="mb-2 pt-1">
                            <span>{{__('Date')}} :</span>
                            <span class="fw-medium">{{$order->date}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <div class="row p-sm-3 p-0">
                    <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                        <h6 class="mb-3">Invoice To:</h6>
                        <p class="mb-1">Thomas shelby</p>
                        <p class="mb-1">Shelby Company Limited</p>
                        <p class="mb-1">Small Heath, B10 0HF, UK</p>
                        <p class="mb-1">718-986-6062</p>
                        <p class="mb-0">peakyFBlinders@gmail.com</p>
                    </div>
                    <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                        <h6 class="mb-4">Bill To:</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="pe-4">Total Due:</td>
                                    <td class="fw-medium">$12,110.55</td>
                                </tr>
                                <tr>
                                    <td class="pe-4">Bank name:</td>
                                    <td>American Bank</td>
                                </tr>
                                <tr>
                                    <td class="pe-4">Country:</td>
                                    <td>United States</td>
                                </tr>
                                <tr>
                                    <td class="pe-4">IBAN:</td>
                                    <td>ETD95476213874685</td>
                                </tr>
                                <tr>
                                    <td class="pe-4">SWIFT code:</td>
                                    <td>BR91905</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="table-responsive border-top">
                <table class="order-items-table table m-0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th class="text-truncate">{{__('Height')}}</th>
                            <th>{{__('Width')}}</th>
                            <th class="cell-fit">{{__('Actions')}}</th>
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
                <button class="btn btn-primary d-grid w-100 mb-2" data-bs-toggle="offcanvas"
                    data-bs-target="#sendInvoiceOffcanvas">
                    <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                            class="ti ti-send ti-xs me-2"></i>{{__('Send Order')}}</span>
                </button>
                <button class="btn btn-label-secondary d-grid w-100 mb-2">
                    {{__('Download')}}
                </button>
                <a class="btn btn-label-secondary d-grid w-100 mb-2" target="_blank"
                    href="{{url('app/invoice/print')}}">
                    {{__('Print')}}
                </a>
                <a href="{{ route('orders.edit', ['order' => $order->id]) }}"
                    class="btn btn-label-secondary d-grid w-100 mb-2">
                    {{__('Edit Order')}}
                </a>
                <button class="btn btn-primary d-grid w-100" data-bs-toggle="offcanvas"
                    data-bs-target="#addPaymentOffcanvas">
                    <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                            class="ti ti-currency-dollar ti-xs me-2"></i>{{__('Add Payment')}}</span>
                </button>
            </div>
        </div>
    </div>
    <!-- /Invoice Actions -->
</div>

<script>
var orderId = '{{$order->id}}';
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
<!-- /Offcanvas -->
@endsection