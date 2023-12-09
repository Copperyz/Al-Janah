<!-- Edit Inventory Modal -->
<div class="modal fade" id="editInventoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{__('Edit inventory')}}</h3>
                    <p class="text-muted">{{__('Edit inventory name and branch')}}</p>
                </div>

                <form id="editInventoryForm" class="row">
                    <div class="col-sm-12">
                        <label class="form-label" for="name">{{__('Description')}}</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="{{__('Description')}}" tabindex="-1" />
                        <input type="hidden" name="id" id="id">
                    </div>
                    <div class="col-sm-12">

                        <label class="form-label" for="inventory-branch">{{__('Address')}}</label>
                        <select id="inventory-branch" required class="select2 form-select" name="branchID"
                            data-placeholder="Select inventory branch">
                            <option value=''>{{__('Select')}}</option>
                            @foreach ($branches as $branch)
                            <option value='{{$branch->id}}'>{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3 mb-12">
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
<!--/ Edit Inventory Modal -->