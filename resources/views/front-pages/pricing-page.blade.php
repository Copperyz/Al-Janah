@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Pricing - Front Pages')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/front-page-pricing.css')}}" />
@endsection

@section('page-script')
<script src="{{asset('assets/js/front-page-pricing.js')}}"></script>
@endsection


@section('content')

<style>
#section1,
#section2,
#section3 {
    padding: 2em 0;
}

#section2 {
    background: #aaa !important;
}

.parcel-type-option {
    padding: 3em 0;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
        /* Move section up */
    }

    to {
        opacity: 1;
        transform: translateY(0);
        /* Move section down */
    }

}

.fade-dimensions {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(0);
        /* Move section up */
    }

    to {
        opacity: 1;
        transform: translateY(1px);
        /* Move section down */
    }

}

.fade-dimensions {
    animation: fadeIn 0.5s ease-in-out;
}
</style>
<!-- Pricing Plans -->
<section class="section-py first-section-pt">
    <div class="container">
        <h2 class="text-center mb-2">Pricing Plans</h2>
        <p class="text-center"> Get started with us - it's perfect for individuals and teams. Choose a subscription plan
            that meets your needs. </p>


    </div>
</section>
<!--/ Pricing Plans -->
<!-- Pricing Free Trial -->
<div id="shipemntPrice">
    <form action="{{route('shipment.get.price')}}" method="POST" id="shipmentPriceForm">
        @csrf
        <input type="hidden" id="currentSection" name="currentSection" value="{{ $currentSection }}">
        <section class="pricing-free-trial bg-label-primary" id="section1" @if($currentSection===1)
            style="display: block;" @else style="display: none;" @endif>
            <div class="container">

                <div class="card p-5">
                    <h4 class="text-center mb-5">{{__('Select Trip Route AND Goods Type')}}</h4>
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label" for="from-country">{{__('Trip Route')}}</label>
                            <select id="from-country" name="trip-route" required class="select2 form-select"
                                data-allow-clear="true">
                                <option value=''>{{__('Select')}}</option>
                                @foreach ($tripRoutes as $route)
                                <option value='{{$route->id}}'>
                                    @foreach($route->legs as $leg)
                                    {{ __($leg['type']) . ' ' . __($leg['country']) . ' - ' }}
                                    @endforeach
                                </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="from-city">{{__('City')}} ({{__('Optional')}})</label>
                            <input type="text" id="from-city" class="form-control" placeholder="{{__('Istanbule')}}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="goodType">{{__('Goods Type')}}</label>
                            <select id="goodType" required name="good-type" class="select2 form-select"
                                data-allow-clear="true">
                                <option value=''>{{__('Select')}}</option>
                                @foreach ($goodTypes as $type)
                                <option value='{{$type->id}}'>{{$type->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="to-city">{{__('City')}} ({{__('Optional')}})</label>
                            <input type="text" id="to-city" name="to-city" class="form-control"
                                placeholder="{{__('Tripoli')}}" />
                        </div>

                    </div>
                    <div style="text-align: center;"><button type="button" onclick="nextSection(2)"
                            class="btn btn-primary btn-lg mt-5">{{__('Describe Your Shipment')}}</button>
                    </div>

                </div>
                <!-- image -->


            </div>
        </section>
        <section class=" fade-in" id="section2" @if($currentSection===2) style="display: block;" @else
            style="display: none;" @endif>
            <div class="container">

                <div class="card p-5" style="align-items: center;">
                    <h4>{{__('Describe Your Shipment')}}</h4>

                    <div class="col-12 px-3">

                        <label class="form-label" for="from-weight">{{__('Weight')}} *</label>
                        <input type="number" required name="weight" id="from-weight" class="form-control" pattern="\d+"
                            oninput="validateNumber(this)" placeholder="{{__('Weight (kg)')}}" />
                    </div>

                    <div class="col-md-12">

                        <div class="row px-3 mt-4 mb-3">
                            <h5>{{__('Type of Packing')}}</h5>

                            <div class="col-md mb-md-0 mb-2">
                                <div class="form-check custom-option custom-option-image custom-option-image-check">
                                    <input class="form-check-input" name="parcelTypeGroup" type="radio" value="package"
                                        onchange="updateColor(event)" id="packageRadio" checked />
                                    <label
                                        class="form-check-label custom-option-content d-flex align-items-center justify-content-evenly"
                                        style="background-color: #28314555;" for="packageRadio">
                                        <div class="d-none d-sm-flex">
                                            <h5>{{__('Package')}}<span><br>{{__('Cargo')}}</span></h5>
                                        </div>
                                        <span class="custom-option-body">
                                            <img src="{{asset('assets/img/backgrounds/package_color.svg')}}"
                                                alt="package_color" style="width: 110px">
                                        </span>
                                    </label>
                                </div>

                            </div>
                            <div class="col-md mb-md-0 mb-2">
                                <div class="form-check custom-option custom-option-image custom-option-image-check">
                                    <input class="form-check-input" name="parcelTypeGroup" type="radio" value=""
                                        onchange="updateColor(event)" id="bagsRadio" />
                                    <label
                                        class="form-check-label custom-option-content d-flex align-items-center justify-content-evenly"
                                        style="background-color: #28314555;" for="bagsRadio">
                                        <div class="d-none d-sm-flex">
                                            <h5>{{__('Cargo')}}<span><br>{{__('Box')}}</span></h5>
                                        </div>
                                        <span class="custom-option-body">
                                            <img src="{{asset('assets/img/backgrounds/shopping_bags_color.svg')}}"
                                                alt="shopping_bags_color" style="width: 110px">
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-check custom-option custom-option-image custom-option-image-check">
                                    <input class="form-check-input" name="parcelTypeGroup" type="radio" value=""
                                        onchange="updateColor(event)" id="thingsRadio" checked />
                                    <label
                                        class="form-check-label custom-option-content d-flex align-items-center justify-content-evenly"
                                        style="background-color: #283145;" for="thingsRadio">
                                        <div class="d-none d-sm-flex">
                                            <h5>{{__('Unpackaged')}}<span><br>{{__('Bulk cargo')}}</span></h4>
                                        </div>
                                        <span class="custom-option-body">
                                            <img src="{{asset('assets/img/backgrounds/things-3.svg')}}" alt="things-3"
                                                style="width: 110px">
                                        </span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row col-md-12 fade-dimensions" id="dimensionsBox" style="display: none;">
                        <h5>{{__('Enter Dimensions Box')}}</h5>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" id="from-city" class="form-control" pattern="\d+"
                                    oninput="validateNumber(this)" placeholder="{{__('Length (cm)*')}}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" id="from-city" class="form-control" pattern="\d+"
                                    oninput="validateNumber(this)" placeholder="{{__('Width (cm)*')}}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" id="from-city" class="form-control" pattern="\d+"
                                    oninput="validateNumber(this)" placeholder="{{__('Height (cm)*')}}" />
                            </div>
                        </div>
                    </div>

                    <div style="text-align: center;"><button type="type"
                            class="btn btn-primary btn-lg mt-5">{{__('Get Price')}}</button>
                    </div>

                </div>
                <!-- image -->


            </div>
        </section>

    </form>
</div>
<!--/ Pricing Free Trial -->
<!-- Plans Comparison -->

<!--/ Plans Comparison -->
<!-- FAQS -->
<section class="section-py pricing-faqs rounded-bottom bg-body">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-2">FAQs</h2>
            <p>Let us help answer the most common questions you might have.</p>
        </div>
        <div id="faq" class="accordion accordion-without-arrow">
            <div class="card accordion-item">
                <h6 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-2"
                        aria-expanded="false" aria-controls="faq-2">
                        How do you process payments?
                    </button>
                </h6>
                <div id="faq-2" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">
                        We accept Visa®, MasterCard®, American Express®, and PayPal®.
                        So you can be confident that your credit card information will be kept
                        safe and secure.
                    </div>
                </div>
            </div>

            <div class="card accordion-item">
                <h6 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true"
                        data-bs-target="#faq-1" aria-controls="faq-1">
                        What counts towards the 100 responses limit?
                    </button>
                </h6>

                <div id="faq-1" class="accordion-collapse collapse show" data-bs-parent="#faq">
                    <div class="accordion-body">
                        We count all responses submitted through all your forms in a month.
                        If you already received 100 responses this month, you won’t be able to receive any more of them
                        until next
                        month when the counter resets.
                    </div>
                </div>
            </div>

            <div class="card accordion-item">
                <h6 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-3"
                        aria-expanded="false" aria-controls="faq-3">
                        What payment methods do you accept?
                    </button>
                </h6>
                <div id="faq-3" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">
                        2Checkout accepts all types of credit and debit cards.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ FAQS -->
<script>
function validateNumber(input) {
    // Remove non-numeric characters using a regular expression
    input.value = input.value.replace(/\D/g, '');
}

function nextSection(number) {
    var nextSection = document.getElementById('section' + number);
    nextSection.style.display = 'block';
    var sectionHeight = nextSection.offsetHeight
    // nextSection.scrollIntoView({
    //     behavior: 'smooth'
    // });
    window.scrollBy(0, sectionHeight);
    // updateSectionDisplay();
}

function updateColor(e) {
    const labels = document.querySelectorAll('.form-check-label');
    labels.forEach(label => {
        label.style.backgroundColor = '#28314555';
    });
    const label = document.querySelector(`[for=${e.target.id}]`);
    label.style.backgroundColor = '#283145';
    const element = document.getElementById('dimensionsBox');

    if (e.target.id === "packageRadio") {
        element.style.display = 'flex';
    } else {
        element.style.display = 'none';
    }
}
document.addEventListener('DOMContentLoaded', function(event) {
    var form = document.getElementById('shipmentPriceForm');
    var formData = new FormData(form);
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        if (document.getElementById('section3')) {
            return;
        }
        var url = form.getAttribute('action');
        var method = form.getAttribute('method');
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                var section3 = document.createElement('section');
                section3.id = 'section3';
                section3.className = 'pricing-free-trial  fade-in';
                section3.innerHTML = `<div class="card p-5 d-flex align-items-center">
                <div class="col-lg-6 order-3 order-xl-0">
    <div class="card" style="background-image: linear-gradient(-20deg, #2b5876 0%, #4e4376 100%);">
      <div class="d-flex align-items-center text-center row">
        <div class="col-12">
          <div class="card-body text-nowrap">
            <h4 class="card-title mb-0">{{__('Thank You for your time')}} 🎉</h4>
            <p class="mb-2">{{__('Your Shipment Price is')}} :</p>
            <h4 class="text-success mb-1">دل${data.data}</h4>
            <a href="javascript:;" class="btn btn-primary">{{__('Register Now')}}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
                </div>`;

                form.parentNode.appendChild(section3);
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle error, show alert, etc.
            });
    });


});
</script>
@endsection