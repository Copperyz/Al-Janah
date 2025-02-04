@php

$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/blankLayout')

@section('title', __('Login'))

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('page-script')
<!-- <script src="{{asset('assets/js/pages-auth.js')}}"></script> -->
@endsection




@section('content')
<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                @if(config('variables.loginSideBackground'))
                <img src="{{ asset('assets/img/front-pages/landing-page/0-945x1069.png') }}"
                    alt="auth-login-cover" class="img-fluid my-5 auth-illustration"
                    data-app-light-img="front-pages/landing-page/0-945x1069.png"
                    data-app-dark-img="front-pages/landing-page/0-945x1069.png">
                @endif
                <img src="{{ asset('assets/img/illustrations/bg-shape-image-'.$configData['style'].'.png') }}"
                    alt="auth-login-cover" class="platform-bg"
                    data-app-light-img="illustrations/bg-shape-image-light.png"
                    data-app-dark-img="illustrations/bg-shape-image-dark.png">
            </div>
        </div>
        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <!-- Logo -->
                <div class="app-brand demo mb-4">
                    <a href="{{url('/')}}" class="app-brand-link gap-2" dir="ltr">
                        <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20,"withbg"=>'fill:
                            #fff;'])</span>
                            <span class="app-brand-text demo menu-text fw-bold">{{__(config('variables.templateName'))}}</span>
                    </a>
                </div>
                <!-- /Logo -->
                <h3 class="mb-1">{{__('Welcome to')}} {{config('variables.templateName')}}</h3>
                <p class="mb-4">{{__('Please sign-in to your account')}}</p>
                <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{__('Email')}}</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="{{__('Enter your email')}}" autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">{{__('Password')}}</label>
                            <a href="{{ url('auth/forgot-password-cover') }}">
                                <small>{{__('Forgot Password?')}}</small>
                            </a>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                            <label class="form-check-label" for="remember-me">
                                {{__('Remember Me')}}
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary d-grid w-100">
                        {{__('Sign in')}}
                    </button>
                </form>
                <p class="text-center">
                    <span>{{__('New on our platform?')}}</span>
                    <a href="{{url('register')}}">
                        <span>{{__('Create an account')}}</span>
                    </a>
                </p>
                <!-- <div class="divider my-4">
                    <div class="divider-text">{{__('or')}}</div>
                </div> -->
                <!-- <div class="d-flex justify-content-center">
                    <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                        <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                        <i class="tf-icons fa-brands fa-google fs-5"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                        <i class="tf-icons fa-brands fa-twitter fs-5"></i>
                    </a>
                </div> -->
            </div>
        </div>
        <!-- /Login -->
    </div>
</div>

<script>
// Get the current app locale
var appLocale = "{{ app()->getLocale() }}";

// Get the stored locale from localStorage
var storedLocale = localStorage.getItem('locale');

// Check if the stored locale is different from the current app locale
if (storedLocale && storedLocale !== appLocale) {
    // Update the app locale
    var url = '{{ route("changeLocale", ["locale" => ":locale"]) }}';
    url = url.replace(':locale', storedLocale);

    // Navigate to the new URL
    window.location.href = url;
}
</script>

@endsection