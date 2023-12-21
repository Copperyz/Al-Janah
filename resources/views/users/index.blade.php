@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', __('Users'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />

@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
@endsection


@section('content')

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Session</span>
                        <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">21,459</h3>
                            <p class="text-success mb-0">(+29%)</p>
                        </div>
                        <p class="mb-0">Total Users</p>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="ti ti-user ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Paid Users</span>
                        <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">4,567</h3>
                            <p class="text-success mb-0">(+18%)</p>
                        </div>
                        <p class="mb-0">Last week analytics </p>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-danger">
                            <i class="ti ti-user-plus ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Active Users</span>
                        <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">19,860</h3>
                            <p class="text-danger mb-0">(-14%)</p>
                        </div>
                        <p class="mb-0">Last week analytics</p>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="ti ti-user-check ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Pending Users</span>
                        <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">237</h3>
                            <p class="text-success mb-0">(+42%)</p>
                        </div>
                        <p class="mb-0">Last week analytics</p>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="ti ti-user-exclamation ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Users List Table -->
<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Search Filter</h5>
        <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
        </div>
    </div>
    <div class="card-datatable table-responsive">
        <table class="datatables-users table">
            <thead class="border-top">
                <tr>
                    <th></th>
                    <th>{{__('User')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
            </thead>
        </table>
    </div>
    <!-- Offcanvas to add new user -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">{{__('Add User')}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="add-new-user pt-0 addNewUserForm" id="addNewUserForm" action="{{ route('users.store') }}"
                method="POST">
                <div class="mb-3">
                    <label class="form-label" for="name">{{__('Name')}}</label>
                    <input type="text" class="form-control" placeholder="John Doe" name="name" aria-label="John Doe" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">{{__('Email')}}</label>
                    <input type="text" class="form-control" placeholder="john.doe@example.com"
                        aria-label="john.doe@example.com" name="email" />
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">{{__('Password')}}</label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-sumbit">{{__('Submit')}}</button>
                <button type="reset" class="btn btn-label-secondary"
                    data-bs-dismiss="offcanvas">{{__('Cancel')}}</button>
            </form>
        </div>
    </div>

    <!-- Offcanvas to edit user -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditUser" aria-labelledby="offcanvasEditUserLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasEditUserLabel" class="offcanvas-title">{{__('Edit User')}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="edit-new-user pt-0 editUserForm" id="editUserForm" action="" method="PUT">
                <div class="mb-3">
                    <label class="form-label" for="name">{{__('Name')}}</label>
                    <input type="text" class="form-control" placeholder="John Doe" name="name" aria-label="John Doe" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">{{__('Email')}}</label>
                    <input type="text" class="form-control" placeholder="john.doe@example.com"
                        aria-label="john.doe@example.com" name="email" />
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">{{__('Password')}}</label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>

                </div>
                <input type="hidden" name="id" id="id">
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-sumbit">{{__('Submit')}}</button>
                <button type="reset" class="btn btn-label-secondary"
                    data-bs-dismiss="offcanvas">{{__('Cancel')}}</button>
            </form>
        </div>
    </div>
</div>
<script>
var addNewUserTranslation = @json(__('Add User'));
</script>


@section('page-script')
<script src="{{asset('assets/js/app-user-list.js')}}"></script>
@endsection

@endsection