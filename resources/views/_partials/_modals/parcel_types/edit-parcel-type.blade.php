<!-- Edit Role Modal -->
<div class="modal fade" id="editParcelTypeModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-ParcelType">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">{{ __('Edit Parcel Type') }}</h3>
                </div>
                <!-- Edit role form -->
                <form id="editParcelTypeForm" class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label" for="name">{{ __('Parcel Type') }}</label>
                        <input type="text" id="edit_name" name="name" class="form-control" autocomplete="off"
                            placeholder="{{ __('Enter Parcel Type') }}" tabindex="-1" />
                    </div>
                    <div class="col-12 text-center mt-4">
                        <input type="hidden" name="id" id="id">
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
