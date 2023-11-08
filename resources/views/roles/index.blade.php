@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Roles'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>

<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/app-access-roles.js')}}"></script>
<script src="{{asset('assets/js/modal-add-role.js')}}"></script>
@endsection

@section('content')
<h4 class="mb-4">{{__('Roles')}}</h4>

<p class="mb-4">
    {{__('A role provided access to predefined menus and features so that depending on assigned role an administrator can have access to what the user needs.')}}
</p>
<!-- Role cards -->
<div class="row g-4">


    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card h-100">
            <div class="row h-100">
                <div class="col-sm-5">
                    <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                        <img src="{{ asset('assets/img/illustrations/add-new-roles.png') }}"
                            class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="card-body text-sm-end text-center ps-sm-0">
                        <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                            class="btn btn-primary mb-2 text-nowrap add-new-role">{{__('Add Role')}}</button>
                        <p class="mb-0 mt-1">{{__('Add a role, if it does not exist')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($roles as $role)
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="fw-normal mb-2">{{__('Total')}} {{$role->users()->count()}} {{__('Users')}}</h6>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-1">
                    <div class="role-heading">
                        <h4 class="mb-1">{{$role->name}}</h4>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editRoleModal"
                            class="role-edit-modal editRole" data-role-id="{{$role->id}}">
                            <span>{{__('Edit Role')}}</span>
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
            @if ($roles->onFirstPage())
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
                <a class="page-link" href="{{ $roles->url(1) }}">
                    @if (app()->getLocale() == 'ar')
                    <i class="ti ti-chevrons-right ti-xs"></i>
                    @else
                    <i class="ti ti-chevrons-left ti-xs"></i>
                    @endif
                </a>
            </li>
            @endif

            <!-- Previous Page Link -->
            @if ($roles->onFirstPage())
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
                <a class="page-link" href="{{ $roles->previousPageUrl() }}">
                    @if (app()->getLocale() == 'ar')
                    <i class="ti ti-chevron-right ti-xs"></i>
                    @else
                    <i class="ti ti-chevron-left ti-xs"></i>
                    @endif
                </a>
            </li>
            @endif

            <!-- Numbered Page Links -->
            @foreach ($roles->getUrlRange(1, $roles->lastPage()) as $page => $url)
            <li class="page-item{{ $roles->currentPage() == $page ? ' active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
            @endforeach

            <!-- Next Page Link -->
            @if ($roles->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $roles->nextPageUrl() }}">
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
            @if ($roles->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $roles->url($roles->lastPage()) }}">
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
<script>
var addNewUserTranslation = @json(__('Add User'));
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

<!-- Add Role Modal -->
@include('_partials/_modals/modal-add-role')
<!-- / Add Role Modal -->
<!-- Edit Role Modal -->
@include('_partials/_modals/modal-edit-role')
<!-- / Edit Role Modal -->
@endsection