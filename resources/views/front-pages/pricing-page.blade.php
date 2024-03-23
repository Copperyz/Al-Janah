@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Shipment Price'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/front-page-pricing.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/front-page-pricing.js')}}"></script>
<script src="{{asset('assets/js/forms-selects.js')}}"></script>
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
        <h2 class="text-center mb-2">{{__('Shipping Prices')}}</h2>
        <p class="text-center">{{__('Unbeatable Shipment Rates – Simple, Transparent, and Affordable')}}</p>


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
                            <select id="from-country" name="trip_route_id" required class="select2 form-select"
                                data-allow-clear="true">
                                <option disabled selected>{{__('Select')}}</option>
                                @foreach($tripRoutes as $tripRoute)
                                <option value="{{$tripRoute->id}}">{{__($tripRoute->legs_combined)}}</option>
                                @endforeach
                            </select>

                        </div>

                        <!-- <div class="col-md-6">
                            <label class="form-label" for="from-city">{{__('City')}} ({{__('Optional')}})</label>
                            <input type="text" id="from-city" class="form-control" placeholder="{{__('Istanbule')}}" />
                        </div> -->
                        <div class="col-md-6">
                            <label class="form-label" for="goodType">{{__('Goods Type')}}</label>
                            <select id="goodType" required name="goodTypeId" class="select2 form-select"
                                data-allow-clear="true">
                                <option disabled selected>{{__('Select')}}</option>
                                @foreach ($goodTypes as $type)
                                <option value='{{$type->id}}'>{{$type->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <!-- <div class="col-md-6">
                            <label class="form-label" for="to-city">{{__('City')}} ({{__('Optional')}})</label>
                            <input type="text" id="to-city" name="to-city" class="form-control"
                                placeholder="{{__('Tripoli')}}" />
                        </div> -->

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
                                    <input class="form-check-input" name="parcelTypeId" type="radio" value="1"
                                        onchange="updateColor(event)" id="packageRadio" checked />
                                    <label
                                        class="form-check-label custom-option-content d-flex align-items-center justify-content-evenly"
                                        style="background-color: #28314555;" for="packageRadio">
                                        <div class="d-none d-sm-flex">
                                            <h5>{{__('Cargo')}}<span><br>{{__('Box')}}</span></h5>
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
                                    <input class="form-check-input" name="parcelTypeId" type="radio" value="2"
                                        onchange="updateColor(event)" id="bagsRadio" />
                                    <label
                                        class="form-check-label custom-option-content d-flex align-items-center justify-content-evenly"
                                        style="background-color: #28314555;" for="bagsRadio">
                                        <div class="d-none d-sm-flex">
                                            <h5>{{__('Bagged')}}<span><br>{{__('Cargo')}}</span></h5>
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
                                    <input class="form-check-input" name="parcelTypeId" type="radio" value="3"
                                        onchange="updateColor(event)" id="thingsRadio" checked />
                                    <label
                                        class="form-check-label custom-option-content d-flex align-items-center justify-content-evenly"
                                        style="background-color: #283145;" for="thingsRadio">
                                        <div class="d-none d-sm-flex">
                                            <h5>{{__('Unpacked')}}<span><br>{{__('Bulk cargo')}}</span></h4>
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
                                <input type="number" id="length" name="length" class="form-control" pattern="\d+"
                                    oninput="validateNumber(this)" placeholder="{{__('Length (cm)*')}}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" id="width" name="width" class="form-control" pattern="\d+"
                                    oninput="validateNumber(this)" placeholder="{{__('Width (cm)*')}}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" id="height" name="height" class="form-control" pattern="\d+"
                                    oninput="validateNumber(this)" placeholder="{{__('Height (cm)*')}}" />
                            </div>
                        </div>
                    </div>

                    <div style="text-align: center;"><button type="submit"
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
        <div class="accordion accordion-without-arrow" id=" accordionExample">
            <div class="card accordion-item active">
                <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                        data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                        {{__('What are the characteristics of ( roll on / roll off ) ships?')}}
                    </button>
                </h2>

                <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{__('Ro-Ro ships are vessels designed to transport vehicles on wheels, i.e. cars, trucks or industrial vehicles. Sometimes they have built-in ramps for the loading and unloading of vehicles. The fact that the cargo can access the ship under its own steam removes the need for a crane, thus reducing the intermediary costs related to loading, unloading and stowage. These ships can only carry wheeled vehicles and mustn’t be confused with Ro-Pax vessels, like ferries, which combine the transport of vehicles and passengers')}}
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                        {{__('What is the purpose of a ( roll on / roll off ) ship?')}}
                    </button>
                </h2>
                <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{__('To transport wheeled cargo, such as all kinds of vehicles and machinary with wheels. The cargo can be loaded using the ramp, with no need for cranes or intermediaries, thereby making for lower costs and risks')}}
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
                        {{__('What are container ships?')}}
                    </button>
                </h2>
                <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{__('Vessels designed to transport freight in containers. They monopolize the majority of international dry cargo transport and represent more than half of all maritime trade. They are intended to transport standard containers according to ISO regulations')}}.
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionFour" aria-expanded="false" aria-controls="accordionFour">
                        {{__('What is a ship agent?')}}
                    </button>
                </h2>
                <div id="accordionFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{__('A ship agent is an independent shipping agent who acts on behalf of the ship owner. Ship agents are responsible for a ship when it comes into port and conduct all of the procedures required to streamline its dock time in order to reduce the cost of the operation')}}.
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionFive" aria-expanded="false" aria-controls="accordionFive">
                        {{__('What is multimodal freight transport?')}}
                    </button>
                </h2>
                <div id="accordionFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{__('Multimodal transport consists of carrying a single cargo by different modes of transport (air, land, ocean…) using Intermodal Transport Units (ITU) such as containers, semi-trailers or swap bodies (interchangeable containers)')}}
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionSix" aria-expanded="false" aria-controls="accordionSix">
                        {{__('What is the difference between a forwarding and a customs agent?')}}
                    </button>
                </h2>
                <div id="accordionSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{__('A forwarding agent or forwarder is a transport operator. They act on behalf and in favour of importers and exporters, organising safe, efficient and economical goods transport. In other words, a professional expert at your disposal for the purposes of hiring transport, selecting the most efficient route, taking out insurance policies, choosing the appropriate packaging and taking care of storage where required. A customs agent is responsible for managing all customs duties and documents required by the tax administration in every country for the traffic of goods between states. Their importance lies in knowing the legal regulations in order to satisfy the tax authorities and avoid last-minute surprises such as tax duties or surcharges')}}.
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionSeven" aria-expanded="false" aria-controls="accordionSeven">
                        {{__('How do customs controls work?')}}
                    </button>
                </h2>
                <div id="accordionSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ol>
                            <li>{{__('Customs declaration: Must be presented to the customs authority in order to identify the goods to be transported and their destination')}}.
                            </li>
                            <li>{{__('Goods inspection by the customs agents, to check that they match the declaration')}}.
                            </li>
                            <li>{{__('Verification that trade policy norms have been met and amounts due have been paid (import and export duties)')}}
                            </li>
                        </ol>

                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingEight">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionEight" aria-expanded="false" aria-controls="accordionEight">
                        {{__('What is the purpose of international customs?')}}
                    </button>
                </h2>
                <div id="accordionEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{__('The role of customs control is to regulate and inspect shipments in order to guarantee that commercial exchanges between different countries proceed legally, that they comply with all tax and duty obligations and with all other requirements related to their entry or exit. As well as guaranteeing compliance with international trade rules, collecting taxes and duties due where appropriate, customs controls are a fundamental mechanism for preventing money laundering, tax fraud and drug trafficking')}}
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionNine" aria-expanded="false" aria-controls="accordionNine">
                        {{__('What is customs management?')}}
                    </button>
                </h2>
                <div id="accordionNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{__('The management of all formalities required by the customs authorities. It is important for these formalities to run smoothly and trouble-free in order to prevent delays due to bureaucratic issues. These formalities are therefore usually entrusted to a customs agent who will carry them out on behalf of the freight owner')}}.
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingTen">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionTen" aria-expanded="false" aria-controls="accordionTen">
                        {{__('What is customs clearance?')}}
                    </button>
                </h2>
                <div id="accordionTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{__('All formalities and requirements to be completed for goods entering and leaving a specific national territory in order to control and approve their transportation. The customs agent is responsible for completing these formalities on behalf of the importer or exporter, and for submitting a declaration of information to the competent customs authority in each case')}}.
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingEleven">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionEleven" aria-expanded="false" aria-controls="accordionEleven">
                        {{__('What is completed customs clearance?')}}
                    </button>
                </h2>
                <div id="accordionEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{__('Customs clearance means that the customs procedure has been completed, i.e. that all of the paperwork has been submitted and that the shipment can continue on its way')}}.
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
        var inputs = element.querySelectorAll('input');

        inputs.forEach(function(input) {
            input.required = element.style.display !== 'none';
        });
    } else {
        element.style.display = 'none';
    }
}
// document.addEventListener('DOMContentLoaded', function(event) {
//     var form = document.getElementById('shipmentPriceForm');
//     var formData = new FormData(form);
//     form.addEventListener('submit', function(event) {
//         event.preventDefault();
//         if (document.getElementById('section3')) {
//             return;
//         }
//         var url = form.getAttribute('action');
//         var method = form.getAttribute('method');
//         var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//         fetch(url, {
//                 method: method,
//                 headers: {
//                     'X-CSRF-TOKEN': csrfToken
//                 },
//                 body: formData
//             })
//             .then(response => response.json())
//             .then(data => {
//                 var section3 = document.createElement('section');
//                 section3.id = 'section3';
//                 section3.className = 'pricing-free-trial  fade-in';
//                 section3.innerHTML = `<div class="card p-5 d-flex align-items-center">
//                 <div class="col-lg-6 order-3 order-xl-0">
//     <div class="card" style="background-image: linear-gradient(-20deg, #2b5876 0%, #4e4376 100%);">
//       <div class="d-flex align-items-center text-center row">
//         <div class="col-12">
//           <div class="card-body text-nowrap">
//             <h4 class="card-title mb-0">{{__('Thank You for your time')}} 🎉</h4>
//             <p class="mb-2">{{__('Your Shipment Price is')}} :</p>
//             <h4 class="text-success mb-1">دل${data.data}</h4>
//             <a href="javascript:;" class="btn btn-primary">{{__('Register Now')}}</a>
//           </div>
//         </div>
//       </div>
//     </div>
//   </div>
//                 </div>`;

//                 form.parentNode.appendChild(section3);
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//                 // Handle error, show alert, etc.
//             });
//     });


// });


$("#shipmentPriceForm").on("submit", function(event) {
    event.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    var formData = form.serialize();

    $.ajax({
        url: url,
        method: method,
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response, status, xhr) {
            if (xhr.status === 200) {
                // Remove existing section3 if it exists
                var existingSection3 = document.getElementById('section3');
                if (existingSection3) {
                    existingSection3.parentNode.removeChild(existingSection3);
                }

                // Create a new section3
                var section3 = document.createElement('section');
                section3.id = 'section3';
                section3.className = 'pricing-free-trial  fade-in';
                section3.innerHTML = `<div class="card p-5 d-flex align-items-center">
                    <div class="col-lg-6 order-3 order-xl-0">
                        <div class="card" style="background-image: linear-gradient(-20deg, #2b5876 0%, #4e4376 100%);">
                            <div class="d-flex align-items-center text-center row">
                                <div class="col-12">
                                    <div class="card-body text-nowrap">
                                        <h4 class="card-title mb-0">{{__('Calculate shipping costs')}} </h4>
                                        <p class="mb-2">{{__('your shipping rates are ')}} :</p>
                                        <h4 class="text-success mb-1">${response.data} LYD</h4>
                                        <p class="mb-2">{{__('as of this date  ')}} :</p>
                                        <h5 class="text-dark mb-1">${new Date().toLocaleString()}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;

                // Append the new section3 to the form
                var form = document.getElementById('shipmentPriceForm');
                form.appendChild(section3);
            } else {
                // Handle other status codes
            }
        },
        error: function(response, xhr, status, error) {
            // Handle the error response here
            var errorMessages = Object.values(response.responseJSON.errors).flat();
            // Format error messages with line breaks
            var formattedErrorMessages = errorMessages.join(
                '<br>'); // Join the error messages with <br> tags
            // Create the Swal alert
            Swal.fire({
                title: response.responseJSON.message,
                html: formattedErrorMessages,
                icon: 'error',
                confirmButtonText: doneTranslation,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        }
    });

});
</script>
@endsection