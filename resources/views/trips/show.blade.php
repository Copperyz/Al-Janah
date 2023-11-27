@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp


@extends('layouts/layoutMaster')

@section('title', __('Show Trip'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-on-scroll/animate-on-scroll.css')}}" />

@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/animate-on-scroll/animate-on-scroll.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/form-wizard-icons.js')}}"></script>
<script src="{{asset('assets/js/extended-ui-timeline.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">{{__('Trips')}} /</span> {{__('Show Trip')}}
</h4>
<!-- Default -->
<div class="row">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

        <div class="d-flex flex-column justify-content-between gap-2 gap-sm-0">

            <h5 class="mb-1 mt-3 d-flex flex-wrap gap-2 align-items-end">{{__('Tracking NO')}}
                {{$trip->tracking_no}}
                <span class="badge bg-label-success"> <i style="font-size: 0.81em;" class="ti ti-circle-filled"></i>
                    <span id="currentCountrySpan" data-country="{{$trip->currentLegData['country']}}"
                        data-historyCount="{{count($trip->tripHistory)}}">{{__($trip->currentLegData['country'])}}</span>
                </span>
                <span class="badge bg-label-info"><i style="font-size: 0.81em;" class="ti ti-circle-filled"></i>
                    <span id="currentStatusSpan" data-status="{{$trip->current_status}}">
                        {{__($trip->current_status)}} </span>
                </span>
            </h5>
            <p class="text-body" style="margin-top: 2em;">{{__('Estimated Delivery Date')}}<span id="orderYear">
                    {{$trip->estimated_delivery_date}}</span></p>
        </div>
        @if($trip->current_status == "Delivered")
        <div class="d-flex gap-3"><a href="{{route('trips.index')}}" class="btn btn-label-secondary">{{__('Back')}}</a>
        </div>
        @endif
        <!-- <div class=" d-flex align-content-center flex-wrap gap-2">
                <button class="btn btn-label-danger delete-order">Delete Order</button>
        </div> -->
    </div>

    <!-- Default Icons Wizard -->
    @if($trip->current_status != "Delivered")
    <div class="col-12 mb-4" id="wizardBody">
        <div class="bs-stepper wizard-icons wizard-icons-example mt-2">

            <div class="bs-stepper-header">
                @foreach($trip->tripRoute->legs as $leg)
                <div class="step" data-target="#route{{$leg['country']}}">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-icon">
                            <svg viewBox="0 0 54 54">
                                <use xlink:href="{{asset('assets/svg/icons/form-wizard-account.svg#wizardAccount')}}">
                                </use>
                            </svg>
                        </span>
                        <span class="bs-stepper-label">{{__($leg['type']) .' ('. __($leg['country']).')'}}</span>
                    </button>
                </div>
                @if($leg['type'] != "Destination")
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                @endif
                @endforeach
            </div>
            <div class="bs-stepper-content">
                @foreach($trip->tripRoute->legs as $key => $leg)
                <form id="formSubmit{{$leg['country']}}" action="{{route('trip-history.store')}}" method="POST"
                    onsubmit="return false">
                    <!-- Account Details -->
                    <div id="route{{$leg['country']}}" class="content">
                        <!-- <div class="content-header mb-3">
                            <h6 class="mb-0">Account Details</h6>
                            <small>Enter Your Account Details.</small>
                        </div> -->
                        <div class="row g-3">
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-md mb-md-0 mb-3">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content"
                                                for="radioWarehouse{{$leg['country']}}">
                                                <span class="custom-option-body">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-building-warehouse"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M3 21v-13l9 -4l9 4v13" />
                                                        <path d="M13 13h4v8h-10v-6h6" />
                                                        <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                                                    </svg>
                                                    <span
                                                        class="custom-option-title">{{__('At Warehouse') . ' (' . __($leg['country']) . ')'}}</span>
                                                    <!-- <small> Delivery time (9am – 5pm) </small> -->
                                                </span>

                                                <input name="radio{{$leg['country']}}" class="form-check-input"
                                                    type="radio" value="At Warehouse"
                                                    data-current-country="{{$leg['country']}}"
                                                    data-current-route="{{$key}}" id="radioWarehouse{{$leg['country']}}"
                                                    checked />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md mb-md-0 mb-3">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content"
                                                for="radioEnroute{{$leg['country']}}">
                                                <span class="custom-option-body">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-plane-inflight" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M15 11.085h5a2 2 0 1 1 0 4h-15l-3 -6h3l2 2h3l-2 -7h3l4 7z">
                                                        </path>
                                                        <path d="M3 21h18"></path>
                                                    </svg>
                                                    @if($leg['type'] != "Destination")
                                                    <span
                                                        class="custom-option-title">{{__('Enroute'). ' '.  __('to') .' '. __($trip->tripRoute->legs[$key + 1]['country'])}}
                                                    </span>
                                                    @else
                                                    <span class="custom-option-title">{{__('Delivered')}}
                                                    </span>
                                                    @endif
                                                </span>

                                                @if($leg['type'] != "Destination")
                                                <input name="radio{{$leg['country']}}" class="form-check-input"
                                                    data-next-route="{{$key}}"
                                                    data-current-country="{{$leg['country']}}" type="radio"
                                                    value="Enroute" id="radioEnroute{{$leg['country']}}" />
                                                @else
                                                <input name="radio{{$leg['country']}}" class="form-check-input"
                                                    data-current-route="{{$key}}"
                                                    data-current-country="{{$leg['country']}}" type="radio"
                                                    value="Delivered" id="radioEnroute{{$leg['country']}}" />
                                                @endif
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @if($trip->tripHistory !== null && $trip->tripHistory !== false &&
                            count($trip->tripHistory)
                            > 0)
                            <div class="alert alert-warning" role="alert" id="noteWrapper">
                                <h6 class="alert-heading mb-2">{{__('Note')}}</h6>
                                <p id="noteContent" class="mb-0">

                                    {{ $trip->tripHistory->last()->note }}
                                </p>
                            </div>
                            @endif

                            <div class="mb-3 col-12 mb-3">
                                <label class="form-label" for="note">{{__('Notes')}}</label>
                                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                                <input type="text" id="note" name="note{{$leg['country']}}" value=""
                                    class="form-control" placeholder="{{__('Notes')}}" />
                            </div>

                            <div class="d-grid gap-2 col-md-2 col-sm-4 mx-auto">
                                <!-- <a href="#" class="btn btn-success" id="btnConfirm"> <span
                                        class="align-middle d-sm-inline-block d-none me-sm-1">{{__('Confirm')}}</span>
                                </a> -->
                                <!-- <button class="btn btn-primary btn-next"> <span
                                        class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i
                                        class="ti ti-arrow-right"></i></button> -->

                                <button class="btn btn-primary btn-lg btn-next" id="btnConfirm" type="submit">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">{{__('Confirm')}}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <!-- Review -->
    <div id="reviewRoute">
        <div class="row overflow-hidden">
            <div class="col-12">
                <ul class="timeline timeline-center mt-5">
                    @foreach($trip->tripHistory as $key => $history)
                    <li class="timeline-item">
                        <span class="timeline-indicator timeline-indicator-primary" data-aos="zoom-in"
                            data-aos-delay="200">
                            <i class="ti ti-brush ti-sm"></i>
                        </span>
                        <div class="timeline-event card p-0"
                            data-aos="{{ $key % 2 == 1 ? 'fade-left' : 'fade-right' }}">
                            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="card-title mb-0">{{__($trip->tripRoute->legs[$history->route_leg]['type'])}}
                                </h6>
                                <div class="meta">
                                    @php
                                    $nextIndex = $history->route_leg + 1;
                                    @endphp
                                    <span class="badge rounded-pill bg-label-primary">
                                        {{ __($history->status)}}
                                        {{$history->status == 'Enroute' && isset($trip->tripRoute->legs[$nextIndex]['country']) ? ' '.__('to').' '.__($trip->tripRoute->legs[$nextIndex]['country']) : null }}
                                    </span>

                                    <span
                                        class="badge rounded-pill bg-label-success">{{__($trip->tripRoute->legs[$history->route_leg]['country'])}}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    {{__($history->note)}}
                                </p>
                            </div>
                            <div class="timeline-event-time">{{$history->created_at}}</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <hr>
    </div>
    @endif
    <!-- /Default Icons Wizard -->

</div>
<script>

</script>
<!-- Modern -->

@endsection