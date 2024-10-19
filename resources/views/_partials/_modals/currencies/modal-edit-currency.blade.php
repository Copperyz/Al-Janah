<div class="modal fade" id="editCurrencyModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-simple modal-edit-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title mb-2">{{ __('Edit Currency') }}</h3>
                    <!-- <p class="text-muted address-subtitle">{{ __('Add defined legs for the route') }}</p> -->
                </div>
                <form id="editCurrencyForm" onsubmit="return false">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-3">
                            <label for="from_country_id" class="form-label me-4 fw-medium">{{ __('Name') }}</label>
                            <input name="name" type="text" class="form-control mb-3"
                                placeholder="{{ __('Name') }}" autocomplete="off" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="symbol" class="form-label me-4 fw-medium">{{ __('Symbol') }}</label>
                            <input name="symbol" type="text" class="form-control mb-3"
                                placeholder="{{ __('Symbol') }}" maxlength="3" autocomplete="off" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-3">
                            <label class="form-label" for="valueInUsd">{{ __('Value in USD') }}</label>
                            <input type="text" pattern="[0-9]*[.,]?[0-9]+" id="valueInUsd" name="valueInUsd"
                                class="form-control" placeholder="{{ __('Value in USD') }}" required
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Submit') }}</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">{{ __('Cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
