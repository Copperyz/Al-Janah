<div class="modal fade" id="showTripShipmentModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="showTripShipmentTitle">{{__('Shipments')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- trips List Table -->
                <div class="card-datatable dataTable_select text-nowrap">
                    <table class="shipment-list-table dt-select-table table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>{{__('Customer')}}</th>
                                <th>{{__('Date')}}</th>
                                <th class="text-truncate">{{__('Amount')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <hr>
            <div class="modal-footer">
                <input type="hidden" name="id" id="id">
                <button type="button" class="btn btn-primary">{{__('Submit')}}</button>
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>