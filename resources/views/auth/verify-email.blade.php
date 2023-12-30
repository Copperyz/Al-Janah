@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Verify Email Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="authentication-wrapper authentication-basic px-4">
  <div class="authentication-inner py-4">
    <!-- Verify Email -->
    <div class="card">
      <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center mb-4 mt-2">
        <a href="{{route('landing-page')}}" class="app-brand-link" dir="ltr">
                    <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' => "fill:
                        #fff;"])</span>
                    <span
                        class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{ config('variables.templateName') }}</span>
                </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-1 pt-2">{{__('Verify your email')}} ✉️</h4>
        <p class="text-start mb-4">
          {{__('Account activation link sent to your email address: :email. Please follow the link inside to continue', ['email' => $email])}}.
        </p>
        <a class="btn btn-primary w-100 mb-3" href="{{url('/register')}}">
          {{__('Go Back')}}
        </a>
        <p class="text-center mb-0">{{__("Didn't get the mail?")}}
          <a href="javascript:void(0);">
            {{__('Resend')}}
          </a>
        </p>
      </div>
    </div>
    <!-- /Verify Email -->
  </div>
</div>
@endsection
