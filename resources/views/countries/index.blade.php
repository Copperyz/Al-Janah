@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Countries'))

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
    <script src="{{ asset('assets/js/countries/add-country.js') }}"></script>
    <script src="{{ asset('assets/js/extends/forms-selects.js') }}"></script>
@endsection

@section('content')

    <div class="card mb-3">
        <div class="card-header">
            <h4 class="card-title">{{ __('Countries') }}</h4>
            <div class="d-flex justify-content-between align-items-center row gap-3 gap-md-0">
                <p>
                    {{ __('Countries can be managed and assigned specific settings or regions, ensuring that administrators have control over the options and features available for each country.') }}
                </p>
            </div>
        </div>
    </div>

    @if (auth()->user()->can('add country'))
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="row h-100">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-center h-100 justify-content-center mt-sm-0 mt-3">
                            <img src="{{ asset('assets/img/backgrounds/' . $configData['style'] . '_flag_3d.png') }}"
                                class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <button data-bs-target="#addCountryModal" data-bs-toggle="modal"
                                class="btn btn-primary mb-2 text-nowrap add-new-country">{{ __('Add Country') }}</button>
                            <p class="mb-0 mt-1">{{ __('Add a country if it does not exist') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-3">
        @foreach ($countriesList as $country)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1">
                            <div class="role-heading">
                                <h4 class="mb-1 d-flex align-items-center"><i
                                        class="fis fi fi-{{ $country->country_code }} rounded-circle me-2 fs-3"></i>
                                    {{ $country->name }}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- First Page Link -->
            @if ($countriesList->onFirstPage())
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
                    <a class="page-link" href="{{ $countriesList->url(1) }}">
                        @if (app()->getLocale() == 'ar')
                            <i class="ti ti-chevrons-right ti-xs"></i>
                        @else
                            <i class="ti ti-chevrons-left ti-xs"></i>
                        @endif
                    </a>
                </li>
            @endif

            <!-- Previous Page Link -->
            @if ($countriesList->onFirstPage())
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
                    <a class="page-link" href="{{ $countriesList->previousPageUrl() }}">
                        @if (app()->getLocale() == 'ar')
                            <i class="ti ti-chevron-right ti-xs"></i>
                        @else
                            <i class="ti ti-chevron-left ti-xs"></i>
                        @endif
                    </a>
                </li>
            @endif

            <!-- Numbered Page Links -->
            @foreach ($countriesList->getUrlRange(1, $countriesList->lastPage()) as $page => $url)
                <li class="page-item{{ $countriesList->currentPage() == $page ? ' active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            <!-- Next Page Link -->
            @if ($countriesList->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $countriesList->nextPageUrl() }}">
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
            @if ($countriesList->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $countriesList->url($countriesList->lastPage()) }}">
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

    @include('_partials/_modals/country/add-country')

@endsection
