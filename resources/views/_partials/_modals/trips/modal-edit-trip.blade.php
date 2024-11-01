<!-- Add New Trip Modal -->
<div class="modal fade" id="editTripModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title mb-2">{{__('Edit Trip')}}</h3>
                    <!-- <p class="text-muted address-subtitle">{{__('Add defined legs for the route')}}</p> -->
                </div>
                <form class="form-repeater" id="editTripForm" onsubmit="return false">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="trip_route_id" class="form-label me-4 fw-medium">{{__('Trip Route')}}</label>
                            <select id="edit_trip_route_id" class="select2 form-select form-select-lg"
                                data-allow-clear="true" name="trip_route_id">
                                <option disabled selected>{{__('Select')}}</option>
                                @foreach($tripRoutes as $tripRoute)
                                <option value="{{$tripRoute->id}}">{{$tripRoute->legs_combined}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- <div class="col-md-6 mb-3">
                            <label for="current_status" class="form-label me-4 fw-medium">{{__('Status')}}</label>
                            <select id="edit_current_status" class="select2 form-select form-select-lg"
                                data-allow-clear="true" name="current_status">
                                <option disabled selected>{{__('Select')}}</option>
                                <option value="In Preparation">{{__('In Preparation')}}</option>
                                <option value="At Warehouse">{{__('At Warehouse')}}</option>
                                <option value="Enroute">{{__('Enroute')}}</option>
                                <option value="Ready to Pickup">{{__('Ready to Pickup')}}</option>

                            </select>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="html5-datetime-local-input"
                                class="form-label me-4 fw-medium">{{__('Departure Date')}}</label>
                            <input class="form-control date-picker" id="datePicker" placeholder="{{__('Enter date')}}"
                                name="departure_date" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="html5-datetime-local-input"
                                class="form-label me-4 fw-medium">{{__('Estimated Delivery Date')}}</label>
                            <input class="form-control date-picker" id="datePicker" placeholder="{{__('Enter date')}}"
                                name="estimated_delivery_date" />
                        </div>
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
<!--/ Add New Trip Modal -->