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
<script src="{{asset('assets/js/shipments/app-shipment-add.js')}}"></script>
<script src="{{asset('assets/js/forms-selects.js')}}"></script>
<script src="{{asset('assets/js/form-layouts.js')}}"></script>
@endsection

@section('content')
<h4 class="mb-4">{{__('Add Order')}}</h4>

<div class="row invoice-add">
    <!-- Invoice Add-->
    <div class="col-lg-9 col-12 mb-lg-0 mb-4">
        <div class="card invoice-preview-card">
            <div class="card-body">
                <form class="source-item pt-4 px-0 px-sm-4" id="addShipmentForm">
                    <div class="col-md-12 mb-md-0 p-0 p-sm-4 row">
                        <label for="customer_id" class="form-label me-4 fw-medium">{{__('Customer')}}</label>
                        <div class="col-md-10">
                            <select id="customer_id" class="select2 form-select form-select-lg" data-allow-clear="true"
                                name="customer_id">
                                <option disabled selected>{{__('Select')}}</option>
                                @foreach($customers as $customer)
                                <option value="{{$customer->id}}">
                                    @if($customer->customer_code)
                                    {{$customer->customer_code}}
                                    -
                                    @endif
                                    {{$customer->first_name}} {{$customer->last_name}}
                                    @if($customer->email)
                                    - {{$customer->email}}
                                    @endif
                                    @if($customer->phone)
                                    - {{$customer->phone}}
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" data-bs-target="#addCustomerModal" data-bs-toggle="modal"
                                data-bs-dismiss="modal">
                                <i class="ti ti-plus me-md-1"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row p-0 p-sm-4">
                        <!-- First Column -->
                        <div class="col-md-6 mb-md-0 mb-3">
                            <div class="mb-3">
                                <label for="html5-datetime-local-input"
                                    class="form-label me-4 fw-medium">{{__('Date')}}</label>
                                <input class="form-control date-picker" id="datePicker" type="datetime-local"
                                    placeholder="{{__('Enter date')}}" name="date" />
                            </div>
                            <div class="mb-3">
                                <label for="salesperson"
                                    class="form-label me-4 fw-medium">{{__('Packages cost')}}</label>
                                <input type="text" class="form-control" id="salesperson"
                                    placeholder="{{__('Enter amount')}}" name="amount" />
                            </div>
                        </div>


                        <!-- Second Column -->
                        <div class="col-md-6 mb-md-0 mb-3">
                            <div class="mb-3">
                                <label for="trip_route_id"
                                    class="form-label me-4 fw-medium">{{__('Trip Route')}}</label>
                                <select id="trip_route_id" class="select2 form-select form-select-lg"
                                    data-allow-clear="true" name="trip_route_id">
                                    <option disabled selected>{{__('Select')}}</option>
                                    @foreach($tripRoutes as $tripRoute)
                                    <option value="{{$tripRoute->id}}">{{__($tripRoute->legs_combined)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="shipmentPrice" id="shipmentPrice">
                    </div>


                    <hr class="my-3 mx-n4" />


                    <div class="mb-3" data-repeater-list="shipmentItems" id="shipmentItems">
                        <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                            <div class="d-flex border rounded position-relative pe-0">
                                <div class="row w-100 p-3">
                                    <div class="col-md-6 col-12 mb-md-0 mb-3">
                                        <p class="mb-2 repeater-title">{{__('Item')}}</p>
                                        <div class="mb-3">
                                            <label for="parcel_types_id"
                                                class="form-label me-4 fw-medium">{{__('Parcel Type')}}</label>
                                            <select id="parcel_types_id" class="select2 form-select"
                                                data-allow-clear="true" name="parcel_types_id">
                                                <option disabled selected>{{__('Select')}}</option>
                                                @foreach($parcelTypes as $parcelType)
                                                <option value="{{$parcelType->id}}">{{$parcelType->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="good_types_id"
                                                class="form-label me-4 fw-medium">{{__('Good Type')}}</label>
                                            <select id="good_types_id" class="select2 form-select"
                                                data-allow-clear="true" name="good_types_id">
                                                <option disabled selected>{{__('Select')}}</option>
                                                @foreach($goodTypes as $goodType)
                                                <option value="{{$goodType->id}}">{{$goodType->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <button type="button"
                                                class="btn btn-primary calculate-price-btn">{{__('Calculate Price')}}</button>

                                        </div>
                                        <label class="switch switch-primary">
                                            <input type="checkbox" name="addToInventory" class="switch-input" />
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="ti ti-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="ti ti-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">{{__('Add to Inventory')}}</span>
                                        </label>
                                        <div class="inventory-fields">
                                            <div class="mb-3">
                                                <label for="inventory_id"
                                                    class="form-label me-4 fw-medium">{{__('Inventory')}}</label>
                                                <select id="inventory_id" class="select2 form-select"
                                                    data-allow-clear="true" name="inventory_id">
                                                    <option disabled selected>{{__('Select')}}</option>
                                                    @foreach($inventories as $inventory)
                                                    <option value="{{$inventory->id}}">{{$inventory->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="form-aisle">{{__('Aisle')}}</label>
                                                <input type="number" class="form-control" id="form-aisle"
                                                    placeholder="{{__('Aisle')}}" value="1" required name="aisle"
                                                    aria-label="Product Aisle">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="form-row">{{__('Row')}}</label>
                                                <input type="number" class="form-control" id="form-row"
                                                    placeholder="{{__('Row')}}" value="1" required name="row"
                                                    aria-label="Product Row">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="form-self">{{__('Shelf')}}</label>
                                                <input type="number" class="form-control" id="form-self"
                                                    placeholder="{{__('Self')}}" value="1" required name="shelfNumber"
                                                    aria-label="Product Self">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mb-md-0 mb-3">
                                        <p class="mb-2 repeater-title">{{__('Details')}}</p>
                                        <label for="parcel_types_id"
                                            class="form-label me-4 fw-medium">{{__('Height')}}</label>
                                        <input name="height" type="number" class="form-control invoice-item-price mb-3"
                                            placeholder="{{__('Height')}}" />
                                        <label for="parcel_types_id"
                                            class="form-label me-4 fw-medium">{{__('Width')}}</label>
                                        <input name="width" type="number" class="form-control invoice-item-price mb-3"
                                            placeholder="{{__('Width')}}" />
                                        <label for="parcel_types_id"
                                            class="form-label me-4 fw-medium">{{__('Weight')}}</label>
                                        <input name="weight" type="number" class="form-control invoice-item-price mb-3"
                                            placeholder="{{__('Weight')}}" />
                                        <label for="parcel_types_id"
                                            class="form-label me-4 fw-medium">{{__('Length')}}</label>
                                        <input name="length" type="number" class="form-control invoice-item-price mb-3"
                                            placeholder="{{__('Length')}}" />
                                        <label for="parcel_types_id"
                                            class="form-label me-4 fw-medium">{{__('Price')}}</label>
                                        <input name="price" type="number" class="form-control invoice-item-price mb-3"
                                            placeholder="{{__('Price')}}" />
                                    </div>
                                    <div class="col-md-2 col-12 mb-md-0 mb-3">
                                        <p class="mb-2 repeater-title">{{__('Qty')}}</p>
                                        <input name="quantity" type="number" class="form-control invoice-item-qty"
                                            placeholder="1" min="1" max="50" value="1" />
                                    </div>
                                </div>
                                <div
                                    class="d-flex flex-column align-items-center justify-content-between border-start p-2 deleteElement">
                                    <i class="ti ti-x cursor-pointer" data-repeater-delete></i>
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

                    <div class="row px-0 px-sm-4">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="note" class="form-label fw-medium">{{__('Notes')}}</label>
                                <textarea class="form-control" rows="2" id="note" placeholder=""
                                    name="notes"></textarea>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3 mx-n4" />

                    <div class="row p-0 p-sm-4">
                        <div class="col-md-6 mb-md-0 mb-3">

                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <div class="invoice-calculations">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="w-px-100 me-2">{{__('Trip fare')}}</span>
                                    <span id="tripFareValue" class="fw-medium">$00.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="w-px-100">{{__('Freight cost')}}</span>
                                    <span id="freightValue" class="fw-medium">$00.00</span>
                                </div>
                                <hr />
                                <div class="d-flex justify-content-between">
                                    <span class="w-px-100">{{__('Total')}}</span>
                                    <span id="totalValue" class="fw-medium">$00.00</span>
                                </div>
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
                <div class="d-flex my-2">
                    <button type="button" class="btn btn-label-danger w-100 cancelButton me-2">{{__('Cancel')}}</button>
                    <button type="button" class="btn btn-label-primary w-100 submitButton">{{__('Submit')}}</button>
                </div>

            </div>
        </div>
    </div>
    <!-- /Invoice Actions -->
</div>


<script>
var addOrderTranslation = @json(__('Add Order'));

</script>

<script>
function removeItem(button) {
    // Find the closest repeater item and remove it
    $(button).closest('[data-repeater-item]').remove();

    // Clear the fields in the removed item
    clearFields();
}

function clearFields() {
    // Clear the values in the form fields
    $('[data-repeater-list="shipmentItems"] [name="parcel_types_id"]').val('').trigger('change');
    $('[data-repeater-list="shipmentItems"] [name="good_types_id"]').val('').trigger('change');
    $('[data-repeater-list="shipmentItems"] [name="price"]').val('');
    $('[data-repeater-list="shipmentItems"] [name="height"]').val('');
    $('[data-repeater-list="shipmentItems"] [name="width"]').val('');
    $('[data-repeater-list="shipmentItems"] [name="weight"]').val('');
    $('[data-repeater-list="shipmentItems"] [name="qty"]').val('');
}
</script>

<!-- Offcanvas -->
@include('_partials/_offcanvas/offcanvas-send-invoice')
<!-- /Offcanvas -->
@include('_partials/_modals/shipments/modal-add-customer')

@endsection