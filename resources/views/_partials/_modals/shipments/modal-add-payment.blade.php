<div class="modal fade" id="addPaymentModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('Add Payment') }}</h3>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
                        <p class="mb-0">{{ __('Freight cost') }}:</p>
                        <p class="fw-medium mb-0" id="shipmentPrice">
                            <span class="amount">{{ $shipment->shipmentPrice }}</span>
                            <span class="currency">USD</span>
                        </p>
                    </div>
                    <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
                        <p class="mb-0">{{ __('Packages cost') }}:</p>
                        <p class="fw-medium mb-0" id="packagesPrice">
                            <span class="amount">{{ $shipment->amount }}</span>
                            <span class="currency">USD</span>
                        </p>
                    </div>
                    <form id="addPaymentForm" class="g-3" action="{{ route('payments.store') }}" method="POST"
                        onsubmit="return false">
                        <div class="mb-3">
                            <label class="form-label" for="currency">{{ __('Currency') }}</label>
                            <select class="select2 form-select" id="currency" name="currency">
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->id }}" 
                                        data-rate="{{ $currency->valueInUsd }}"
                                        {{ $currency->symbol === 'USD' ? 'selected' : '' }}>
                                        {{ $currency->name }} ( {{ $currency->symbol }} )
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Temporary debug output --}}
                        <div style="display: none;">
                            @foreach($currencies as $currency)
                                <div>
                                    {{ $currency->symbol }} - Rate: {{ $currency->valueInUsd }}
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="invoiceAmount">{{ __('Total Amount') }}</label>
                            <div class="input-group" dir="ltr">
                                <span class="input-group-text currency-symbol">USD</span>
                                <input type="text" id="invoiceAmount" name="invoiceAmount"
                                    class="form-control invoice-amount {{ session()->get('locale') == 'ar' ? 'text-start' : 'text-end' }}"
                                    placeholder="{{ $shipment->amount + $shipment->shipmentPrice }}"
                                    value="{{ number_format($shipment->amount + $shipment->shipmentPrice, 2) }}"
                                    disabled />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="payment-date">{{ __('Payment Date') }}</label>
                            <input id="payment-date" name="date" class="form-control invoice-date" type="text" />
                        </div>
                        <label class="switch">
                            <input type="checkbox" class="switch-input" id="switchCoupon" />
                            <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                            </span>
                            <span class="switch-label">{{ __('Add Coupon') }}</span>
                        </label>

                        <div class="row d-none my-3" id="couponInput">
                            <div class="input-group input-group mb-3">
                                <input type="text" name="couponCode" class="form-control "
                                    placeholder="{{ __('Coupon Code') }}" aria-describedby="apply coupon">
                                <button class="btn btn-primary" type="button" id="applyCoupon">Apply</button>
                            </div>
                        </div>
                        <div class="row py-4 my-2">
                            <div class="col-md mb-md-0 mb-2">
                                <div class="form-check custom-option custom-option-basic checked">
                                    <label
                                        class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                        for="cashRadio">
                                        <input name="paymentMethod" class="form-check-input" type="radio"
                                            value="cash" id="cashRadio" checked />
                                        <span class="custom-option-body">
                                            <!-- <img src="{{ asset('assets/img/icons/payments/visa-' . $configData['style'] . '.png') }}" alt="visa-card" width="58" data-app-light-img="icons/payments/visa-light.png" data-app-dark-img="icons/payments/visa-dark.png"> -->
                                            <span class="ms-3">{{ __('Cash') }}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md mb-md-0 mb-2">
                                <div class="form-check custom-option custom-option-basic">
                                    <label
                                        class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                        for="cashBalanceRadio">
                                        <input name="paymentMethod" class="form-check-input" type="radio"
                                            value="cashBalance" id="cashBalanceRadio" />
                                        <span class="custom-option-body">
                                            <!-- <img src="{{ asset('assets/img/icons/payments/paypal-' . $configData['style'] . '.png') }}" alt="paypal" width="58" data-app-light-img="icons/payments/paypal-light.png" data-app-dark-img="icons/payments/paypal-dark.png"> -->
                                            <span class="ms-3">{{ __('Cash Balance') }}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <label class="switch switch-primary mt-4">
                                <input type="checkbox" name="fulfilled" class="switch-input" checked />
                                <span class="switch-toggle-slider">
                                    <span class="switch-on">
                                        <i class="ti ti-check"></i>
                                    </span>
                                    <span class="switch-off">
                                        <i class="ti ti-x"></i>
                                    </span>
                                </span>
                                <span class="switch-label">{{ __('Fulfilled') }}</span>
                            </label>
                        </div>
                        <input type="hidden" name="shipment_amount" value="{{ $shipment->shipmentPrice }}">
                        <input type="hidden" name="order_amount" value="{{ $shipment->amount }}">
                        <input type="hidden" name="shipment_id" value="{{ $shipment->id }}">

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-3">{{ __('Submit') }}</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">{{ __('Cancel') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Initialize Select2
    $(document).ready(function() {
        // Initialize Select2
        $('#currency').select2();

        // Store original USD values as data attributes
        const originalShipmentAmount = {{ $shipment->shipmentPrice }};
        const originalOrderAmount = {{ $shipment->amount }};
        
        $('input[name="shipment_amount"]').data('usd-amount', originalShipmentAmount);
        $('input[name="order_amount"]').data('usd-amount', originalOrderAmount);

        // Listen for both regular change and Select2 change events
        $('#currency').on('change select2:select', function() {
            const selectedOption = this.options[this.selectedIndex];
            const exchangeRate = parseFloat(selectedOption.getAttribute('data-rate')) || 1;
            const currencySymbol = selectedOption.textContent.match(/\((.*?)\)/)[1].trim();
            
            // Get original USD values from data attributes
            const shipmentUsdAmount = parseFloat($('input[name="shipment_amount"]').data('usd-amount'));
            const orderUsdAmount = parseFloat($('input[name="order_amount"]').data('usd-amount'));
            
            // Calculate converted values
            const convertedShipmentAmount = (shipmentUsdAmount * exchangeRate).toFixed(2);
            const convertedOrderAmount = (orderUsdAmount * exchangeRate).toFixed(2);
            
            // Update hidden inputs
            $('input[name="shipment_amount"]').val(convertedShipmentAmount);
            $('input[name="order_amount"]').val(convertedOrderAmount);
            
            // Update displayed amounts using specific IDs
            $('#shipmentPrice .amount').text(convertedShipmentAmount);
            $('#packagesPrice .amount').text(convertedOrderAmount);
            
            // Update currency symbols
            $('.currency').text(currencySymbol);
            $('.currency-symbol').text(currencySymbol);
        });
    });
    </script>
