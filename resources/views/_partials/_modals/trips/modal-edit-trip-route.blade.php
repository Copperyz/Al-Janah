<!-- Add New Address Modal -->
<div class="modal fade" id="editTripRouteModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title mb-2">{{__('Edit Trip Route')}}</h3>
                    <p class="text-muted address-subtitle">{{__('Edit defined legs for the route')}}</p>
                </div>
                <form class="form-repeater" id="editTripRouteForm" onsubmit="return false">
                    <div class="col-12 mb-3">
                        <div class="row">
                            <h5 class="mb-2">{{__('Type')}}</h5>
                            <div class="col-md mb-md-0 mb-3">
                                <div class="form-check custom-option custom-option-icon">
                                    <label class="form-check-label custom-option-content" for="Air">
                                        <span class="custom-option-body">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-plane-inflight" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M15 11.085h5a2 2 0 1 1 0 4h-15l-3 -6h3l2 2h3l-2 -7h3l4 7z">
                                                </path>
                                                <path d="M3 21h18"></path>
                                            </svg>
                                            <span class="custom-option-title">{{__('Air')}}</span>
                                            <!-- <small> Delivery time (9am – 9pm) </small> -->
                                        </span>
                                        <input name="type" class="form-check-input" type="radio" value="Air" id="Air" />
                                    </label>
                                </div>
                            </div>
                            <div class="col-md mb-md-0 mb-3">
                                <div class="form-check custom-option custom-option-icon">
                                    <label class="form-check-label custom-option-content" for="Sea">
                                        <span class="custom-option-body">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-ship" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M2 20a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1">
                                                </path>
                                                <path d="M4 18l-1 -5h18l-2 4"></path>
                                                <path d="M5 13v-6h8l4 6"></path>
                                                <path d="M7 7v-4h-1"></path>
                                            </svg>
                                            <span class="custom-option-title">{{__('Sea')}}</span>
                                            <!-- <small> Delivery time (9am – 5pm) </small> -->
                                        </span>
                                        <input name="type" class="form-check-input" type="radio" value="Sea" id="Sea" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="mb-2">{{__('Legs')}}</h5>
                    <div id="legsContainer">
                        <!-- Container for legs -->
                    </div>

                    <button class="btn btn-primary" id="addLegButton">
                        <i class="ti ti-plus me-1"></i>
                        <span class="align-middle">{{__('Add')}}</span>
                    </button>
                    <hr>
                    <div class="mb-3 col-12 mb-3">
                        <label class="form-label" for="form-repeater-1-3">{{__('Trip Price')}}</label>
                        <input type="number" id="trip_price" name="trip_price" class="form-control"
                            placeholder="{{__('Trip Price')}}" required />
                    </div>
                    <div class="col-12 text-center">
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">{{__('Submit')}}</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">{{__('Cancel')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add New Address Modal -->