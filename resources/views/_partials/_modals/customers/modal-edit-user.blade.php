<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Edit User Information</h3>
          <p class="text-muted">Updating user details will receive a privacy audit.</p>
        </div>
        <form id="editCustomerUserForm" action="{{route('customers.update', $customer->id)}}" class="row g-3" onsubmit="return false">
          <div class="col-12 col-md-6">
            <label class="form-label" for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" value="{{$customer->first_name}}" class="form-control" placeholder="John" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="{{$customer->last_name}}" class="form-control" placeholder="Doe" />
          </div>
          
          <div class="col-12 col-md-6">
            <label class="form-label" for="email">Email</label>
            <input type="text" id="email" name="email" value="{{$customer->email}}" class="form-control" placeholder="example@domain.com" />
          </div>
          
          <div class="col-12 col-md-6">
            <label class="form-label" for="phone">Phone Number</label>
            <div class="input-group">
              <input type="text" id="phone" name="phone" value="{{$customer->phone}}" class="form-control phone-number-mask" placeholder="202 555 0111" />
            </div>
          </div>
<!--           
          <div class="col-12 col-md-6">
            <label class="form-label" for="country">Country</label>
            <select id="country" class="select2 form-select" data-allow-clear="true" name="country">
                        <option disabled selected>{{ __('Select') }}</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">
                              {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="city">City</label>
            <select id="city" class="select2 form-select" data-allow-clear="true" name="city">
                        <option disabled selected>{{ __('Select') }}</option>
                        
                    </select>
          </div> -->
          
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ Edit User Modal -->
