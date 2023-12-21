@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Add Item'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />

@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-l10n/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/inventory/app-inventory-items.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-0">
    <span class="text-muted fw-light">{{__('Inventory')}} /</span><span class="fw-medium"> {{__('Add Product')}}</span>
</h4>

<div class="app-ecommerce">
    <form action="{{route('inventoryItems.store')}}" method="POST" class="inventory-form" id="inventoryItemForm">
        <!-- Add Product -->
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1 mt-3">{{__('Add a new product')}}</h4>
                <!-- <p class="text-muted">Orders placed across your store</p> -->
            </div>
            <div class="d-flex align-content-center flex-wrap gap-3">
                <div class="d-flex gap-3"><button type="button"
                        class="btn btn-label-secondary cancelButtonAdd">{{__('Discard')}}</button>
                    <!-- <button class="btn btn-label-primary">Save draft</button> -->
                </div>
                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
            </div>

        </div>

        <div class="row">

            <!-- First column-->
            <div class="col-12 col-lg-8">
                <!-- Product Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-tile mb-0">{{__('Product information')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="ecommerce-product-name">{{__('Name')}}</label>
                            <input type="text" class="form-control" id="ecommerce-product-name"
                                placeholder="{{__('Product Name')}}" required name="productName"
                                aria-label="{{__('Product Name')}}">
                        </div>
                        <div class="row mb-3">
                            <div class="col"><label class="form-label"
                                    for="ecommerce-product-sku">{{__('Quantity')}}</label>
                                <input type="number" class="form-control" id="ecommerce-product-sku"
                                    placeholder="{{__('Qty')}}" required name="productQty" aria-label="Product Qty">
                            </div>
                            <div class="col"><label class="form-label"
                                    for="ecommerce-product-barcode">{{__('Barcode')}}</label>
                                <input type="text" class="form-control" id="ecommerce-product-barcode"
                                    placeholder="0123-4567" required name="productBarcode" aria-label="Product barcode">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /Product Information -->

                <!-- Variants -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{__('Spatial and Dimensions')}}</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-repeater">
                            <div data-repeater-list="group-a">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-height">{{__('Height')}}</label>
                                            <input type="number" class="form-control" id="form-height"
                                                placeholder="{{__('Height')}}" name="productHeight"
                                                aria-label="Product Height">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-width">{{__('Width')}}</label>
                                            <input type=" number" class="form-control" id="form-width"
                                                placeholder="{{__('Width')}}" name="productWidth"
                                                aria-label="Product Width">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-weight">{{__('Weight')}}</label>
                                            <input type="number" class="form-control" id="form-weight"
                                                placeholder="{{__('Weight')}}" name="productWeight"
                                                aria-label="Product Weight">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-aisle">{{__('Aisle')}}</label>
                                            <input type="number" class="form-control" id="form-aisle"
                                                placeholder="{{__('Aisle')}}" value="1" required name="productAisle"
                                                aria-label="Product Aisle">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-row">{{__('Row')}}</label>
                                            <input type="number" class="form-control" id="form-row"
                                                placeholder="{{__('Row')}}" value="0" required name="productRow"
                                                aria-label="Product Row">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-self">{{__('Shelf')}}</label>
                                            <input type="number" class="form-control" id="form-self"
                                                placeholder="{{__('Self')}}" value="0" required name="productSelf"
                                                aria-label="Product Self">
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <!-- <div>
                            <button class="btn btn-primary" data-repeater-create>
                                Add another option
                            </button>
                        </div> -->
                        </form>
                    </div>
                </div>
                <!-- /Variants -->

            </div>
            <!-- /Second column -->

            <!-- Second column -->
            <div class="col-12 col-lg-4">

                <!-- Organize Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{__('Categorize')}}</h5>
                    </div>
                    <div class="card-body">
                        <!-- Inventory -->
                        <div class="mb-3 col">
                            <label class="form-label mb-1" for="inv">
                                {{__('Inventory')}}
                            </label>
                            <select id="inv" required name="inventoryID" class="select2 form-select" data-allow-clear="true">
                                <option disabled selected>{{__('Select')}}</option>
                                @foreach ($inventories as $inventory)
                                <option value='{{$inventory->id}}'>{{$inventory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- shipments -->
                        <div class="mb-3 col">
                            <label class="form-label mb-1" for="shipment">
                                {{__('Shipment')}}
                            </label>
                            <select id="shipment" name="shipmentID" class="select2 form-select">
                                <option disabled selected>{{__('Select')}}</option>
                                @foreach ($shipments as $shipment)
                                <option value='{{$shipment->id}}'>{{$shipment->tracking_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Percel Types -->
                        <div class="mb-3 col">
                            <label class="form-label mb-1" for="parcel">
                                {{__('Parcel Type')}}
                            </label>
                            <select id="parcel" name="parcelType" class="select2 form-select">
                                <option disabled selected>{{__('Select')}}</option>
                                @foreach ($parcelTypes as $parcel)
                                <option value='{{$parcel->id}}'>{{$parcel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Status -->
                        <div class="mb-3 col ecommerce-select2-dropdown">
                            <label class="form-label mb-1" for="status-org">{{__('Status')}}
                            </label>
                            <select id="status-org" name="status" class="select2 form-select">
                                <!-- <option disabled selected>{{__('Select')}}</option> -->
                                <option value="inStock">{{__('In Stock')}}</option>
                                <option value="returned">{{__('Returned')}}</option>
                                <option value="leftInventory">{{__('Left Inventory')}}</option>
                            </select>
                        </div>

                    </div>
                </div>
                <!-- /Organize Card -->
            </div>
            <!-- /Second column -->
    </form>
    <!-- Inventory -->
   
    <!-- /Inventory -->
</div>
</div>

@endsection