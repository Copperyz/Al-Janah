<!-- Add New Price Modal -->
<div class="modal fade" id="addPriceModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title mb-2">{{__('Add Price')}}</h3>
                    <!-- <p class="text-muted address-subtitle">{{__('Add defined legs for the route')}}</p> -->
                </div>
                <form id="addPriceForm" onsubmit="return false" action="{{ route('prices.store') }}" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-3">
                            <label for="from_country_id" class="form-label me-4 fw-medium">{{__('From')}}</label>
                            <select id="from_country_id" class="select2 form-select form-select-lg"
                                data-allow-clear="true" name="from_country_id">
                                <option disabled selected>{{__('Select')}}</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{__($country->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3 mb-3">
                            <label for="to_country_id" class="form-label me-4 fw-medium">{{__('To')}}</label>
                            <select id="to_country_id" class="select2 form-select form-select-lg"
                                data-allow-clear="true" name="to_country_id">
                                <option disabled selected>{{__('Select')}}</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{__($country->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-3">
                            <label for="parcel_types_id" class="form-label me-4 fw-medium">{{__('Parcel Type')}}</label>
                            <select id="parcel_types_id" class="select2 form-select" data-allow-clear="true"
                                name="parcel_types_id">
                                <option disabled selected>{{__('Select')}}</option>
                                @foreach($parcelTypes as $parcelType)
                                <option value="{{$parcelType->id}}">{{$parcelType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3 mb-3">
                            <label for="to_country_id" class="form-label me-4 fw-medium">{{__('Good Type')}}</label>
                            <select id="good_types_id" class="select2 form-select" data-allow-clear="true"
                                name="good_types_id">
                                <option disabled selected>{{__('Select')}}</option>
                                @foreach($goodTypes as $goodType)
                                <option value="{{$goodType->id}}">{{$goodType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12 mb-3">
                            <label class="form-label" for="price">{{__('Price')}}</label>
                            <input type="number" id="price" name="price" class="form-control"
                                placeholder="{{__('Price')}}" required />
                        </div>
                    </div>
                    <div class="col-12 text-center">
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