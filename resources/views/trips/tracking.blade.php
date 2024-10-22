@if (isset($shipment))
    <div class="container animate__fadeInDown">
        <div class="row justify-content-center">
            <!-- Use Bootstrap grid to define fixed widths -->
            <div class="card col-md-6 col-xs-8 col-lg-6" style="height: 200%; overflow: hidden;">
                <!-- Map Menu Wrapper -->
                <div class="text-start">
                    <!-- Map Menu -->
                    <div class="app-logistics-fleet-sidebar" id="app-logistics-fleet-sidebar">
                        <div class="card-header border-0">
                            <h5 class="mb-0 card-title">{{ __('Tracking Shipment') }}
                                (<span class="small text-success">
                                    {{ $shipment->tracking_no }}
                                </span>)
                            </h5>
                        </div>
                        <div class="ms-4">
                            - <small class="text-success text-uppercase fw-medium">
                                {{ __('Shipment Created') }}
                            </small>
                            <p class="text-muted mb-0 ms-1" style="word-wrap: break-word;">
                                {{ date('M d, Y, H:i A', strtotime($shipment->date)) }}
                            </p>
                        </div>

                        <!-- Sidebar when screen < md -->
                        <div class="card-body logistics-fleet-sidebar-body"
                            style="height: 100hv; overflow-y: auto;">
                            <!-- Menu Accordion -->
                            <div class="accordion" id="fleet" data-bs-toggle="sidebar"
                                data-target="#app-logistics-fleet-sidebar">

                                @foreach ($tripRoutes as $tripRoute)
                                    <h6>{{ __('Trip Route') }}
                                        ({{ __($tripRoute['type']) }})
                                    </h6>

                                    @foreach ($tripRoute['legs'] as $legIndex => $leg)
                                        <!-- Display each leg -->
                                        <div class="accordion-header mt-4" id="fleet{{ $legIndex }}">
                                                <div class="d-flex">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-2">
                                                            @if ($leg['type'] === 'Origin')
                                                                <span
                                                                    class="avatar-initial rounded-circle bg-label-secondary">
                                                                    <i class="ti ti-home text-body ti-sm"></i>
                                                                </span>
                                                            @elseif($leg['type'] === 'Destination')
                                                                <span
                                                                    class="avatar-initial rounded-circle bg-label-secondary">
                                                                    <i class="ti ti-flag text-body ti-sm"></i>
                                                                </span>
                                                            @else
                                                                <span
                                                                    class="avatar-initial rounded-circle bg-label-secondary">
                                                                    <i class="ti ti-truck text-body ti-sm"></i>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <span class="d-flex flex-column">
                                                        <span class="h6 mb-0">{{ __($leg['type']) }}</span>
                                                        <span class="text-muted" style="word-wrap: break-word;">
                                                            {{ __($leg['country']) }}
                                                        </span>
                                                    </span>
                                                </div>
                                        </div>
                                        <div id="fleetCollapse{{ $legIndex }}" class="accordion-collapse collapsed"
                                            data-bs-parent="#fleet">
                                            <div class="accordion-body pt-3 pb-0">
                                                <ul class="timeline ps-3 mb-0">
                                                    @php
                                                        // Filter shipment history for this leg and country
                                                        $legHistory = collect($shipmentHistory)
                                                            ->where('type', $leg['type'])
                                                            ->where('country', $leg['country']);
                                                    @endphp

                                                    @if ($legHistory->isEmpty())
                                                        <li class="timeline-item ms-1 ps-4 border-left-dashed">
                                                            <span
                                                                class="timeline-indicator-advanced timeline-indicator-warning border-0 shadow-none">
                                                                <i class='ti ti-alert-circle'></i>
                                                            </span>
                                                            <div class="timeline-event ps-0 pb-0">
                                                                <h6 class="mb-1" style="word-wrap: break-word;">
                                                                    {{ __('No updates have been made for this stage yet') }}
                                                                </h6>
                                                            </div>
                                                        </li>
                                                    @else
                                                        @foreach ($legHistory as $history)
                                                            <li class="timeline-item ms-1 ps-4 border-left-dashed">
                                                                <span
                                                                    class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                                                    <i class='ti ti-circle-check'></i>
                                                                </span>
                                                                <div class="timeline-event ps-0 pb-0">
                                                                    <div class="timeline-header">
                                                                        <small
                                                                            class="text-success text-uppercase fw-medium">
                                                                            {{ __($history['status']) }}
                                                                        </small>
                                                                    </div>
                                                                    <h6 class="mb-1" style="word-wrap: break-word;">
                                                                        {{ $history['note'] }}
                                                                    </h6>
                                                                    <p class="text-muted mb-0">
                                                                        {{ date('M d, Y, H:i A', strtotime($history['created_at'])) }}
                                                                    </p>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <h3>{{ __('No results were found.') }}</h3>
@endif
