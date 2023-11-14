<!-- Edit Permission Modal -->
<div class="modal fade" id="editPermissionModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{__('Edit Permission')}}</h3>
                    <p class="text-muted">{{__('Edit permission as per your requirements.')}}</p>
                </div>
                <div class="alert alert-warning" role="alert">
                    <h6 class="alert-heading mb-2">{{__('Warning')}}</h6>
                    <p class="mb-0">
                        {{__("By editing the permission name, you might break the system permissions functionality. Please ensure you're absolutely certain before proceeding.")}}
                    </p>
                </div>
                <form id="editPermissionForm" class="row" onsubmit="return false">
                    <div class="col-sm-9">
                        <label class="form-label" for="name">{{__('Name')}}</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="{{__('Enter a permission name')}}" tabindex="-1" />
                    </div>
                    <div class="col-sm-3 mb-3">
                        <input type="hidden" name="id" id="id">
                        <label class="form-label invisible d-none d-sm-inline-block">Button</label>
                        <button type="submit" class="btn btn-primary mt-1 mt-sm-0">{{__('Submit')}}</button>
                    </div>
                    <!-- <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="editCorePermission" />
                            <label class="form-check-label" for="editCorePermission">
                                Set as core permission
                            </label>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Edit Permission Modal -->