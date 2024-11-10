@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp


@extends('layouts/layoutMaster')

@section('title', __('Currencies'))

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
    <script src="{{ asset('assets/js/currencies/app-currencies-list.js') }}"></script>
    <script src="{{ asset('assets/js/extends/forms-extras.js') }}"></script>
    <script src="{{ asset('assets/js/extends/forms-selects.js') }}"></script>
@endsection

@section('content')

    <div class="card mb-3">
        <div class="card-header">
            <h4 class="card-title">{{ __('Currencies') }}</h4>
            <div class="d-flex justify-content-between align-items-center row gap-3 gap-md-0">
                <p>
                    {{ __('Currencies can be managed and assigned specific settings or rates, ensuring that administrators have control over the pricing and cost structures available for each item or service.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Trip List Table -->
    <div class="card">
        <div class="card-datatable table-responsive mt-3">
            <table class="currencies-list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ __('Name') }}</th>
                        <th dir="ltr">{{ __('Symbol') }}</th>
                        <th>{{ __('Value in USD') }}</th>
                        <th class="text-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <script>
        var addCurrencyTranslation = @json(__('Add Currency'));
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

    @if (auth()->user()->can('add currency'))
        <script>
                addButton = {
                    text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">${addCurrencyTranslation}</span>`,
                    className: 'add-new btn btn-primary mt-2 mb-2',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#addCurrencyModal'
                    },
                    init: function(api, node) {
                $(node).removeClass('btn-secondary'); // Remove secondary class
            }
        };
        </script>
    @endif

    <!-- Modal -->
    @include('_partials/_modals/currencies/modal-add-currency')
    @include('_partials/_modals/currencies/modal-edit-currency')
    <!-- /Modal -->


@endsection
