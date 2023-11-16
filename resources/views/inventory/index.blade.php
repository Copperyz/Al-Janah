@extends('layouts/layoutMaster')

@section('title', __('Inventory List'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-ecommerce.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/inventory/app-inventory-list.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-2">
    <span class="text-muted fw-light">{{__('Inventory')}} /</span> {{__('Inventory List')}}
</h4>

<div class="app-ecommerce-category">
    <!-- Category List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-inventory-list table border-top">
                <thead>
                    <tr>
                        <th>{{__('Inventory')}}</th>
                        <th class="text-nowrap ">{{__('Branch')}}&nbsp;</th>
                        <th class="text-nowrap ">{{__('Total Items')}}</th>
                        <th class="text-lg">{{__('Actions')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Offcanvas to add new customer -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEcommerceCategoryList"
        aria-labelledby="offcanvasEcommerceCategoryListLabel">
        <!-- Offcanvas Header -->
        <div class="offcanvas-header py-4">
            <h5 id="offcanvasEcommerceCategoryListLabel" class="offcanvas-title">{{__('Add Inventory')}}</h5>
            <button type="button" class="btn-close bg-label-secondary text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <!-- Offcanvas Body -->
        <div class="offcanvas-body border-top">
            <form action="{{route('inventory.store')}}" method="POST" class="pt-0" id="addInventoryForm">

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label" for="ecommerce-category-title">{{__('Name')}}</label>
                    <input type="text" class="form-control" required id="ecommerce-category-title"
                        placeholder="{{__('Enter inventory name')}}" name="inventoryName" aria-label="category title">
                </div>

                <!-- Parent category -->
                <div class="mb-3 ecommerce-select2-dropdown">
                    <label class="form-label" for="inventory-branch">{{__('Branch')}}</label>
                    <select id="inventory-branch" required class="select2 form-select" name="branchID"
                        data-placeholder="Select inventory branch">
                        <option value=''>{{__('Select inventory branch')}}</option>
                        @foreach ($branches as $branch)
                        <option value='{{$branch->id}}'>{{$branch->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit and reset -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">{{__('Add')}}</button>
                    <button type="reset" class="btn bg-label-danger"
                        data-bs-dismiss="offcanvas">{{__('Discard')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
var addInventoryTranslation = @json(__('Add Inventory'));
window.translations = {
    custom: @json(__('validation.custom'))
};
</script>

<!-- Model -->
@include('inventory/edit')
@endsection