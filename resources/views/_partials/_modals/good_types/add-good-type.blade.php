<!-- Add City Modal -->
<div class="modal fade" id="addGoodTypeModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-GoodType">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">{{ __('Add Good Type') }}</h3>
                </div>
                <!-- Add cash form -->
                <form id="addGoodTypeForm" class="row g-3" action="{{ route('good_types.store') }}" method="POST">
                    <div class="col-md-12">
                        <label for="addGoodType" class="form-label me-4 fw-medium">{{ __('Good Type') }}</label>
                        <input type="text" id="name" name="name" class="form-control" autocomplete="off"
                            placeholder="{{ __('Enter Good Type') }}" />
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
