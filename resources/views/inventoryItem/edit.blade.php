@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Edit Item'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/inventory/app-inventory-items.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-0">
    <span class="text-muted fw-light">{{__('Inventory')}} /</span><span class="fw-medium"> {{__('Edit Item')}}</span>
</h4>

<div class="app-ecommerce">
    <form action="{{route('inventoryItems.update', $inventoryItem->id)}}" method="PUT" class="inventory-form">
        <!-- Add Product -->
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1 mt-3">{{__('Edit Item')}}</h4>
                <!-- <p class="text-muted">shipments placed across your store</p> -->
            </div>
            <div class="d-flex align-content-center flex-wrap gap-3">
                <div class="d-flex gap-3"><button
                        class="btn btn-label-secondary cancelButton">{{__('Discard')}}</button>
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
                        <h5 class="card-tile mb-0">{{__('Item Information')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="ecommerce-product-name">{{__('Name')}}</label>
                            <input type="text" class="form-control" id="ecommerce-product-name"
                                placeholder="{{__('Product Name')}}" value="{{$inventoryItem->name}}" name="productName"
                                aria-label="Product title">
                        </div>
                        <div class="row mb-3">
                            <div class="col"><label class="form-label"
                                    for="ecommerce-product-sku">{{__('Quantity')}}</label>
                                <input type="number" class="form-control" id="ecommerce-product-sku"
                                    placeholder="{{__('Qty')}}" value="{{$inventoryItem->quantity}}" name="productQty"
                                    aria-label="Product Qty">
                            </div>
                            <div class="col"><label class="form-label"
                                    for="ecommerce-product-barcode">{{__('Barcode')}}</label>
                                <input type="text" class="form-control" id="ecommerce-product-barcode"
                                    placeholder="0123-4567" value="{{$inventoryItem->itemCode}}" name="productBarcode"
                                    aria-label="Product barcode">
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
                                                placeholder="{{__('Height')}}" value="{{$inventoryItem->height}}"
                                                name="productHeight" aria-label="Product Height">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-width">{{__('Width')}}</label>
                                            <input type=" number" class="form-control" id="form-width"
                                                placeholder="{{__('Width')}}" value="{{$inventoryItem->width}}"
                                                name="productWidth" aria-label="Product Width">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-weight">{{__('Weight')}}</label>
                                            <input type="number" class="form-control" id="form-weight"
                                                placeholder="{{__('Weight')}}" value="{{$inventoryItem->size}}"
                                                name="productWeight" aria-label="Product Weight">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-aisle">{{__('Aisle')}}</label>
                                            <input type="number" class="form-control" id="form-aisle"
                                                placeholder="{{__('Aisle')}}" value="{{$inventoryItem->aisle}}"
                                                name="productAisle" aria-label="Product Aisle">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-self">{{__('Shelf')}}</label>
                                            <input type="number" class="form-control" id="form-self"
                                                placeholder="{{__('Self')}}" value="{{$inventoryItem->shelfNumber}}"
                                                name="productSelf" aria-label="Product Self">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-row">{{__('Row')}}</label>
                                            <input type="number" class="form-control" id="form-row"
                                                placeholder="{{__('Row')}}" value="{{$inventoryItem->row}}"
                                                name="productRow" aria-label="Product Row">
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
                        <div class="mb-3 col ecommerce-select2-dropdown">
                            <label class="form-label mb-1" for="inv">
                                {{__('Inventory')}}
                            </label>
                            <select id="inv" name="inventoryID" class="select2 form-select"
                                data-placeholder="{{__('Select Inventory')}}">
                                <option value=''>{{__('Select')}}</option>
                                @foreach ($inventories as $inventory)
                                <option value='{{$inventory->id}}'
                                    {{$inventory->id == $inventoryItem->inventory_id ? 'selected': ''}}>
                                    {{$inventory->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- shipments -->
                        <div class="mb-3 col ecommerce-select2-dropdown">
                            <label class="form-label mb-1" for="order">
                                {{__('Shipment')}}
                            </label>
                            <select id="order" name="shipmentID" class="select2 form-select"
                                data-placeholder="{{__('Select Order')}}">
                                <option value=''>{{__('Select')}}</option>
                                @foreach ($shipments as $shipment)
                                <option value='{{$shipment->id}}'
                                    {{$shipment->id == $inventoryItem->shipment_id ? 'selected': ''}}>
                                    {{$shipment->tracking_no}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Percel Types -->
                        <div class="mb-3 col ecommerce-select2-dropdown">
                            <label class="form-label mb-1" for="parcel">
                                {{__('Parcel Type')}}
                            </label>
                            <select id="parcel" name="parcelType" class="select2 form-select"
                                data-placeholder="{{__('Select Parcel')}}">
                                <option value=''>{{__('Select')}}</option>
                                @foreach ($parcelTypes as $parcel)
                                <option value='{{$parcel->id}}'
                                    {{$parcel->id == $inventoryItem->parcel_types_id ? 'selected': ''}}>
                                    {{$parcel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Status -->
                        <div class="mb-3 col ecommerce-select2-dropdown">
                            <label class="form-label mb-1" for="status-org">{{__('Status')}}
                            </label>
                            <select id="status-org" name="status" class="select2 form-select"
                                data-placeholder="Published">
                                @php
                                $statusOptions = ['inStock' => __('In Stock'), 'returned' => __('Returned'),
                                'leftInventory' => __('Left Inventory')];
                                $selectedStatus = $inventoryItem->status ?? ''; // Assuming $inventoryItem is available
                                @endphp

                                @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}" {{ $value == $selectedStatus ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                </div>
                <!-- /Organize Card -->
            </div>
            <!-- /Second column -->
    </form>

</div>
</div>

@endsection