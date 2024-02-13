<!-- Checkout Wizard -->
<div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mb-5">
    <div class="bs-stepper-header m-auto border-0 py-4">
        <div class="step" data-target="#checkout-cart">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-icon">
                    <svg viewBox="0 0 58 54">
                        <use xlink:href="{{ asset('assets/svg/icons/wizard-checkout-cart.svg#wizardCart') }}"></use>
                    </svg>
                </span>
                <span class="bs-stepper-label">{{ __('Cart') }}</span>
            </button>
        </div>
        <div class="line">
            <i class="ti ti-chevron-right"></i>
        </div>

        <div class="step" data-target="#checkout-payment">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-icon">
                    <svg viewBox="0 0 58 54">
                        <use xlink:href="{{ asset('assets/svg/icons/wizard-checkout-payment.svg#wizardPayment') }}">
                        </use>
                    </svg>
                </span>
                <span class="bs-stepper-label">{{ __('Payment') }}</span>
            </button>
        </div>

    </div>
    <div class="bs-stepper-content border-top">
        <form id="wizard-checkout-form" action="{{ route('shipmentOnline.store') }}" method="POST"
            onsubmit="return false">
            <!-- Cart -->
            <div id="checkout-cart" class="content">
                <div class="row">
                    <!-- Cart left -->
                    <div class="col-xl-8 mb-3 mb-xl-0">
                        <!-- Shopping bag -->
                        <h5>My Shopping Bag ({{ count($items) }})</h5>
                        <ul class="list-group mb-3">
                            @foreach ($items as $item)
                                <li class="list-group-item p-4">
                                    <div class="d-flex gap-3">
                                        <div class="flex-shrink-0 d-flex align-items-center">
                                            <img src="{{ asset('assets/img/products/1.png') }}" alt="google home"
                                                class="w-px-100">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="me-3"><a href="javascript:void(0)"
                                                            class="text-body">{{ $item['name'] }}</a></p>
                                                    <small>{{ $item['description'] }}</small>
                                                    <div class="text-muted mb-2 d-flex flex-wrap"><span
                                                            class="me-1">{{ $item['category'] }}:</span> <a
                                                            href="javascript:void(0)"
                                                            class="me-3">{{ __('Category') }}</a> </div>
                                                    <!-- <div class="read-only-ratings mb-3" data-rateyo-read-only="true"></div> -->
                                                    <div class=" mb-2 d-flex flex-wrap">
                                                        <span class="me-1">{{ $item['quantity'] }}:</span>
                                                        <a href="javascript:void(0)"
                                                            class="me-3">{{ __('Quantity') }}
                                                        </a>
                                                    </div>

                                                    <!-- <span class="badge bg-label-success">In Stock</span> -->
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="text-md-end">
                                                        <!-- <button type="button" class="btn-close btn-pinned" aria-label="Close"></button> -->
                                                        <div class="my-2 my-md-4 mb-md-5"><span
                                                                class="text-primary">{{ __('LYD') }}
                                                                {{ $item['price'] }}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>

                    <!-- Cart right -->
                    <div class="col-xl-4">
                        <div class="border rounded p-4 mb-3 pb-3">

                            <!-- Coupon -->
                            <h6>{{ __('Coupon Discount') }}</h6>
                            <div class="row g-3 mb-3">
                                <div class="col-8 col-xxl-8 col-xl-12">
                                    <input type="text" name="couponCode" class="form-control"
                                        placeholder="{{ __('Enter Coupon Code') }}" aria-label="Enter Coupon Code">
                                </div>
                                <div class="col-4 col-xxl-4 col-xl-12">
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-label-primary"
                                            id="applyCoupon">{{ __('Apply') }}</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Gift wrap -->

                            <hr class="mx-n4">

                            <!-- Price Details -->
                            <h6>{{ __('Price Details') }}</h6>
                            <dl class="row mb-0">

                                <dt class="col-6 fw-normal text-heading">{{ __('Order Total') }}</dt>
                                <dd class="col-6 text-end">{{ $totalItemsPrice }} {{ __('LYD') }} </dd>

                                <dt class="col-6 fw-normal text-heading">{{ __('Delivery Charges') }}</dt>
                                <dd class="col-6 text-end">
                                    <span class="deliveryCost">{{ $deliveryCharges }} {{ __('LYD') }} </span>
                                    <span class="deliveryAfterDiscount"></span>
                                </dd>
                            </dl>

                            <hr class="mx-n4">
                            <dl class="row mb-0">
                                <dt class="col-6 text-heading">{{ __('Total') }}</dt>
                                <dd class="col-6 fw-medium text-end text-heading mb-0 totalAmount">
                                    {{ $totalItemsPrice + $deliveryCharges }} {{ __('LYD') }} </dd>
                            </dl>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-next">{{ __('Place Order') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment -->
            <div id="checkout-payment" class="content">
                <div class="row">
                    <!-- Payment left -->
                    <div class="col-xl-6 col-xxl-8 mb-3 mb-xl-0">
                        <!-- Offer alert -->
                        <div class="row py-4 my-2">
                            <h5>{{ __('Payment Method') }}</h5>
                            <div class="col-xl-10 mb-md-0 mb-2">
                                <div class="form-check custom-option custom-option-basic checked">
                                    <label
                                        class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                        for="cashRadio">
                                        <input name="paymentMethod" class="form-check-input" type="radio"
                                            value="cash" id="cashRadio" checked />
                                        <span class="custom-option-body d-flex align-items-center">
                                            <img src="{{ asset('assets/img/backgrounds/cash_dollar.svg') }}"
                                                alt="cash" width="58">
                                            <span class="ms-3 h6 m-0">{{ __('Cash On Delivery') }}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-basic">
                  <label class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center" for="cashBalanceRadio">
                    <input name="paymentMethod" class="form-check-input" type="radio" value="cashBalance" id="cashBalanceRadio" />
                    <span class="custom-option-body">
                      <span class="ms-3">{{ __('Cash Balance') }}</span>
                    </span>
                  </label>
                </div>
              </div> -->
                        </div>
                        <div class="row py-4 my-2">
                            <h5>{{ __('Delivery Method') }}</h5>
                            <div class="col-md col-xl-5 mb-md-0 mb-2">
                                <div class="form-check custom-option custom-option-basic checked">
                                    <label
                                        class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                        for="toDoorRadio">
                                        <input name="deliveryMethod" class="form-check-input" type="radio"
                                            value="toDoor" id="toDoorRadio" checked />
                                        <span class="custom-option-body">
                                            <span class="ms-3">{{ __('Door-to-Door') }}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md col-xl-5 mb-md-0 mb-2">
                                <div class="form-check custom-option custom-option-basic">
                                    <label
                                        class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                        for="pickupRadio">
                                        <input name="deliveryMethod" class="form-check-input" type="radio"
                                            value="pickup" id="pickupRadio" />
                                        <span class="custom-option-body">
                                            <span class="ms-3">{{ __('In-Store Pickup') }}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-12">
                                <button type="submit"
                                    class="btn btn-primary me-sm-3 me-1 waves-effect waves-light btn-submit">{{ __('Submit') }}</button>
                                <button type="reset"
                                    class="btn btn-label-secondary waves-effect btn-prev">{{ __('Go Back') }}</button>
                            </div>
                        </div>

                    </div>

                    <!-- Address right -->
                    <div class="col-xl-6 col-xxl-4">
                        <div class="border rounded p-4">

                            <!-- Price Details -->
                            <h6>{{ __('Price Details') }}</h6>
                            <dl class="row">

                                <dt class="col-6 fw-normal text-heading">{{ __('Order Total') }}</dt>
                                <dd class="col-6 text-end">{{ $totalItemsPrice }} {{ __('LYD') }} </dd>

                                <dt class="col-6 fw-normal text-heading">{{ __('Delivery Charges') }}</dt>
                                <dd class="col-6 text-end">
                                    <span class="deliveryCost">{{ $deliveryCharges }} {{ __('LYD') }} </span>
                                    <span class="deliveryAfterDiscount"></span>
                                </dd>
                            </dl>
                            <hr class="mx-n4">
                            <dl class="row">
                                <dt class="col-6 text-heading mb-3">{{ __('Total') }}</dt>
                                <dd class="col-6 fw-medium text-end mb-0 totalAmount">
                                    {{ $totalItemsPrice + $deliveryCharges }} {{ __('LYD') }} </dd>

                                <dt class="col-6 fw-normal text-heading">{{ __('Deliver to') }}:</dt>
                                <dd class="col-6 fw-medium text-end mb-0"><span
                                        class="badge bg-label-primary">{{ __('Home') }}</span></dd>
                            </dl>
                            <!-- Address Details -->
                            <address class="text-heading">
                                <span>{{ $receiverFullName }},</span><br />
                                {{ $shippingAddress }}. <br />
                                <br />
                                {{ __('Mobile') }} : {{ $receiverPhoneNumber }}
                                <input type="hidden" name="phone" value="{{ $receiverPhoneNumber }}">
                            </address>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>
</div>
<!--/ Checkout Wizard -->
