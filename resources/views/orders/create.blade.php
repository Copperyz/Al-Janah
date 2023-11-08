@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Add Order'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-invoice.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/offcanvas-send-invoice.js')}}"></script>
<script src="{{asset('assets/js/app-invoice-add.js')}}"></script>
<script src="{{asset('assets/js/forms-selects.js')}}"></script>
@endsection

@section('content')
<h4 class="mb-4">{{__('Add Order')}}</h4>

<div class="row invoice-add">
    <!-- Invoice Add-->
    <div class="col-lg-9 col-12 mb-lg-0 mb-4">
        <div class="card invoice-preview-card">
            <div class="card-body">
                <form class="source-item pt-4 px-0 px-sm-4" id="addOrderForm">
                    <div class="row p-0 p-sm-4">
                        <!-- First Column -->
                        <div class="col-md-6 mb-md-0 mb-3">
                            <div class="mb-3">
                                <label for="html5-datetime-local-input"
                                    class="form-label me-4 fw-medium">{{__('Date')}}</label>
                                <input class="form-control" type="datetime-local" value=""
                                    id="html5-datetime-local-input" name="date" />
                            </div>
                            <div class="mb-3">
                                <label for="salesperson" class="form-label me-4 fw-medium">{{__('Amount')}}</label>
                                <input type="text" class="form-control" id="salesperson"
                                    placeholder="{{__('Enter amount')}}" name="amount" />
                            </div>
                            <div class="mb-3">
                                <label for="customer_id" class="form-label me-4 fw-medium">{{__('Customer')}}</label>
                                <select id="customer_id" class="select2 form-select form-select-lg"
                                    data-allow-clear="true" name="customer_id">
                                    <!-- Options for customers -->
                                </select>
                            </div>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6 mb-md-0 mb-3">

                        </div>
                    </div>


                    <hr class="my-3 mx-n4" />


                    <div class="mb-3" data-repeater-list="orderItems">
                        <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                            <div class="d-flex border rounded position-relative pe-0">
                                <div class="row w-100 p-3">
                                    <div class="col-md-6 col-12 mb-md-0 mb-3">
                                        <p class="mb-2 repeater-title">Item</p>
                                        <div class="mb-3">
                                            <label for="parcel_types_id"
                                                class="form-label me-4 fw-medium">{{__('Parcel Type')}}</label>
                                            <select id="parcel_types_id" class="select2 form-select"
                                                data-allow-clear="true" name="parcel_types_id">
                                                <option value="AZ">Arizona</option>
                                                <option value="CO" selected>Colorado</option>
                                                <option value="ID">Idaho</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="UT">Utah</option>
                                                <option value="WY">Wyoming</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="good_types_id"
                                                class="form-label me-4 fw-medium">{{__('Good Type')}}</label>
                                            <select id="good_types_id" class="select2 form-select"
                                                data-allow-clear="true" name="good_types_id">
                                                <option value="AZ">Arizona</option>
                                                <option value="CO" selected>Colorado</option>
                                                <option value="ID">Idaho</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="UT">Utah</option>
                                                <option value="WY">Wyoming</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-3 col-12 mb-md-0 mb-3">
                                        <p class="mb-2 repeater-title">{{__('Details')}}</p>
                                        <input name="price" type="number" class="form-control invoice-item-price mb-3"
                                            placeholder="{{__('Price')}}" min="12" />
                                        <input name="height" type="number" class="form-control invoice-item-price mb-3"
                                            placeholder="{{__('Height')}}" min="12" />
                                        <input name="width" type="number" class="form-control invoice-item-price mb-3"
                                            placeholder="{{__('Width')}}" min="12" />
                                        <input name="weight" type="number" class="form-control invoice-item-price mb-3"
                                            placeholder="{{__('Weight')}}" min="12" />
                                    </div>
                                    <div class="col-md-2 col-12 mb-md-0 mb-3">
                                        <p class="mb-2 repeater-title">{{__('Qty')}}</p>
                                        <input name="qty" type="number" class="form-control invoice-item-qty"
                                            placeholder="1" min="1" max="50" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-4">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary" id="add-item-btn"
                                data-repeater-create>{{__('Add Item')}}</button>
                        </div>
                    </div>


                    <hr class="my-3 mx-n4" />

                    <div class="row p-0 p-sm-4">
                        <div class="col-md-6 mb-md-0 mb-3">
                            <div class="d-flex align-items-center mb-3">
                                <label for="salesperson" class="form-label me-4 fw-medium">Salesperson:</label>
                                <input type="text" class="form-control ms-3" id="salesperson"
                                    placeholder="Edward Crowley" />
                            </div>
                            <input type="text" class="form-control" id="invoiceMsg"
                                placeholder="Thanks for your business" />
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <div class="invoice-calculations">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="w-px-100">Subtotal:</span>
                                    <span class="fw-medium">$00.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="w-px-100">Discount:</span>
                                    <span class="fw-medium">$00.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="w-px-100">Tax:</span>
                                    <span class="fw-medium">$00.00</span>
                                </div>
                                <hr />
                                <div class="d-flex justify-content-between">
                                    <span class="w-px-100">Total:</span>
                                    <span class="fw-medium">$00.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3 mx-n4" />

                    <div class="row px-0 px-sm-4">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="note" class="form-label fw-medium">{{__('Notes')}}</label>
                                <textarea class="form-control" rows="2" id="note" placeholder=""
                                    name="notes"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Invoice Add-->

    <!-- Invoice Actions -->
    <div class="col-lg-3 col-12 invoice-actions">
        <div class="card mb-4">
            <div class="card-body">
                <!-- <button class="btn btn-primary d-grid w-100 mb-2" data-bs-toggle="offcanvas"
                    data-bs-target="#sendInvoiceOffcanvas">
                    <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                            class="ti ti-send ti-xs me-2"></i>Send Invoice</span>
                </button> -->
                <!-- <a href="{{url('app/invoice/preview')}}" class="btn btn-label-secondary d-grid w-100 mb-2">Preview</a> -->
                <button class="btn btn-primary d-grid w-100 mb-2 submitButton" id="submitButton">
                    <span class="d-flex align-items-center justify-content-center text-nowrap">{{__('Submit')}}</span>
                </button>
                <button class="btn btn-danger d-grid w-100 mb-2 cancelButton">
                    <span class="d-flex align-items-center justify-content-center text-nowrap"
                        id="cancelButton">{{__('Cancel')}}</span>
                </button>
            </div>
        </div>
    </div>
    <!-- /Invoice Actions -->
</div>

<!-- Offcanvas -->
@include('_partials/_offcanvas/offcanvas-send-invoice')
<!-- /Offcanvas -->
@endsection