@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Permissions'))

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/permissions/app-access-permission.js') }}"></script>
    <script src="{{ asset('assets/js/permissions/modal-add-permission.js') }}"></script>
    <script src="{{ asset('assets/js/permissions/modal-edit-permission.js') }}"></script>
@endsection

@section('content')

    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title">{{ __('Permissions List') }}</h4>
            <div class="d-flex justify-content-between align-items-center row gap-3 gap-md-0">
                <p>
                    {{ __('Assigning permissions to roles ensures that users with those roles have the necessary access to execute designated tasks and functionalities.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-datatable table-responsive mt-3">
            <table class="datatables-permissions table">
                <thead class="border-top">
                    <tr>
                        <th></th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Created Date') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!--/ Permission Table -->

        <script>
            var addPermissionTranslation = @json(__('Add Permission'));
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
        </script>

        <!-- Modal -->
        @include('_partials/_modals/permissions/modal-add-permission')
        @include('_partials/_modals/permissions/modal-edit-permission')
        <!-- /Modal -->
    @endsection
