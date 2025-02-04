<!-- Add Permission Modal -->
<div class="modal fade" id="addPermissionModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{__('Add Permission')}}</h3>
                    <p class="text-muted">{{__('Permissions you may use and assign to your users.')}}</p>
                </div>
                <form id="addPermissionForm" class="row" onsubmit="return false"
                    action="{{ route('permissions.store') }}" method="POST">
                    <div class="col-12 mb-3">
                        <label class="form-label" for="name">{{__('Name')}}</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="{{__('Enter a permission name')}}" autofocus autocomplete="off"/>
                    </div>
                    <!-- <div class="col-12 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="corePermission" />
                            <label class="form-check-label" for="corePermission">
                                Set as core permission
                            </label>
                        </div>
                    </div> -->
                    <div class="col-12 text-center demo-vertical-spacing">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">{{__('Submit')}}</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">{{__('Cancel')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->