<!-- Edit User Modal -->
<div class="modal fade" id="editOrderItemModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-order-item">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{__('Edit Item')}}</h3>
                </div>
                <form id="editOrderItemForm" class="row g-3" onsubmit="return false">
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('Good Type')}}</label>
                        <select id="good_types_id_edit" class="select2 form-select" data-allow-clear="true"
                            name="good_types_id">
                            <option>{{__('Select')}}</option>
                            @foreach($goodTypes as $goodType)
                            <option value="{{$goodType->id}}">{{$goodType->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('Parcel Type')}}</label>
                        <select id="parcel_types_id_edit" class="select2 form-select" data-allow-clear="true"
                            name="parcel_types_id">
                            <option>{{__('Select')}}</option>
                            @foreach($parcelTypes as $parcelType)
                            <option value="{{$parcelType->id}}">{{$parcelType->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('Price')}}</label>
                        <input name="price" type="number" class="form-control invoice-item-price mb-3"
                            placeholder="{{__('Price')}}" min="0" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('Height')}}</label>
                        <input name="height" type="number" class="form-control invoice-item-price mb-3"
                            placeholder="{{__('Height')}}" min="0" />
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('Width')}}</label>
                        <input name="width" type="number" class="form-control invoice-item-price mb-3"
                            placeholder="{{__('Width')}}" min="0" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('Weight')}}</label>
                        <input name="weight" type="number" class="form-control invoice-item-price mb-3"
                            placeholder="{{__('Weight')}}" min="0" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{__('Quantity')}}</label>
                        <input name="quantity" type="number" class="form-control invoice-item-price mb-3"
                            placeholder="{{__('Quantity')}}" min="0" />
                    </div>
                    <div class="col-12 text-center">
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">{{__('Submit')}}</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">{{__('Cancel')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Edit User Modal -->