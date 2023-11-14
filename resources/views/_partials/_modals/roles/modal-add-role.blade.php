<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">{{__('Add Role')}}</h3>
                    <p class="text-muted">{{__('Set role permissions')}}</p>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm" class="row g-3" action="{{ route('roles.store') }}" method="POST">
                    <div class="col-12 mb-4">
                        <label class="form-label" for="name">{{__('Role Name')}}</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder='{{ __("Enter a role name") }}' tabindex="-1" />
                    </div>
                    <div class="col-12">
                        <h5>{{__('Role Permissions')}}</h5>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-medium">{{__('Administrator Access ')}}<i
                                                class="ti ti-info-circle" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Allows a full access to the system"></i>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll" />
                                                <label class="form-check-label" for="selectAll">
                                                    {{__('Select All')}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach($permissions as $permission)
                                    <tr>
                                        <td class="text-nowrap fw-medium">{{$permission->name}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="permission_{{$permission->id}}"
                                                        name="permission[{{$permission->name}}]" value="1" />
                                                    <label class="form-check-label"
                                                        for="permission_{{$permission->id}}">
                                                        {{__('Access')}}
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">{{__('Submit')}}</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">{{__('Cancel')}}</button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
<!--/ Add Role Modal -->