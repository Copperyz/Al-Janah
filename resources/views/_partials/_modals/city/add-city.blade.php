<!-- Add City Modal -->
<div class="modal fade" id="addCityModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-city">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">{{ __('Add New City') }}</h3>
                    <!-- <p class="text-muted">{{ __('Set role permissions') }}</p> -->
                </div>
                <!-- Add cash form -->
                <form id="addCityForm" class="row g-3" action="{{ route('cities.store') }}" method="POST">
                    <div class="col-md-6">
                        <label for="addCity" class="form-label me-4 fw-medium">{{ __('City') }}</label>
                        <select id="addCity" class="select2 form-select" data-allow-clear="true" name="city">
                            <option disabled selected>{{ __('Select') }}</option>
                            @foreach ($cities as $code => $name)
                                <option value="{{ $name }}"><i
                                        class="fis fi fi-{{ $code }} rounded-circle me-2 fs-3"></i>
                                    {{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="addCountry" class="form-label me-4 fw-medium">{{ __('Country') }}</label>
                        <select id="addCountry" class="select2 form-select" data-allow-clear="true" name="country">
                            <option disabled selected>{{ __('Select') }}</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"><i
                                        class="fis fi fi-{{ $country->country_code }} rounded-circle me-2 fs-3"></i>
                                    {{ $country->name }}</option>
                            @endforeach
                        </select>
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
