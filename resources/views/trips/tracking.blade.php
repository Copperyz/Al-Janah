@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Tracking Shipment'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/mapbox-gl/mapbox-gl.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-logistics-fleet.css')}}" />

@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/mapbox-gl/mapbox-gl.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/trips/app-tracking-fleet.js')}}"></script>
@endsection

@section('content')

<div class="alert alert-primary alert-dismissible" role="alert">
    {{__('Tracking shipments involves monitoring the movement and status of packages or goods during their transit from the origin to the destination. The process begins with the initiation of a shipment, assigning a unique tracking number to each package. Relevant information, including origin, destination, package details, and estimated delivery time, is associated with this tracking number.')}}
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-6">
            <!-- Map Menu Wrapper -->
            <div class="d-flex">
                <!-- Map Menu -->
                <div class="app-logistics-fleet-sidebar col h-100" id="app-logistics-fleet-sidebar">
                    <div class="card-header border-0 pt-4 pb-2 d-flex justify-content-between">
                        <h5 class="mb-0 card-title">{{__('Tracking Shipment')}}</h5>
                        <!-- Sidebar close button -->

                    </div>
                    <!-- Sidebar when screen < md -->
                    <div class="card-body p-0 logistics-fleet-sidebar-body">
                        <!-- Menu Accordion -->
                        <div class="accordion p-2" id="fleet" data-bs-toggle="sidebar"
                            data-target="#app-logistics-fleet-sidebar">

                            @foreach($tripRoute->legs as $index => $leg)
                            <!-- Fleet {{$index+1}} -->
                            <div class="accordion-item border-0 mb-4" id="fl-{{$index+1}}">
                                <div class="accordion-header" id="fleet{{$index+1}}">
                                    <div role="button" class="accordion-button collapsed shadow-none align-items-center"
                                        data-bs-toggle="collapse" data-bs-target="#fleetCollapse{{$index+1}}"
                                        aria-expanded="true" aria-controls="fleetCollapse{{$index+1}}">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2">
                                                    @if($leg['type'] === 'Origin')
                                                    <span class="avatar-initial rounded-circle bg-label-secondary"><i
                                                            class="ti ti-home text-body ti-sm"></i></span>
                                                    @elseif($leg['type'] === 'Transit')
                                                    <span class="avatar-initial rounded-circle bg-label-secondary"><i
                                                            class="ti ti-truck text-body ti-sm"></i></span>
                                                    @elseif($leg['type'] === 'Destination')
                                                    <span class="avatar-initial rounded-circle bg-label-secondary"><i
                                                            class="ti ti-flag text-body ti-sm"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="d-flex flex-column">
                                                <span class="h6 mb-0">{{__($leg['type'])}}</span>
                                                <span class="text-muted">{{__($leg['country'])}}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div id="fleetCollapse{{$index+1}}" class="accordion-collapse collapse"
                                    data-bs-parent="#fleet">
                                    <div class="accordion-body pt-3 pb-0">
                                        <ul class="timeline ps-3 mb-0">
                                            @foreach($tripHistory as $key => $history)
                                            @if($history['route_leg'] === $index)
                                            <li class="timeline-item ms-1 ps-4 border-left-dashed">
                                                <span
                                                    class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                                    <i class='ti ti-circle-check'></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small class="text-success text-uppercase fw-medium">
                                                            {{__($history['status'])}}
                                                        </small>
                                                    </div>
                                                    <h6 class="mb-1">{{$history['note']}}</h6>
                                                    <p class="text-muted mb-0">
                                                        {{date('M d, Y, H:i A', strtotime($history['created_at']))}}
                                                    </p>
                                                </div>
                                            </li>
                                            @if ($history['status'] === 'At Warehouse' && !isset($tripHistory[$key +
                                            1]))
                                            <!-- Display the next step in origin with no green check -->
                                            <li class="timeline-item ms-1 ps-4 border-left-dashed">
                                                <span
                                                    class="timeline-indicator-advanced timeline-indicator-secondary border-0 shadow-none">
                                                    <i class='ti ti-circle'></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small class="text-uppercase fw-medium">
                                                            {{__('Enroute')}}
                                                        </small>
                                                    </div>
                                                    <!-- Additional details for the next step -->
                                                </div>
                                            </li>
                                            @endif
                                            @endif
                                            @endforeach
                                        </ul>


                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>


                <!-- Overlay Hidden -->
            </div>
        </div>
    </div>
</div>

@endsection