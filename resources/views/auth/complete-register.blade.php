@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Complete Register'))

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
<script src="{{asset('assets/js/auth/register.js')}}"></script>
@endsection

@section('content')

<div class="card">
  <div class="card-body">
    <div class="row gy-3">
      <!-- Onboarding modals -->
      
      <!-- Horizontal Onboarding modals -->
      <div class="col-lg-4 col-md-6">
        <!-- Form with Image horizontal Modal -->
        <div class="modal-onboarding modal fade animate__animated" id="onboardHorizontalImageModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" >
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content text-center">
              <div class="modal-header border-0">
               
              </div>
              <div class="modal-body onboarding-horizontal p-0">
                <div class="onboarding-media">
                  <img src="{{asset('assets/img/illustrations/boy-verify-email-'.$configData['style'].'.png')}}" alt="boy-verify-email-light" width="273" class="img-fluid" data-app-light-img="illustrations/boy-verify-email-light.png" data-app-dark-img="illustrations/boy-verify-email-dark.png">
                </div>
                <div class="onboarding-content mb-0">
                  <h4 class="onboarding-title text-body">{{__('Finalize Your Profile Setup')}}</h4>
                  <div class="onboarding-info">{{__('Provide the necessary details to enable smooth tracking and management of your shipments')}}.</div>
                  <form method="POST" action="{{route('store-account', $user->id)}}" id="completeRegisterForm">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">{{__('First Name')}}</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                    name="first_name" placeholder="{{__('Enter your First Name')}}" autofocus>
                                @error('first_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                    <label for="last_name" class="form-label">{{__('Last Name')}}</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                    name="last_name" placeholder="{{__('Enter your Last Name')}}" autofocus>
                                @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                            <label class="form-label" for="country">{{__('Country')}}</label>
                            <select id="country" class="select2 form-select" data-allow-clear="true" name="country">
                                <option value="" disabled>{{__('Select')}}</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}" {{$country->name == 'Libya' ? 'selected' : ''}}>{{$country->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                            <label class="form-label" for="city">{{__('City')}}</label>
                            <select id="city" class="select2 form-select" data-allow-clear="true" name="city">
                                <option value="" disabled>{{__('Select')}}</option>
                                @foreach ($cities as $city)
                                    <option value="{{$city->id}}" {{$city->name == 'Libya' ? 'selected' : ''}}>{{$city->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                              <label class="form-label" for="phone">{{__('Phone No')}}</label>
                              <input type="text" id="phone" name="phone" class="form-control phone-mask" placeholder="092 333 0033" aria-label="092 333 0033" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="address">{{__('Address')}}</label>
                                <input type="text" id="address" name="address" class="form-control" placeholder="1456, Mall Road" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                      <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                      <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Transparent Modal -->
      
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
        // Get the modal element
        var modal = new bootstrap.Modal(document.getElementById('onboardHorizontalImageModal'));

        // Show the modal
        modal.show();
    });    
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