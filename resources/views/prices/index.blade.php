@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp


@extends('layouts/layoutMaster')

@section('title', __('Prices'))

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/prices/app-prices-list.js') }}"></script>
    <script src="{{ asset('assets/js/extends/forms-extras.js') }}"></script>
    <script src="{{ asset('assets/js/extends/forms-selects.js') }}"></script>
@endsection

@section('content')

    <div class="card mb-3">
        <div class="card-header">
            <h4 class="card-title">{{ __('Prices') }}</h4>
            <div class="d-flex justify-content-between align-items-center row gap-3 gap-md-0">
                <p>
                    {{ __('Prices can be managed and assigned specific settings or rates, ensuring that administrators have control over the pricing and cost structures available for each item or service.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Trip List Table -->
    <div class="card">
        <div class="card-datatable table-responsive mt-3">
            <table class="trip-routes-list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ __('From') }}</th>
                        <th>{{ __('To') }}</th>
                        <th>{{ __('Good Type') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <script>
        var addPriceTranslation = @json(__('Add Price'));
        var typeTranslation = @json(__('Type'));
        var selectTranslation = @json(__('Select'));
        var originTranslation = @json(__('Origin'));
        var transitTranslation = @json(__('Transit'));
        var destinationTranslation = @json(__('Destination'));
        var countryTranslation = @json(__('Country'));
        var libyaTranslation = @json(__('Libya'));
        var turkeyTranslation = @json(__('Turkey'));
        var chinaTranslation = @json(__('China'));
        var dubaiTranslation = @json(__('Dubai'));
        var tunisTranslation = @json(__('Tunis'));
        var airTranslation = @json(__('Air'));
        var seaTranslation = @json(__('Sea'));

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

        var addButton = '<br>';
    </script>

    @if (auth()->user()->can('add price'))
        <script>
            addButton = {
                text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">${addPriceTranslation}</span>`,
                className: 'add-new btn btn-primary mt-2 mb-2 addPrice',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#addPriceModal'
                },
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                }
            }
        </script>
    @endif

    <!-- Modal -->
    @include('_partials/_modals/prices/modal-add-price')
    @include('_partials/_modals/prices/modal-edit-price')
    <!-- /Modal -->


@endsection
