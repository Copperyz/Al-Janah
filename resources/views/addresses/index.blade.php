@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Cities'))

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
    <script src="{{ asset('assets/js/addresses/address-list.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
@endsection

@section('content')

    <h4 class="mb-4">{{ __('Cities') }}</h4>

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
                            <button data-bs-target="#addAddressModal" data-bs-toggle="modal"
                                class="btn btn-primary mb-2 text-nowrap add-new-city">{{ __('Add Address') }}</button>
                            <p class="mb-0 mt-1">{{ __('Add a address if it does not exist') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($branches as $branch)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1">
                            <div class="role-heading">
                                <h4 class="mb-1 d-flex align-items-center">
                                    {{ $branch->name }}</h4>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editAddressModal"
                                    class="address-edit-modal editAddress" data-address-id="{{ $branch->id }}">
                                    <span>{{ __('Edit Address') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- First Page Link -->
                @if ($branches->onFirstPage())
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
                        <a class="page-link" href="{{ $branches->url(1) }}">
                            @if (app()->getLocale() == 'ar')
                                <i class="ti ti-chevrons-right ti-xs"></i>
                            @else
                                <i class="ti ti-chevrons-left ti-xs"></i>
                            @endif
                        </a>
                    </li>
                @endif

                <!-- Previous Page Link -->
                @if ($branches->onFirstPage())
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
                        <a class="page-link" href="{{ $branches->previousPageUrl() }}">
                            @if (app()->getLocale() == 'ar')
                                <i class="ti ti-chevron-right ti-xs"></i>
                            @else
                                <i class="ti ti-chevron-left ti-xs"></i>
                            @endif
                        </a>
                    </li>
                @endif

                <!-- Numbered Page Links -->
                @foreach ($branches->getUrlRange(1, $branches->lastPage()) as $page => $url)
                    <li class="page-item{{ $branches->currentPage() == $page ? ' active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <!-- Next Page Link -->
                @if ($branches->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $branches->nextPageUrl() }}">
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
                @if ($branches->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $branches->url($branches->lastPage()) }}">
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

    @include('_partials/_modals/address/add-address')
    @include('_partials/_modals/address/edit-address')

@endsection
