<!-- Add City Modal -->
<div class="modal fade" id="addAddressModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-city">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">{{ __('Add New Address') }}</h3>
                    <!-- <p class="text-muted">{{ __('Set role permissions') }}</p> -->
                </div>
                <!-- Add cash form -->
                <form id="addAddressForm" class="row g-3" action="{{ route('addresses.store') }}" method="POST">
                    <div class="col-md-6">
                        <label for="addAddress" class="form-label me-4 fw-medium">{{ __('City') }}</label>
                        <select id="city_id" class="select2 form-select" data-allow-clear="true" name="city_id">
                            <option disabled selected>{{ __('Select') }}</option>
                            @foreach ($citiesList as $city)
                                <option value="{{ $city->id }}">
                                    {{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="addAddress" class="form-label me-4 fw-medium">{{ __('Address') }}</label>
                        <input type="text" id="name" name="name" class="form-control" autocomplete="off"
                            placeholder="{{ __('Enter address') }}" />
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Submit') }}</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">{{ __('Cancel') }}</button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
<!--/ Add Role Modal -->
