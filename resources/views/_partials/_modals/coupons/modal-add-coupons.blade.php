<!-- Add Coupon Modal -->
<div class="modal fade" id="addCouponModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">{{__('Add Coupon')}}</h3>
                    <!-- <p class="text-muted">{{__('Set role permissions')}}</p> -->
                </div>
                <!-- Add cash form -->
                <form id="addCouponForm" class="row g-3" action="{{ route('customer.add-coupon', $customer->id) }}" method="POST">
                    <div class="col-6 mb-4">
                        <label class="form-label" for="coupon">{{__('Coupon Value')}}</label>
                        <input type="number" id="coupon" name="coupon" value="1" class="form-control" placeholder='{{ __("Enter the value") }}' min="1" max="100" />
                        <div id="floatingInputHelp" class="form-text">{{__("Enter coupon value in dollar")}}.</div>

                    </div>
                    <div class="col-6 mb-4">
                        <label for="html5-datetime-local-input" class="form-label me-4 fw-medium">{{__('Coupon Expiration Date')}}</label>
                        <input class="form-control date-picker" id="datePicker" placeholder="{{__('Enter date')}}" name="expired_date" />
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <h6 class="alert-heading mb-2">{{__('Note')}}</h6>
                        <p class="mb-0">
                            {{__("The customer will be notified of the added coupons value. Please check the coupons value before clicking the Submit button")}}
                        </p>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">{{__('Submit')}}</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">{{__('Cancel')}}</button>
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