<!-- Add Cash Modal -->
<div class="modal fade" id="addCashModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">{{__('Add Cash Balance')}}</h3>
                    <!-- <p class="text-muted">{{__('Set role permissions')}}</p> -->
                </div>
                <!-- Add cash form -->
                <form id="addCashForm" class="row g-3" action="{{ route('customer.add-cash', $customer->id) }}" method="POST">
                    <div class="col-12 mb-4">
                        <label class="form-label" for="balance">{{__('Cash Balance Value')}}</label>
                            <input type="text" id="balance" name="balance" class="form-control numeral-mask" placeholder='{{ __("Enter the value") }}' />
                            <div id="floatingInputHelp" class="form-text">{{__("Enter cash balance in dollar")}}.</div>
                    </div>
                    <div class="alert alert-warning" role="alert">
                    <h6 class="alert-heading mb-2">{{__('Note')}}</h6>
                    <p class="mb-0">
                        {{__("The customer will be notified of the added balance value. Please check the balance value before clicking the Submit button")}}
                    </p>
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
<script>

</script>
<!--/ Add Role Modal -->