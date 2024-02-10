@php
$customizerHidden = 'customizer-hide';

$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', __('Home'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/nouislider/nouislider.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/front-page-landing.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/nouislider/nouislider.js')}}"></script>
<script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/front-page-landing.js')}}"></script>
@endsection
<style>
    .grid-border {
        overflow: hidden;
    }

    .grid-border [class^=col-]:before,
    .grid-border [class^=col-]:after {
        content: '';
        position: absolute;
    }

    .grid-border [class^=col-]:before {
        height: 100%;
        top: 0;
        left: -1px;
        border-left: 1px solid #0000000d;
    }

    .grid-border [class^=col-]:after {
        width: 100%;
        height: 0;
        top: auto;
        left: 0;
        bottom: -1px;
        border-bottom: 1px solid #0000000d;
    }

    .col-padding {
        padding: 4rem 3.5rem !important;
    }

    .fbox-icon {
        margin-bottom: 1.5rem;
    }
    
</style>
@section('content')
<div data-bs-spy="scroll" class="scrollspy-example">
    <!-- Hero: Start -->
    <section id="hero-animation">
        <div id="landingHero" class="section-py landing-hero position-relative">
            <div class="container">
                <div class="hero-text-box text-center">
                    <h1 class="text-primary hero-title display-6 fw-bold">{{__('Elevate Your Cargo Experience')}}</h1>
                    <h2 class="hero-sub-title h6 mb-4 pb-1 fw-medium">
                        {{__('Seamless Air Cargo Solutions for Swift and Reliable Shipments')}}.
                    </h2>
                    <div class="landing-hero-btn d-inline-block position-relative">
                        <span class="hero-btn-item position-absolute d-none d-md-flex text-heading">{{__('Join us')}}
                            <img src="{{asset('assets/img/front-pages/icons/Join-community-arrow.png')}}" alt="Join us arrow" class="scaleX-n1-rtl" /></span>
                        <a href="{{route('track-shipment')}}" class="btn btn-primary btn-lg">{{__('Track your shipment')}}</a>
                    </div>
                </div>
                <div id="heroDashboardAnimation" class="hero-animation-img">
                    <a href="{{url('/')}}" target="_blank">
                        <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                            <img src="{{asset('assets/img/front-pages/landing-page/hero-dashboard-'.$configData['style'].'.png') }}" alt="hero dashboard" class="animation-img" data-app-light-img="front-pages/landing-page/hero-dashboard-light.png" data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
                            <img src="{{asset('assets/img/front-pages/landing-page/hero-elements-'.$configData['style'].'.png') }}" alt="hero elements" class="position-absolute hero-elements-img animation-img top-0 start-0" data-app-light-img="front-pages/landing-page/hero-elements-light.png" data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" />

                        </div>
                    </a>
                </div>

                <div class="landing-hero-blank"></div>
    </section>
    <!-- Hero: End -->

    <!-- Useful features: Start -->
    <!-- <section id="landingFeatures" class="section-py landing-features">
        <div class="container">
            <div class="text-center mb-3 pb-1">
                <span class="badge bg-label-primary">{{__('Our Services')}}</span>
            </div>
            <h3 class="text-center mb-1">
                <span class="section-title">{{__('Retailer Services for All Shipments')}}</span>
            </h3>
           
            <div class="features-icon-wrapper row gx-0 gy-4 g-sm-5">
                <div class="col-lg-4 col-md-6 text-start features-icon-box">
                    <div class="text-center mb-3">
                        <img src="{{asset('assets/img/front-pages/icons/laptop.png')}}" alt="laptop charging" />
                    </div>
                    <h5 class="mb-3 text-center">{{__('General Cargo Shipments and Containers')}}</h5>
                    <p class="features-icon-description" style="text-align: justify;">
                        {{__('We operate in a number of challenging destinations where we recognize our clients’ needs for reliable import and export services. No matter where the goods are travelling to or from, our goal is to provide complete customer satisfaction through consistent quality service. We manage and facilitate FCL (Full Container Load), LCL (Less Than Container load), ODC (Over Dimension Cargo) and Reefer Cargo Shipments to and from anywhere in the world')}}.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 text-start  features-icon-box">
                    <div class="text-center mb-3">
                        <img src="{{asset('assets/img/front-pages/icons/rocket.png')}}" alt="transition up" />
                    </div>
                    <h5 class="mb-3 text-center">{{__('Oil and Gas Transportation and Logistics')}}</h5>
                    <p class="features-icon-description" style="text-align: justify;">
                        {{__('When it comes to managing the logistics of oil and gas, safety and efficiency are the greatest concerns. At Al Janah Express, we have extensive experience of providing specialized logistic services for this industry. We offer comprehensive management concepts and flexible solutions for all kinds of support needed')}}.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 text-start features-icon-box">
                    <div class="text-center mb-3">
                        <img src="{{asset('assets/img/front-pages/icons/paper.png')}}" alt="edit" />
                    </div>
                    <h5 class="mb-3 text-center">{{__('Dry Masonry / Cattle Transport')}}</h5>
                    <p class="features-icon-description" style="text-align: justify;">
                        {{__('We provide competitive prices for high quality services in Cattle/Animal Transport ( Cows, Sheep, Dears, Camels, and Horses ) , these vessels are especially designed with areas equipped with animal feeders mimicking those found in farms, with ventilation and locking systems that can be set according to the need for temperature and/or air supply, they are also equipped with automatic feeding belts, and waste disposal systems. We also provide dry masonry transport solutions with full retailer services')}}
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 text-start features-icon-box">
                    <div class="text-center mb-3">
                        <img src="{{asset('assets/img/front-pages/icons/check.png')}}" alt="3d select solid" />
                    </div>
                    <h5 class="mb-3 text-center">
                        {{__('Custom Clearance / Storage & Transport / Door to Door Delivery')}}
                    </h5>
                    <p class="features-icon-description" style="text-align: justify;">
                        {{__('Al Janah Express Shipping Company provides reliable, fast, and affordable door to door delivery services')}}.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 text-start features-icon-box">
                    <div class="text-center mb-3">
                        <img src="{{asset('assets/img/front-pages/icons/user.png')}}" alt="lifebelt" />
                    </div>
                    <h5 class="mb-3 text-center">{{__('Ship Supply Services')}}</h5>
                    <p class="features-icon-description" style="text-align: justify;">
                        {{__('Crew Member Accomodation & Catering')}}.<br> {{__('Providing Security Liaisons')}}.<br>
                        {{__('Supervising Cargo Condition & Count')}}.<br>
                        {{__('Solutions for Heavy Lifting Utilities')}}.
                    </p>
                </div>

            </div>
        </div>
    </section> -->
    <!-- Useful features: End -->
    <section class="section bg-body">
        <div class="mt-5" style="overflow: hidden;">
            <div class="section m-0 text-center" style="padding: 60px 0;">
                <div class="container clearfix">
                    <div class="mx-auto center" style="max-width: 900px;">
                        <h2 class="mb-0 fw-light ls1">We enjoy working on the Services &amp; Products we provide as much as you need them. This help us in delivering your Goals easily. Browse through the wide range of services we provide.</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-stretch">

                <div class="col-lg-4 d-none d-md-block" style="background: url('assets/img/front-pages/landing-page/main-bg.jpg') center center no-repeat; background-size: cover;">
                </div>

                <div class="col-lg-8 mt-lg-0 card aljanah-services">
                    <div class="row align-items-stretch grid-border">

                        <div class="col-lg-4 col-md-6 col-padding border-left-bottom">
                            <div class="">
                                <div class="text-center fbox-icon">
                                    <img src="{{asset('assets/img/front-pages/icons/laptop.png')}}" alt="laptop charging" />
                                </div>
                                <div class=" text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('Retailer Services for All Shipments')}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-padding border-left-bottom">
                            <div class="">
                                <div class="text-center fbox-icon">
                                    <img src="{{asset('assets/img/front-pages/icons/laptop.png')}}" alt="laptop charging" />
                                </div>
                                <div class=" text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('General Cargo Shipments and Containers')}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-padding border-left-bottom">
                            <div class="">
                                <div class="text-center fbox-icon">
                                    <img src="{{asset('assets/img/front-pages/icons/laptop.png')}}" alt="laptop charging" />
                                </div>
                                <div class="text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('Oil and Gas Transportation and Logistics')}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-padding border-left-bottom">
                            <div class="">
                                <div class="text-center fbox-icon">
                                    <img src="{{asset('assets/img/front-pages/icons/laptop.png')}}" alt="laptop charging" />
                                </div>
                                <div class="text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('Dry Masonry / Cattle Transport')}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-padding border-left-bottom">
                            <div class="">
                                <div class="text-center fbox-icon">
                                    <img src="{{asset('assets/img/front-pages/icons/laptop.png')}}" alt="laptop charging" />
                                </div>
                                <div class="text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('Custom Clearance / Storage & Transport / Door to Door Delivery')}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-padding border-left-bottom">
                            <div class="">
                                <div class="text-center fbox-icon">
                                    <img src="{{asset('assets/img/front-pages/icons/laptop.png')}}" alt="laptop charging" />
                                </div>
                                <div class=" text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('Ship Supply Services')}}</h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </d>
        </div>
    </section>
    <!-- Real customers reviews: Start -->

    <!-- Real customers reviews: End -->

    <!-- Our great team: Start -->
    <!-- <section id="landingTeam" class="section-py landing-team">
        <div class="container">
            <div class="text-center mb-3 pb-1">
                <span class="badge bg-label-primary">Our Great Team</span>
            </div>
            <h3 class="text-center mb-1"><span class="section-title">Supported</span> by Real People</h3>
            <p class="text-center mb-md-5 pb-3">Who is behind these great-looking interfaces?</p>
            <div class="row gy-5 mt-2">
                <div class="col-lg-3 col-sm-6">
                    <div class="card mt-3 mt-lg-0 shadow-none">
                        <div class="bg-label-primary position-relative team-image-box">
                            <img src="{{asset('assets/img/front-pages/landing-page/team-member-1.png')}}"
                                class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                alt="human image" />
                        </div>
                        <div class="card-body border border-top-0 border-label-primary text-center">
                            <h5 class="card-title mb-0">Sophie Gilbert</h5>
                            <p class="text-muted mb-0">Project Manager</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card mt-3 mt-lg-0 shadow-none">
                        <div class="bg-label-info position-relative team-image-box">
                            <img src="{{asset('assets/img/front-pages/landing-page/team-member-2.png')}}"
                                class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                alt="human image" />
                        </div>
                        <div class="card-body border border-top-0 border-label-info text-center">
                            <h5 class="card-title mb-0">Paul Miles</h5>
                            <p class="text-muted mb-0">UI Designer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card mt-3 mt-lg-0 shadow-none">
                        <div class="bg-label-danger position-relative team-image-box">
                            <img src="{{asset('assets/img/front-pages/landing-page/team-member-3.png')}}"
                                class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                alt="human image" />
                        </div>
                        <div class="card-body border border-top-0 border-label-danger text-center">
                            <h5 class="card-title mb-0">Nannie Ford</h5>
                            <p class="text-muted mb-0">Development Lead</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card mt-3 mt-lg-0 shadow-none">
                        <div class="bg-label-success position-relative team-image-box">
                            <img src="{{asset('assets/img/front-pages/landing-page/team-member-4.png')}}"
                                class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                alt="human image" />
                        </div>
                        <div class="card-body border border-top-0 border-label-success text-center">
                            <h5 class="card-title mb-0">Chris Watkins</h5>
                            <p class="text-muted mb-0">Marketing Manager</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Our great team: End -->

    <!-- Fun facts: Start -->
    <section id="landingFunFacts" class="section-py landing-fun-facts">
        <div class="container">
            <div class="row gy-3">
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-primary shadow-none">
                        <div class="card-body text-center">
                            <img src="{{asset('assets/img/front-pages/icons/laptop.png')}}" alt="laptop" class="mb-2" />
                            <h5 class="h2 mb-1">7.1k+</h5>
                            <p class="fw-medium mb-0">
                                Support Tickets<br />
                                Resolved
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-success shadow-none">
                        <div class="card-body text-center">
                            <img src="{{asset('assets/img/front-pages/icons/user-success.png')}}" alt="laptop" class="mb-2" />
                            <h5 class="h2 mb-1">50k+</h5>
                            <p class="fw-medium mb-0">
                                Join creatives<br />
                                community
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-info shadow-none">
                        <div class="card-body text-center">
                            <img src="{{asset('assets/img/front-pages/icons/diamond-info.png')}}" alt="laptop" class="mb-2" />
                            <h5 class="h2 mb-1">4.8/5</h5>
                            <p class="fw-medium mb-0">
                                Highly Rated<br />
                                Products
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-warning shadow-none">
                        <div class="card-body text-center">
                            <img src="{{asset('assets/img/front-pages/icons/check-warning.png')}}" alt="laptop" class="mb-2" />
                            <h5 class="h2 mb-1">100%</h5>
                            <p class="fw-medium mb-0">
                                Money Back<br />
                                Guarantee
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fun facts: End -->
    <!-- FAQ: Start -->
    <section id="landingFAQ" class="section-py bg-body landing-faq">
        <div class="container">
            <div class="text-center mb-3 pb-1">
                <span class="badge bg-label-primary">{{__('FAQ')}}</span>
            </div>
            <h3 class="text-center mb-1"><span class="section-title">{{__('Frequently asked questions')}}</span></h3>
            <!-- <p class="text-center mb-5 pb-3">Browse through these FAQs to find answers to commonly asked questions.</p> -->
            <br>
            <div class="row gy-5">
                <div class="col-lg-5">
                    <div class="text-center">
                        <img src="{{asset('assets/img/front-pages/landing-page/faq-boy-with-logos.png')}}" alt="faq boy with logos" class="faq-image" />
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="accordion" id="accordionExample">
                        <div class="card accordion-item active">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
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
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                                    {{__('What is the purpose of a ( roll on / roll off ) ship?')}}
                                </button>
                            </h2>
                            <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('To transport wheeled cargo, such as all kinds of vehicles and machinary with wheels. The cargo can be loaded using the ramp, with no need for cranes or intermediaries, thereby making for lower costs and risks')}}
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
                                    {{__('What are container ships?')}}
                                </button>
                            </h2>
                            <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('Vessels designed to transport freight in containers. They monopolize the majority of international dry cargo transport and represent more than half of all maritime trade. They are intended to transport standard containers according to ISO regulations')}}.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFour" aria-expanded="false" aria-controls="accordionFour">
                                    {{__('What is a ship agent?')}}
                                </button>
                            </h2>
                            <div id="accordionFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('A ship agent is an independent shipping agent who acts on behalf of the ship owner. Ship agents are responsible for a ship when it comes into port and conduct all of the procedures required to streamline its dock time in order to reduce the cost of the operation')}}.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFive" aria-expanded="false" aria-controls="accordionFive">
                                    {{__('What is multimodal freight transport?')}}
                                </button>
                            </h2>
                            <div id="accordionFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('Multimodal transport consists of carrying a single cargo by different modes of transport (air, land, ocean…) using Intermodal Transport Units (ITU) such as containers, semi-trailers or swap bodies (interchangeable containers)')}}
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionSix" aria-expanded="false" aria-controls="accordionSix">
                                    {{__('What is the difference between a forwarding and a customs agent?')}}
                                </button>
                            </h2>
                            <div id="accordionSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('A forwarding agent or forwarder is a transport operator. They act on behalf and in favour of importers and exporters, organising safe, efficient and economical goods transport. In other words, a professional expert at your disposal for the purposes of hiring transport, selecting the most efficient route, taking out insurance policies, choosing the appropriate packaging and taking care of storage where required. A customs agent is responsible for managing all customs duties and documents required by the tax administration in every country for the traffic of goods between states. Their importance lies in knowing the legal regulations in order to satisfy the tax authorities and avoid last-minute surprises such as tax duties or surcharges')}}.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionSeven" aria-expanded="false" aria-controls="accordionSeven">
                                    {{__('How do customs controls work?')}}
                                </button>
                            </h2>
                            <div id="accordionSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
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
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionEight" aria-expanded="false" aria-controls="accordionEight">
                                    {{__('What is the purpose of international customs?')}}
                                </button>
                            </h2>
                            <div id="accordionEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('The role of customs control is to regulate and inspect shipments in order to guarantee that commercial exchanges between different countries proceed legally, that they comply with all tax and duty obligations and with all other requirements related to their entry or exit. As well as guaranteeing compliance with international trade rules, collecting taxes and duties due where appropriate, customs controls are a fundamental mechanism for preventing money laundering, tax fraud and drug trafficking')}}
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionNine" aria-expanded="false" aria-controls="accordionNine">
                                    {{__('What is customs management?')}}
                                </button>
                            </h2>
                            <div id="accordionNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('The management of all formalities required by the customs authorities. It is important for these formalities to run smoothly and trouble-free in order to prevent delays due to bureaucratic issues. These formalities are therefore usually entrusted to a customs agent who will carry them out on behalf of the freight owner')}}.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingTen">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTen" aria-expanded="false" aria-controls="accordionTen">
                                    {{__('What is customs clearance?')}}
                                </button>
                            </h2>
                            <div id="accordionTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('All formalities and requirements to be completed for goods entering and leaving a specific national territory in order to control and approve their transportation. The customs agent is responsible for completing these formalities on behalf of the importer or exporter, and for submitting a declaration of information to the competent customs authority in each case')}}.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingEleven">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionEleven" aria-expanded="false" aria-controls="accordionEleven">
                                    {{__('What is completed customs clearance?')}}
                                </button>
                            </h2>
                            <div id="accordionEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('Customs clearance means that the customs procedure has been completed, i.e. that all of the paperwork has been submitted and that the shipment can continue on its way')}}.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ: End -->

    <!-- CTA: Start -->
    <section id="landingCTA" class="section-py landing-cta p-lg-0 pb-0">
        <div class="container">
            <div class="row align-items-center gy-5 gy-lg-0 py-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <h6 class="h2 fw-bold mb-1">{{__('Get Shipping Rates')}}</h6>
                    <p class="fw-medium mb-4">
                        {{__("Fast delivery, unbeatable prices. Your go-to for express shipping that won't break the bank. Get your package there on time, every time")}}.
                    </p>
                    <a href="{{route('shipment-price')}}" class="btn btn-lg btn-primary">{{__('Shipping Price')}}</a>
                </div>
                <div class="col-lg-6 pt-lg-5 text-center text-lg-end">
                    <!-- <img src="{{asset('assets/img/front-pages/landing-page/cta-dashboard.png')}}" alt="cta dashboard"
                        class="img-fluid" /> -->
                </div>
            </div>
        </div>
    </section>
    <!-- CTA: End -->

    <!-- Contact Us: Start -->
    <section id="landingContact" class="section-py bg-body landing-contact">
        <div class="container">
            <div class="text-center mb-3 pb-1">
                <span class="badge bg-label-primary">{{__('Contact US')}}</span>
            </div>
            <h3 class="text-center mb-1"><span class="section-title">{{__("Let's work")}}</span> {{__('together')}}</h3>
            <p class="text-center mb-4 mb-lg-5 pb-md-3">{{__('Any question or remark? just write us a message')}}</p>
            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="contact-img-box position-relative border p-2 h-100">
                        <img src="{{asset('assets/img/front-pages/landing-page/contact-customer-service.png')}}" alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
                        <div class="pt-3 px-4 pb-1">
                            <div class="row gy-3 gx-md-4">
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-primary rounded p-2 me-2"><i class="ti ti-mail ti-sm"></i></div>
                                        <div>
                                            <p class="mb-0">{{__('Email')}}</p>
                                            <h5 class="mb-0">
                                                <a href="mailto:example@gmail.com" class="text-heading">example@gmail.com</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-success rounded p-2 me-2">
                                            <i class="ti ti-phone-call ti-sm"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">{{__('Phone')}}</p>
                                            <h5 class="mb-0"><a href="tel:+1234-568-963" class="text-heading">+1234 568
                                                    963</a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-1">{{__('Send a message')}}</h4>
                            <p class="mb-4">
                                {{__('If you would like to discuss anything related to shipping, prices, tracking, partnerships,')}}<br class="d-none d-lg-block" />
                                {{__('or have pre-shipping questions, you’re at the right place')}}.
                            </p>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="contact-form-fullname">{{__('Full Name')}}</label>
                                        <input type="text" class="form-control" id="contact-form-fullname" placeholder="john" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="contact-form-email">{{__('Email')}}</label>
                                        <input type="text" id="contact-form-email" class="form-control" placeholder="johndoe@gmail.com" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="contact-form-message">{{__('Message')}}</label>
                                        <textarea id="contact-form-message" class="form-control" rows="8" placeholder="Write a message"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">{{__('Send now')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us: End -->
</div>
@endsection