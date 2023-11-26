@extends('layouts/layoutMaster')

@section('title', __('Add Product'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />

@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
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
                <h4 class="mb-1 mt-3">{{__('Add a new Product')}}</h4>
                <!-- <p class="text-muted">Orders placed across your store</p> -->
            </div>
            <div class="d-flex align-content-center flex-wrap gap-3">
                <div class="d-flex gap-3"><button class="btn btn-label-secondary">{{__('Discard')}}</button>
                    <!-- <button class="btn btn-label-primary">Save draft</button> -->
                </div>
                <button type="submit" class="btn btn-primary">{{__('Publish product')}}</button>
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
                                aria-label="Product title">
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
                                                placeholder="{{__('Aisle')}}" required name="productAisle"
                                                aria-label="Product Aisle">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-self">{{__('Shelf')}}</label>
                                            <input type="number" class="form-control" id="form-self"
                                                placeholder="{{__('Self')}}" required name="productSelf"
                                                aria-label="Product Self">
                                        </div>
                                        <div class="mb-3 col-md-4 col-sm-6">
                                            <label class="form-label" for="form-row">{{__('Row')}}</label>
                                            <input type="number" class="form-control" id="form-row"
                                                placeholder="{{__('Row')}}" required name="productRow"
                                                aria-label="Product Row">
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
                            <select id="inv" required name="inventoryID" class="select2 form-select">
                                <option value=''>{{__('Select')}}</option>
                                @foreach ($inventories as $inventory)
                                <option value='{{$inventory->id}}'>{{$inventory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- shipments -->
                        <div class="mb-3 col ecommerce-select2-dropdown">
                            <label class="form-label mb-1" for="shipment">
                                {{__('Shipment')}}
                            </label>
                            <select id="shipment" name="shipmentID" class="select2 form-select">
                                <option value=''>{{__('Select')}}</option>
                                @foreach ($shipments as $shipment)
                                <option value='{{$shipment->id}}'>{{$shipment->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Percel Types -->
                        <div class="mb-3 col ecommerce-select2-dropdown">
                            <label class="form-label mb-1" for="parcel">
                                {{__('Parcel Type')}}
                            </label>
                            <select id="parcel" name="parcelType" class="select2 form-select">
                                <option value=''>{{__('Select')}}</option>
                                @foreach ($parcelTypes as $parcel)
                                <option value='{{$parcel->id}}'>{{$parcel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Status -->
                        <div class="mb-3 col ecommerce-select2-dropdown">
                            <label class="form-label mb-1" for="status-org">{{__('Status')}}
                            </label>
                            <select id="status-org" name="status" class="select2 form-select"
                                data-placeholder="Published">
                                <option value="inStock">{{__('In Stock')}}</option>
                                <option value="returned">{{__('returned')}}</option>
                                <option value="inactive">{{__('Inactive')}}</option>
                            </select>
                        </div>

                    </div>
                </div>
                <!-- /Organize Card -->
            </div>
            <!-- /Second column -->
    </form>
    <!-- Inventory -->
    <div class="col-12 col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Inventory</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Navigation -->
                    <div class="col-12 col-md-4 mx-auto card-separator">
                        <div class="d-flex justify-content-between flex-column mb-3 mb-md-0 pe-md-3">
                            <ul class="nav nav-align-left nav-pills flex-column">
                                <li class="nav-item">
                                    <button class="nav-link py-2 active" data-bs-toggle="tab" data-bs-target="#restock">
                                        <i class="ti ti-box me-2"></i>
                                        <span class="align-middle">Restock</span>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link py-2" data-bs-toggle="tab" data-bs-target="#shipping">
                                        <i class="ti ti-car me-2"></i>
                                        <span class="align-middle">Shipping</span>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link py-2" data-bs-toggle="tab"
                                        data-bs-target="#global-delivery">
                                        <i class="ti ti-world me-2"></i>
                                        <span class="align-middle">Global Delivery</span>
                                    </button>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /Navigation -->
                    <!-- Options -->
                    <div class="col-12 col-md-8 pt-4 pt-md-0">
                        <div class="tab-content p-0 ps-md-3">
                            <!-- Restock Tab -->
                            <div class="tab-pane fade show active" id="restock" role="tabpanel">
                                <h5>Options</h5>
                                <label class="form-label" for="ecommerce-product-stock">Add to Stock</label>
                                <div class="row mb-3 g-3 pe-md-5">
                                    <div class="col-12 col-sm-9">
                                        <input type="number" class="form-control" id="ecommerce-product-stock"
                                            placeholder="Quantity" name="quantity" aria-label="Quantity">
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <button class="btn btn-primary align-items-center"><i
                                                class='ti ti-check me-2 ti-xs'></i>Confirm</button>
                                    </div>
                                </div>
                                <div>
                                    <p class="mb-1"><span class="fw-semibold text-heading">Product in stock now:
                                        </span> <span>54</span></p>
                                    <p class="mb-1"><span class="fw-semibold text-heading">Product in transit:
                                        </span> <span>390</span></p>
                                    <p class="mb-1"><span class="fw-semibold text-heading">Last time restocked:
                                        </span> <span>24th June, 2023</span></p>
                                    <p class="mb-1"><span class="fw-semibold text-heading">Total stock over
                                            lifetime: </span> <span>2430</span></p>
                                </div>
                            </div>
                            <!-- Shipping Tab -->
                            <div class="tab-pane fade" id="shipping" role="tabpanel">
                                <h5 class="mb-4">Shipping Type</h5>
                                <div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="shippingType" id="seller">
                                        <label class="form-check-label" for="seller">
                                            <span class="fw-medium d-block mb-1">Fulfilled by Seller</span>
                                            <small>You'll be responsible for product delivery.<br>
                                                Any damage or delay during shipping may cost you a Damage
                                                fee.</small>
                                        </label>
                                    </div>
                                    <div class="form-check mb-5">
                                        <input class="form-check-input" type="radio" name="shippingType"
                                            id="companyName" checked>
                                        <label class="form-check-label" for="companyName">
                                            <span class="fw-medium d-block mb-1">Fulfilled by Company name
                                                &nbsp;<span
                                                    class="badge rounded-2 badge-warning bg-label-warning fs-tiny py-1 border border-warning">RECOMMENDED</span></span>
                                            <small>Your product, Our responsibility.<br>
                                                For a measly fee, we will handle the delivery process for
                                                you.</small>
                                        </label>
                                    </div>
                                    <p class="mb-0">See our <a href="javascript:void(0);">Delivery terms and
                                            conditions</a> for details</p>
                                </div>
                            </div>
                            <!-- Global Delivery Tab -->
                            <div class="tab-pane fade" id="global-delivery" role="tabpanel">
                                <h5 class="mb-4">Global Delivery</h5>
                                <!-- Worldwide delivery -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="globalDel" id="worldwide">
                                    <label class="form-check-label" for="worldwide">
                                        <span class="fw-medium mb-1 d-block">Worldwide delivery</span>
                                        <small>Only available with Shipping method:
                                            <a href="javascript:void(0);">Fulfilled by Company name</a></small>
                                    </label>
                                </div>
                                <!-- Global delivery -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="globalDel" checked>
                                    <label class="form-check-label w-75 pe-5" for="country-selected">
                                        <span class="fw-medium d-block mb-1">Selected Countries</span>
                                        <input type="text" class="form-control" placeholder="Type Country name"
                                            id="country-selected">
                                    </label>
                                </div>
                                <!-- Local delivery -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="globalDel" id="local">
                                    <label class="form-check-label" for="local">
                                        <span class="fw-medium mb-1 d-block">Local delivery</span>
                                        <small>Deliver to your country of residence :
                                            <a href="javascript:void(0);">Change profile address</a></small>
                                    </label>
                                </div>
                            </div>



                        </div>
                    </div>
                    <!-- /Options-->
                </div>
            </div>
        </div>
    </div>
    <!-- /Inventory -->
</div>
</div>
<script>
window.translations = {
    custom: @json(__('validation.custom'))
};
</script>
@endsection