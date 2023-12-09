@if(count($shipmentHistory) > 0)
<div class="container animate__fadeInDown">
    <div class="row justify-content-center">
        <div class="card col-md-12">
            <!-- Map Menu Wrapper -->
            <div class="d-flex">
                <!-- Map Menu -->
                <div class="app-logistics-fleet-sidebar col h-100" id="app-logistics-fleet-sidebar">
                    <div class="card-header border-0 pt-4 pb-2 d-flex justify-content-between">
                        <h5 class="mb-0 card-title">{{__('Tracking Shipment')}}
                            <span class="small text-success">
                                ({{ Str::of(request()->url())->afterLast('/') }})
                            </span>
                        </h5>


                    </div>
                    <!-- Sidebar when screen < md -->
                    <div class="card-body p-0 logistics-fleet-sidebar-body">
                        <!-- Menu Accordion -->
                        <div class="accordion p-2" id="fleet" data-bs-toggle="sidebar"
                            data-target="#app-logistics-fleet-sidebar">
                            @php
                            $groupedHistory = collect($shipmentHistory)->groupBy('country');
                            @endphp

                            @foreach($groupedHistory as $country => $countryHistory)
                            <!-- Get the type from the first record for the country -->
                            @php
                            $countryType = $countryHistory[0]['type'];
                            @endphp

                            <!-- Display a block for each country -->
                            <div class="accordion-item border-0 mb-4" id="fl-{{$countryHistory[0]['route_leg']+1}}">
                                <div class="accordion-header" id="fleet{{$countryHistory[0]['route_leg']+1}}">
                                    <div role="button" class="accordion-button collapsed shadow-none align-items-center"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#fleetCollapse{{$countryHistory[0]['route_leg']+1}}_{{$countryHistory[0]['tripRouteId']}}"
                                        aria-expanded="true"
                                        aria-controls="fleetCollapse{{$countryHistory[0]['route_leg']+1}}_{{$countryHistory[0]['tripRouteId']}}">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2">
                                                    @if($countryType === 'Origin')
                                                    <span class="avatar-initial rounded-circle bg-label-secondary"><i
                                                            class="ti ti-home text-body ti-sm"></i></span>
                                                    @elseif($countryType === 'Transit')
                                                    <span class="avatar-initial rounded-circle bg-label-secondary"><i
                                                            class="ti ti-truck text-body ti-sm"></i></span>
                                                    @elseif($countryType === 'Destination')
                                                    <span class="avatar-initial rounded-circle bg-label-secondary"><i
                                                            class="ti ti-flag text-body ti-sm"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="d-flex flex-column">
                                                <span class="h6 mb-0">{{__($countryType)}}</span>
                                                <span class="text-muted">{{__($country)}}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div id="fleetCollapse{{$countryHistory[0]['route_leg']+1}}_{{$countryHistory[0]['tripRouteId']}}"
                                    class="accordion-collapse collapse" data-bs-parent="#fleet">
                                    <div class="accordion-body pt-3 pb-0">
                                        <ul class="timeline ps-3 mb-0">
                                            @foreach($countryHistory as $history)
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
@else
<h3>{{__('No results were found.')}}</h3>
@endif