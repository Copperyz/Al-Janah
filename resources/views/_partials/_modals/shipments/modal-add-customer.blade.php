<!-- Edit User Modal -->
<div class="modal fade" id="addCustomerModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-customer">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{__('Add Customer')}}</h3>
                </div>
                <form id="addCustomerForm" class="row g-3" onsubmit="return false"
                    action="{{ route('customers.store') }}" method="POST">
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('First Name')}}</label>
                        <input name="first_name" type="text" class="form-control mb-3"
                            placeholder="{{__('First Name')}}" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('Last Name')}}</label>
                        <input name="last_name" type="text" class="form-control mb-3"
                            placeholder="{{__('Last Name')}}" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('Email')}}</label>
                        <input name="email" type="email" class="form-control mb-3" placeholder="{{__('Email')}}" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('Phone')}}</label>
                        <input name="phone" type="text" class="form-control mb-3" placeholder="{{__('Phone')}}" />
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{__('Address')}}</label>
                        <textarea name="address" class="form-control mb-3" placeholder="{{__('Address')}}"></textarea>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('Country')}}</label>
                        <select id="country_id" class="select2 form-select" data-allow-clear="true" name="country_id">
                            <option disabled selected>{{__('Select')}}</option>
                            @foreach($countries as $country)
                            <option value="{{$country->id}}">{{__($country->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('City')}}</label>
                        <select id="city_id" class="select2 form-select" data-allow-clear="true" name="city_id">
                            <option disabled selected>{{__('Select')}}</option>
                            @foreach($cities as $city)
                            <option value="{{$city->id}}">{{__($city->name)}}</option>
                            @endforeach
                        </select>
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
<!--/ Edit User Modal -->