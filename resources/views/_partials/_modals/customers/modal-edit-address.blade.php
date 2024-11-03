<!-- Add New Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="address-title mb-2">{{__('Edit Address')}}</h3>
          <!-- <p class="text-muted address-subtitle">Add new address for express delivery</p> -->
        </div>
        <form id="addNewAddressForm" method="POST" action="{{route('customer.address.store')}}" class="row g-3" onsubmit="return false">

          <div class="col-12 ">
            <label class="form-label" for="address_type">{{__('Address Type')}}</label>
            <input type="text" id="address_type" name="address_type" class="form-control" placeholder="Home, Office, Shipping" />
          </div>
          <div class="col-12">
            <label class="form-label" for="address_line">{{__('Address Line')}}</label>
            <input type="text" id="address_line" name="address_line" class="form-control" placeholder="12, Business Park"" />
          </div>
                    
          <div class="col-12 col-md-6">
            <label class="form-label" for="country">{{__('Country')}}</label>
              <select id="countrySelect" class="select2 form-select" data-allow-clear="true" name="country">
                  <option disabled selected>{{ __('Select') }}</option>
                    @foreach ($countries as $country)
                      <option value="{{ $country->id }}">
                        {{ $country->name }}
                      </option>
                    @endforeach
              </select>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="city">{{__('City')}}</label>
            <select id="city" class="select2 form-select" data-allow-clear="true" name="city">
                <option disabled selected>{{ __('Select') }}</option>       
            </select>
          </div>
          
          <div class="col-12">
            <label class="switch">
              <input type="checkbox" class="switch-input" name="address_switch">
              <span class="switch-toggle-slider">
                <span class="switch-on"></span>
                <span class="switch-off"></span>
              </span>
              <span class="switch-label">{{__('Use as a billing address')}}?</span>
            </label>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">{{__('Submit')}}</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">{{__('Cancel')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ Add New Address Modal -->
