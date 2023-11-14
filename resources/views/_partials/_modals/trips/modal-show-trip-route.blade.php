<!-- Add New Address Modal -->
<div class="modal fade" id="showTripRouteModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title mb-2">{{__('Show Trip Route')}}</h3>
                    <p class="text-muted address-subtitle">
                        {{__('Explore the details and information of the trip route')}}</p>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div id="timelineContainer" class="timeline ms-1 mb-0"></div>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="reset" class="btn btn-label-info" data-bs-dismiss="modal"
                    aria-label="Close">{{__('Done')}}</button>
            </div>
        </div>
    </div>
</div>
</div>
<!--/ Add New Address Modal -->