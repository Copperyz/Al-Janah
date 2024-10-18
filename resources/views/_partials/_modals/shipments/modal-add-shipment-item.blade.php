<!-- Edit User Modal -->
<div class="modal fade" id="addShipmentItemModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-order-item">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('Add Item') }}</h3>
                </div>
                <form id="addShipmentItemForm" class="row g-3" onsubmit="return false">
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{ __('Good Type') }}
                            <span class="text-danger">*</span>
                        </label>
                        <select id="good_types_id" class="select2 form-select" data-allow-clear="true"
                            name="good_types_id">
                            <option disabled selected>{{ __('Select') }}</option>
                            @foreach ($goodTypes as $goodType)
                                <option value="{{ $goodType->id }}">{{ $goodType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{ __('Parcel Type') }}

                            <span class="text-danger">*</span></label>
                        <select id="parcel_types_id_add" class="select2 form-select" data-allow-clear="true"
                            name="parcel_types_id">
                            <option disabled selected>{{ __('Select') }}</option>
                            @foreach ($parcelTypes as $parcelType)
                                <option value="{{ $parcelType->id }}">{{ $parcelType->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="trip_route_id" class="form-label me-4 fw-medium">{{ __('Trip Route') }}
                            <span class="text-danger">*</span>
                        </label>
                        <select id="trip_route_id_add" class="select2 form-select form-select-lg"
                            data-allow-clear="true" name="trip_route_id">
                            <option disabled selected>{{ __('Select') }}</option>
                            @foreach ($tripRoutes as $tripRoute)
                                <option value="{{ $tripRoute->id }}">{{ __($tripRoute->legs_combined) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{ __('Quantity') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input name="quantity" type="number" class="form-control invoice-item-price mb-3"
                            placeholder="{{ __('Quantity') }}" min="0" autocomplete="off" value="1" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{ __('Weight') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input name="weight" type="number" class="form-control invoice-item-price mb-3"
                            placeholder="{{ __('Weight') }}" min="0" autocomplete="off" />
                    </div>
                    <div class="col-12 col-md-6" style="display: none">
                        <label class="form-label">{{ __('Height') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input name="height" type="number" class="form-control invoice-item-price mb-3"
                            placeholder="{{ __('Height') }}" min="0" autocomplete="off" value="0.00" />
                        </select>
                    </div>
                    <div class="col-12 col-md-6" style="display: none">
                        <label class="form-label">{{ __('Width') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input name="width" type="number" class="form-control invoice-item-price mb-3"
                            placeholder="{{ __('Width') }}" min="0" autocomplete="off" value="0.00" />
                    </div>
                    <div class="col-12 col-md-6" style="display: none">
                        <label class="form-label">{{ __('Length') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input name="length" type="number" class="form-control invoice-item-price mb-3"
                            placeholder="{{ __('Length') }}" min="0" autocomplete="off" value="0.00" />
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-4">
                            <label class="form-label">{{ __('Freight cost') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input name="price" type="number" class="form-control invoice-item-price mb-3"
                                placeholder="{{ __('Price') }}" min="0" readonly required />
                        </div>
                        <div class="col-md-5">
                            <button type="button" class="btn btn-primary calculate-price-btn_add mt-4">
                                {{ __('Calculate Price') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Submit') }}</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">{{ __('Cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Edit User Modal -->
