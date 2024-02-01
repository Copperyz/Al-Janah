<!-- Edit User Modal -->
<div class="modal fade" id="addPaymentModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">{{__('Add Payment')}}</h3>
          <!-- <p class="text-muted">Updating user details will receive a privacy audit.</p> -->
        </div>
      <div class="row">
        
        <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
            <p class="mb-0">{{__('Freight cost')}}:</p>
            <p class="fw-medium mb-0">{{$shipment->shipmentPrice}} {{__('LYD')}}</p>
        </div>
        <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
            <p class="mb-0">{{__('Packages cost')}}:</p>
            <p class="fw-medium mb-0">{{$shipment->amount}} {{__('LYD')}}</p>
        </div>
        <form id="addPaymentForm" class="g-3" action="{{ route('payments.store') }}" method="POST">
            <div class="mb-3">
                <label class="form-label" for="invoiceAmount">{{__('Total Amount')}}</label>
                <div class="input-group">
                    <span class="input-group-text">{{__('LYD')}}</span>
                    <input type="text" id="invoiceAmount" name="invoiceAmount" class="form-control invoice-amount"
                        placeholder="{{$shipment->amount + $shipment->shipmentPrice}}"
                        value="{{$shipment->amount + $shipment->shipmentPrice}}" disabled />
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="payment-date">{{__('Payment Date')}}</label>
                <input id="payment-date" name="date" class="form-control invoice-date" type="text" />
            </div>
            
            <div class="row py-4 my-2">
            <div class="col-md mb-md-0 mb-2">
              <div class="form-check custom-option custom-option-basic checked">
                <label class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center" for="cashRadio">
                  <input name="paymentMethod" class="form-check-input" type="radio" value="cash" id="cashRadio" checked />
                  <span class="custom-option-body">
                    <!-- <img src="{{ asset('assets/img/icons/payments/visa-'.$configData['style'].'.png') }}" alt="visa-card" width="58" data-app-light-img="icons/payments/visa-light.png" data-app-dark-img="icons/payments/visa-dark.png"> -->
                    <span class="ms-3">{{__('Cash')}}</span>
                  </span>
                </label>
              </div>
            </div>
            <div class="col-md mb-md-0 mb-2">
              <div class="form-check custom-option custom-option-basic">
                <label class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center" for="cashBalanceRadio">
                  <input name="paymentMethod" class="form-check-input" type="radio" value="cashBalance" id="cashBalanceRadio" />
                  <span class="custom-option-body">
                    <!-- <img src="{{ asset('assets/img/icons/payments/paypal-'.$configData['style'].'.png') }}" alt="paypal" width="58" data-app-light-img="icons/payments/paypal-light.png" data-app-dark-img="icons/payments/paypal-dark.png"> -->
                    <span class="ms-3">{{__('Cash Balance')}}</span>
                  </span>
                </label>
              </div>
            </div>
          </div>
            <input type="hidden" name="shipment_amount" value="{{$shipment->shipmentPrice}}">
            <input type="hidden" name="order_amount" value="{{$shipment->amount}}">
            <input type="hidden" name="shipment_id" value="{{$shipment->id}}">
        
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary me-3">{{__('Submit')}}</button>
                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">{{__('Cancel')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ Edit User Modal -->
