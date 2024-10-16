<!-- Add Country Modal -->
<div class="modal fade" id="addCountryModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-country">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">{{ __('Add New Country') }}</h3>
                    <!-- <p class="text-muted">{{ __('Set role permissions') }}</p> -->
                </div>
                <!-- Add cash form -->
                <form id="addCountryForm" class="row g-3" action="{{ route('countries.store') }}" method="POST">
                    <label for="addCountry" class="form-label me-4 fw-medium">{{ __('Country') }}</label>
                    <select id="addCountry" class="select2 form-select" data-allow-clear="true" name="country">
                        <option disabled selected>{{ __('Select') }}</option>
                        @foreach ($countries as $code => $name)
                            <option value="{{ $code }}">
                              {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    <!-- <div class="alert alert-warning" role="alert">
                        <h6 class="alert-heading mb-2">{{ __('Note') }}</h6>
                        <p class="mb-0">
                            {{ __('The customer will be notified of the added balance value. Please check the balance value before clicking the Submit button') }}
                        </p>
                    </div> -->
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
<script></script>
<!--/ Add Role Modal -->
