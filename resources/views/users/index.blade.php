@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', __('Users'))

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection


@section('page-script')
    <script src="{{ asset('assets/js/extends/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/extends/form-layouts.js') }}"></script>
    <script src="{{ asset('assets/js/users/app-user-list.js') }}"></script>

@endsection

@section('content')

    <!-- Users List Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title">{{ __('Users') }}</h4>
            <div class="d-flex justify-content-between align-items-center row gap-3 gap-md-0">
                <p>
                    {{ __('Manage users, assign roles, and control access to ensure they have the appropriate permissions for their tasks and responsibilities.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-datatable table-responsive mt-3">
            <table class="datatables-users table">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>

    <!-- Offcanvas to add new user -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">{{ __('Add User') }}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="add-new-user pt-0 addNewUserForm" id="addNewUserForm" action="{{ route('users.store') }}"
                method="POST">
                <div class="mb-3">
                    <label class="form-label" for="name">{{ __('Name') }}</label>
                    <input type="text" class="form-control" placeholder="John Doe" name="name"
                        aria-label="John Doe" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">{{ __('Email') }}</label>
                    <input type="text" class="form-control" placeholder="john.doe@example.com"
                        aria-label="john.doe@example.com" name="email" />
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">{{ __('Password') }}</label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>

                </div>

                <div class="mb-3">
                    <label for="role" class="form-label me-4 fw-medium">{{ __('Role') }}</label>
                    <select id="addrole" class="select2 form-select" data-allow-clear="true" name="role">
                        <option disabled selected>{{ __('Select') }}</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-sumbit">{{ __('Submit') }}</button>
                <button type="reset" class="btn btn-label-secondary"
                    data-bs-dismiss="offcanvas">{{ __('Cancel') }}</button>
            </form>
        </div>
    </div>

    <!-- Offcanvas to edit user -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditUser" aria-labelledby="offcanvasEditUserLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasEditUserLabel" class="offcanvas-title">{{ __('Edit User') }}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="edit-new-user pt-0 editUserForm" id="editUserForm" action="" method="PUT">
                <div class="mb-3">
                    <label class="form-label" for="name">{{ __('Name') }}</label>
                    <input type="text" class="form-control" placeholder="John Doe" name="name"
                        aria-label="John Doe" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">{{ __('Email') }}</label>
                    <input type="text" class="form-control" placeholder="john.doe@example.com"
                        aria-label="john.doe@example.com" name="email" />
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">{{ __('Password') }}</label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>

                </div>

                <div class="mb-3">
                    <label for="role" class="form-label me-4 fw-medium">{{ __('Role') }}</label>
                    <select id="role" class="select2 form-select" data-allow-clear="true" name="role">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="id" id="id">
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-sumbit">{{ __('Submit') }}</button>
                <button type="reset" class="btn btn-label-secondary"
                    data-bs-dismiss="offcanvas">{{ __('Cancel') }}</button>
            </form>
        </div>
    </div>

    <script>
        var addNewUserTranslation = @json(__('Add User'));
        var addButton = '<br>';
    </script>

    @if (auth()->user()->can('add user'))
        <script>
            addButton = {
                text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">${addCurrencyTranslation}</span>`,
                className: 'add-new btn btn-primary mt-2 mb-2 addCurrency',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#addCurrencyModal'
                },
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                }
            }
        </script>
    @endif




@endsection
