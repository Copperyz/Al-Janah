@php
    $customizerHidden = 'customizer-hide';

    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Track Shipment'))
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/mapbox-gl/mapbox-gl.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
@endsection
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-faq.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-logistics-fleet.css') }}" />

@endsection
@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/mapbox-gl/mapbox-gl.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/trips/app-tracking-fleet.js') }}"></script>
@endsection

@section('content')
    <div>
        <div class="faq-header d-flex flex-column landing-hero justify-content-center align-items-center rounded"
            style="min-height: 100vh !important;">
            <h3 class="text-center text-primary hero-title display-6 fw-bold">
                {{ __('Track your shipment') }}
            </h3>
            <div class="input-wrapper my-3 input-group input-group-lg input-group-merge">
                <span class="input-group-text" id="basic-addon1"><i class="ti ti-search"></i></span>
                <input type="text" id="trackingNumber" class="form-control text-center" placeholder="{{ __('Enter Tracking Number') }}"
                    aria-label="Search" aria-describedby="basic-addon1" autocomplete="off"/>
            </div>
            <div class="d-grid gap-2  mt-4">
                    <button class="btn btn-primary btn-lg waves-effect waves-light px-5" onclick="searchShipment(event)">
                        <span id="btnSpinner" class="spinner-grow visually-hidden" role="status" aria-hidden="true"></span>
                        {{ __("Track my Shipment") }}</button>
                </div>
            <div class="row mt-3 col-md-12">
                
                <div class="animate__fadeInDown text-center" id="searchResults" style="margin-top: 2em;">
                <!-- Display search results here dynamically -->
                <!-- <p class="text-center mb-0 px-3">or choose a category to quickly find the help you need</p> -->
                <!-- <div class="alert alert-primary alert-dismissible" role="alert">
                    {{ __('Tracking shipments involves monitoring the movement and status of packages or goods during their transit from the origin to the destination') }}.<br>
                    {{ __('The process begins with the initiation of a shipment, assigning a unique tracking number to each package') }}.<br>{{ __('Relevant information, including origin, destination, package details, and estimated delivery time, is associated with this tracking number.') }}
                </div> -->
            </div>

            </div>
            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function searchShipment(evnet) {

            showSpinner('#searchResults');

            var button = event.target;
            var spinner = document.getElementById('btnSpinner');

            // Show the spinner
            spinner.classList.remove('visually-hidden');
            button.setAttribute('disabled', 'disabled');

            var trackingNumber = $('#trackingNumber').val();
            $.ajax({
                type: 'POST',
                url: 'track-shipment-data',
                data: {
                    'tracking_number': trackingNumber
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#searchResults').html(data);
                    hideSpinner();
                    spinner.classList.add('visually-hidden');
                    button.removeAttribute('disabled');
                },
                error: function(error) {
                    hideSpinner();
                    spinner.classList.add('visually-hidden');
                    button.removeAttribute('disabled');
                }
            });
        }

        // Get the input element
        var trackingNumberInput = document.getElementById('trackingNumber');

        // Add an event listener for the 'keydown' event
        trackingNumberInput.addEventListener('keydown', function(event) {
            // Check if the key pressed is 'Enter'
            if (event.key === 'Enter') {
                // Call the searchShipment function
                searchShipment();
            }
        });
    </script>
@endsection
