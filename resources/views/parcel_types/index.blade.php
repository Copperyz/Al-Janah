@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Parcel Types'))

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/parcel_types/parcel-types-list.js') }}"></script>
    <script src="{{ asset('assets/js/extends/forms-selects.js') }}"></script>
@endsection

@section('content')

    <div class="card mb-3">
        <div class="card-header">
            <h4 class="card-title">{{ __('Parcel Types') }}</h4>
            <div class="d-flex justify-content-between align-items-center row gap-3 gap-md-0">
                <p>
                    {{ __('Managing parcel types allows you to define and categorize different types of parcels, ensuring proper handling and tracking within the system.') }}
                </p>
            </div>
        </div>
    </div>

    @if (auth()->user()->can('add parcel type'))
        <div class="row g-4">
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-center h-100 justify-content-center mt-sm-0 mt-3">
                                <img src="{{ asset('assets/img/illustrations/bulb-dark.png') }}"
                                    class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <button data-bs-target="#addParcelTypeModal" data-bs-toggle="modal"
                                    class="btn btn-primary mb-2 text-nowrap add-new-city">{{ __('Add Parcel Type') }}</button>
                                <p class="mb-0 mt-1">{{ __('Add a Parcel Type if it does not exist') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif

    @foreach ($parcelTypes as $parcelType)
        <div class="col-xl-3 col-lg-4 col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1">
                        <div class="role-heading">
                            <h4 class="mb-1 d-flex align-items-center">
                                {{ $parcelType->name }}</h4>
                            @if (auth()->user()->can('edit parcel type'))
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editParcelTypeModal"
                                    class="address-edit-modal editParcelType" data-type-id="{{ $parcelType->id }}">
                                    <span>{{ __('Edit Parcel Type') }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- First Page Link -->
            @if ($parcelTypes->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        @if (app()->getLocale() == 'ar')
                            <i class="ti ti-chevrons-right ti-xs"></i>
                        @else
                            <i class="ti ti-chevrons-left ti-xs"></i>
                        @endif
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $parcelTypes->url(1) }}">
                        @if (app()->getLocale() == 'ar')
                            <i class="ti ti-chevrons-right ti-xs"></i>
                        @else
                            <i class="ti ti-chevrons-left ti-xs"></i>
                        @endif
                    </a>
                </li>
            @endif

            <!-- Previous Page Link -->
            @if ($parcelTypes->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        @if (app()->getLocale() == 'ar')
                            <i class="ti ti-chevron-right ti-xs"></i>
                        @else
                            <i class="ti ti-chevron-left ti-xs"></i>
                        @endif
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $parcelTypes->previousPageUrl() }}">
                        @if (app()->getLocale() == 'ar')
                            <i class="ti ti-chevron-right ti-xs"></i>
                        @else
                            <i class="ti ti-chevron-left ti-xs"></i>
                        @endif
                    </a>
                </li>
            @endif

            <!-- Numbered Page Links -->
            @foreach ($parcelTypes->getUrlRange(1, $parcelTypes->lastPage()) as $page => $url)
                <li class="page-item{{ $parcelTypes->currentPage() == $page ? ' active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            <!-- Next Page Link -->
            @if ($parcelTypes->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $parcelTypes->nextPageUrl() }}">
                        @if (app()->getLocale() == 'ar')
                            <i class="ti ti-chevron-left ti-xs"></i>
                        @else
                            <i class="ti ti-chevron-right ti-xs"></i>
                        @endif
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        @if (app()->getLocale() == 'ar')
                            <i class="ti ti-chevron-left ti-xs"></i>
                        @else
                            <i class="ti ti-chevron-right ti-xs"></i>
                        @endif
                    </span>
                </li>
            @endif

            <!-- Last Page Link -->
            @if ($parcelTypes->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $parcelTypes->url($parcelTypes->lastPage()) }}">
                        @if (app()->getLocale() == 'ar')
                            <i class="ti ti-chevrons-left ti-xs"></i>
                        @else
                            <i class="ti ti-chevrons-right ti-xs"></i>
                        @endif
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        @if (app()->getLocale() == 'ar')
                            <i class="ti ti-chevrons-left ti-xs"></i>
                        @else
                            <i class="ti ti-chevrons-right ti-xs"></i>
                        @endif
                    </span>
                </li>
            @endif
        </ul>
    </nav>
    </div>

    @include('_partials/_modals/parcel_types/add-parcel-type')
    @include('_partials/_modals/parcel_types/edit-parcel-type')

@endsection
