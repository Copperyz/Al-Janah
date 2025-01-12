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
<script src="{{asset('assets/js/extends/front-page-landing.js')}}"></script>
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
    #landingHero{
        background-image: url("./assets/img/front-pages/landing-page/pexels-daniel-frese-569417.jpg");
        object-fit: cover;
    background-size: cover;
    overflow: hidden;
    }
    /* .landing-hero-blank{
        background-image: url("./assets/img/front-pages/landing-page/pexels-daniel-frese-569417.jpg");
        object-fit: cover;
    background-size: cover;
    } */
</style>
@section('content')
<div data-bs-spy="scroll" class="scrollspy-example">
    <!-- Hero: Start -->
    <section id="hero-animation">
        <div id="landingHero" class="section-py landing-hero position-relative">
            <!-- <div class="container">
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
                </div> -->
                <!-- <div id="heroDashboardAnimation" class="hero-animation-img">
                     <a href="{{url('/')}}" target="_blank">
                        <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                            <img src="{{asset('assets/img/front-pages/landing-page/hero-dashboard-'.$configData['style'].'.png') }}" alt="hero dashboard" class="animation-img" data-app-light-img="front-pages/landing-page/hero-dashboard-light.png" data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
                            <img src="{{asset('assets/img/front-pages/landing-page/hero-elements-'.$configData['style'].'.png') }}" alt="hero elements" class="position-absolute hero-elements-img animation-img top-0 start-0" data-app-light-img="front-pages/landing-page/hero-elements-light.png" data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" />

                        </div>
                    </a> 
                </div> 
            </div> -->
            <div id="heroDashboardAnimation" class="hero-animation-img">
                    @include('front-pages/hero-section')
            </div>
        </div> 
        <!-- <div class="landing-hero-blank"></div> -->
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
    <section class="section bg-body" id="landingFeatures">
        <div class="mt-5" style="overflow: hidden;">
            <div class="section m-0 text-center" style="padding: 60px 0;">
                <div class="container clearfix">
                    <div class="mx-auto center" style="max-width: 900px;">
                        <h2 class="mb-0 fw-normal ls1">{{__('Skip the slow lane with our express shipping. Get your stuff there lightning fast - explore and see!')}}</h2>
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
                                    <img src="{{asset('assets/img/front-pages/icons/ExpressAirFreight.png')}}" alt="Express Air Freight charging" width="65" />
                                </div>
                                <div class=" text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('Express Air Freight')}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-padding border-left-bottom">
                            <div class="">
                                <div class="text-center fbox-icon">
                                    <img src="{{asset('assets/img/front-pages/icons/InternationalShipping.png')}}" alt="InternationalShipping" width="65" />
                                </div>
                                <div class=" text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('International Shipping')}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-padding border-left-bottom">
                            <div class="">
                                <div class="text-center fbox-icon">
                                    <img src="{{asset('assets/img/front-pages/icons/FreightForwarding.png')}}" alt="FreightForwarding.png" width="65" />
                                </div>
                                <div class="text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('Freight Forwarding')}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-padding border-left-bottom">
                            <div class="">
                                <div class="text-center fbox-icon">
                                    <img src="{{asset('assets/img/front-pages/icons/WarehousingandDistribution.png')}}" alt="WarehousingandDistribution.png charging" width="65" />
                                </div>
                                <div class="text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('Warehousing and Distribution')}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-padding border-left-bottom">
                            <div class="">
                                <div class="text-center fbox-icon">
                                    <img src="{{asset('assets/img/front-pages/icons/CustomizedLogisticsSolutions.png')}}" alt="CustomizedLogisticsSolutions.png" width="65" />
                                </div>
                                <div class="text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('Customized Logistics Solutions')}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-padding border-left-bottom">
                            <div class="">
                                <div class="text-center fbox-icon">
                                    <img src="{{asset('assets/img/front-pages/icons/TrackandTrace.png')}}" alt="TrackandTrace" width="65" />
                                </div>
                                <div class=" text-center" style="padding: 0 0.75rem">
                                    <h5 class="card-title">{{__('Track and Trace')}}</h5>
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

    <!-- Our great team: End -->

    <section class="section">
        <div class="mt-5" style="overflow: hidden;">
            <div class="section m-0 text-center bg-body" style="padding: 60px 0;">
                <div class="clearfix">
                    <div class="mx-auto center" style="max-width: 900px;">
                        <h2 class="mb-0 fw-normal ls1">{{__('Our Warehouses')}}</h2>
                    </div>
                </div>
            </div>

            <div style="padding: 60px 0;">
                <div class="container mx-auto">
                    <div class="row posts-md mt-5 mb-0">
                        <div class="entry branches-padding-bottom col-md-6">
                            <div class="grid-inner row align-items-center">
                                <div class="col-lg-6">
                                    <div class="entry-image">
                                        <a href="{{route('branches-page', 'China')}}"><img src="{{asset('assets/img/front-pages/landing-page/china800x600.jpg')}}" alt="China warehouse"></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0" style="padding: 0 0.75rem">
                                    <span class="before-heading fst-normal">{{__('China')}}</span>
                                    <div class="entry-title nott">
                                        <h3 class="fw-normal"><a href="{{route('branches-page', 'China')}}">{{__('Hong Kong - Guangdong - Shanghai')}}</a></h3>
                                    </div>
                                    <div class="entry-content">
                                        <a href="{{route('branches-page', 'China')}}" class="more-link">{{__('Details')}} <i class="ti ti-chevron-right" style="width: 12px"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry branches-padding-bottom col-md-6">
                            <div class="grid-inner row align-items-center">
                                <div class="col-lg-6">
                                    <div class="entry-image">
                                        <a href="{{route('branches-page', 'Libya')}}"><img src="{{asset('assets/img/front-pages/landing-page/libya800x600.jpg')}}" alt="Libya warehouse"></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0" style="padding: 0 0.75rem">
                                    <span class="before-heading fst-normal">{{__('Libya')}}</span>
                                    <div class="entry-title nott">
                                        <h3 class="fw-normal"><a href="{{route('branches-page', 'Libya')}}">{{__('Tripoli - Misurata - Benghazi')}}</a></h3>
                                    </div>
                                    <div class="entry-content">
                                        <a href="{{route('branches-page', 'Libya')}}" class="more-link">{{__('Details')}} <i class="ti ti-chevron-right" style="width: 12px"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="entry branches-padding-bottom col-md-6">
                            <div class="grid-inner row align-items-center">
                                <div class="col-lg-6">
                                    <div class="entry-image">
                                        <a href="#"><img src="{{asset('assets/img/front-pages/landing-page/dubai800x600.jpg')}}" alt="Dubai warehouse"></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0" style="padding: 0 0.75rem">
                                    <span class="before-heading fst-normal">Dubai</span>
                                    <div class="entry-title nott">
                                        <h3 class="fw-normal"><a href="#">{{__('Al Hamriya - Jebel Ali - Fujairah - Mina Zayed - Khor Fakkan')}}</a></h3>
                                    </div>
                                    <div class="entry-content">
                                        <a href="{{route('branches-page', 'Dubai')}}" class="more-link">{{__('Details')}} <i class="ti ti-chevron-right" style="width: 12px"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="entry branches-padding-bottom col-md-6">
                            <div class="grid-inner row align-items-center">
                                <div class="col-lg-6">
                                    <div class="entry-image">
                                        <a href="{{route('branches-page', 'Italy')}}"><img src="{{asset('assets/img/front-pages/landing-page/italy800x600.jpg')}}" alt="italy warhouse"></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0" style="padding: 0 0.75rem">
                                    <span class="before-heading fst-normal">{{__('Italy')}}</span>
                                    <div class="entry-title nott">
                                        <h3 class="fw-normal"><a href="{{route('branches-page', 'Italy')}}">{{__('Roma, Prato, Venezia, Milano, Gioia Tauro Port')}}</a></h3>
                                    </div>
                                    <div class="entry-content">
                                        <a href="{{route('branches-page', 'Italy')}}" class="more-link">{{__('Details')}} <i class="ti ti-chevron-right" style="width: 12px"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry branches-padding-bottom col-md-6">
                            <div class="grid-inner row align-items-center">
                                <div class="col-lg-6">
                                    <div class="entry-image">
                                        <a href="{{route('branches-page', 'Algeria')}}"><img src="{{asset('assets/img/front-pages/landing-page/algeria800x600.jpg')}}" alt="algeria warhouse"></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0" style="padding: 0 0.75rem">
                                    <span class="before-heading fst-normal">{{__('Algeria')}}</span>
                                    <div class="entry-title nott">
                                        <h3 class="fw-normal"><a href="{{route('branches-page', 'Algeria')}}">{{__('Birkhadem, Algiers')}}</a></h3>
                                    </div>
                                    <div class="entry-content">
                                        <a href="{{route('branches-page', 'Algeria')}}" class="more-link">{{__('Details')}} <i class="ti ti-chevron-right" style="width: 12px"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry branches-padding-bottom col-md-6">
                            <div class="grid-inner row align-items-center">
                                <div class="col-lg-6">
                                    <div class="entry-image">
                                        <a href="{{route('branches-page', 'Turkey1')}}"><img src="{{asset('assets/img/front-pages/landing-page/turkey800x600.jpg')}}" alt="Turkey 1 warhouse"></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0" style="padding: 0 0.75rem">
                                    <span class="before-heading fst-normal">{{__('Turkey')}}</span>
                                    <div class="entry-title nott">
                                        <h3 class="fw-normal"><a href="{{route('branches-page', 'Turkey1')}}">{{__('Merter, Istanbul')}}</a></h3>
                                    </div>
                                    <div class="entry-content">
                                        <a href="{{route('branches-page', 'Turkey1')}}" class="more-link">{{__('Details')}} <i class="ti ti-chevron-right" style="width: 12px"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry branches-padding-bottom col-md-6">
                            <div class="grid-inner row align-items-center">
                                <div class="col-lg-6">
                                    <div class="entry-image">
                                        <a href="{{route('branches-page', 'Turkey2')}}"><img src="{{asset('assets/img/front-pages/landing-page/turkey2800x600.jpg')}}" alt="Turkey 2 warhouse"></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0" style="padding: 0 0.75rem">
                                    <span class="before-heading fst-normal">{{__('Turkey')}}</span>
                                    <div class="entry-title nott">
                                        <h3 class="fw-normal"><a href="{{route('branches-page', 'Turkey2')}}">{{__('Bağcılar, Istanbul')}}</a></h3>
                                    </div>
                                    <div class="entry-content">
                                        <a href="{{route('branches-page', 'Turkey2')}}" class="more-link">{{__('Details')}} <i class="ti ti-chevron-right" style="width: 12px"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry branches-padding-bottom col-md-6">
                            <div class="grid-inner row align-items-center">
                                <div class="col-lg-6">
                                    <div class="entry-image">
                                        <a href="{{route('branches-page', 'USA')}}"><img src="{{asset('assets/img/front-pages/landing-page/usa800x600.jpg')}}" alt="USA warhouse"></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0" style="padding: 0 0.75rem">
                                    <span class="before-heading fst-normal">{{__('USA')}}</span>
                                    <div class="entry-title nott">
                                        <h3 class="fw-normal"><a href="{{route('branches-page', 'USA')}}">{{__('Orlando, Florida')}}</a></h3>
                                    </div>
                                    <div class="entry-content">
                                        <a href="{{route('branches-page', 'USA')}}" class="more-link">{{__('Details')}} <i class="ti ti-chevron-right" style="width: 12px"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </d>
                </div>
            </div>
    </section>
    <!-- Fun facts: Start -->

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
                        <img src="{{asset('assets/img/front-pages/landing-page/faq-boy-with-logos.avif')}}" alt="faq boy with logos" class="faq-image" />
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="accordion" id="accordionExample">
                        <div class="card accordion-item active">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                    {{__('What items are prohibited from express air freight?')}}
                                </button>
                            </h2>

                            <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('For safety reasons, we prohibit the shipment of hazardous materials, illegal substances, batteries, perishable goods without proper packaging, and live animals. Please refer to our full list of prohibited items for more details.')}}
                                </div>
                            </div>
                        </div>
                       
                        
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionEight" aria-expanded="false" aria-controls="accordionEight">
                                    {{__('Is insurance available for my shipments?')}}
                                </button>
                            </h2>
                            <div id="accordionEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('Yes, we offer a range of insurance options to protect your shipment against loss or damage during transit. Contact our customer service for more information on coverage and costs.')}}
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionNine" aria-expanded="false" aria-controls="accordionNine">
                                    {{__('How do you ensure the security of my shipment?')}}
                                </button>
                            </h2>
                            <div id="accordionNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('We prioritize the security of your shipments with measures like 24/7 surveillance at our facilities, background checks for our staff, and secure transportation methods.')}}.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingTen">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTen" aria-expanded="false" aria-controls="accordionTen">
                                    {{__('Can I ship oversized or heavy items?')}}
                                </button>
                            </h2>
                            <div id="accordionTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('Absolutely. We have special services for oversized and heavy items, including custom crating and handling equipment to ensure safe and efficient transport.')}}
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingEleven">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionEleven" aria-expanded="false" aria-controls="accordionEleven">
                                    {{__('What is the maximum weight for express air freight?')}}
                                </button>
                            </h2>
                            <div id="accordionEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('The maximum weight for express air freight varies by destination and aircraft. Please contact us with the specifics of your shipment for an accurate assessment.')}}
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingTwelve">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwelve" aria-expanded="false" aria-controls="accordionTwelve">
                                    {{__('How are shipping costs calculated?')}}
                                </button>
                            </h2>
                            <div id="accordionTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('Shipping costs are based on the weight, dimensions, destination, and speed of delivery of your shipment. Additional services like insurance or special handling may affect the final cost.')}}
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
                    <a href="{{route('shipment-price')}}" class="btn btn-lg btn-primary">{{__('Calculate')}}</a>
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
            <h3 class="text-center mb-1"><span class="section-title">{{__("Get in touch")}}</span></h3>
            <p class="text-center mb-4 mb-lg-5 pb-md-3">{{__('We read every message')}}</p>
            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="contact-img-box position-relative border p-2 h-100">
                        <img src="{{asset('assets/img/front-pages/landing-page/contact-customer-service.avif')}}" alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
                        <div class="pt-3 px-4 pb-1">
                            <div class="row gy-3 gx-md-4">
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-primary rounded p-2 me-2"><i class="ti ti-mail ti-sm"></i></div>
                                        <div>
                                            <p class="mb-0">{{__('Email')}}</p>
                                            <h5 class="mb-0">
                                                <a href="mailto:info@janahx.com<" class="text-heading">info@janahx.com</a>
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
                                            <h5 class="mb-0"><a href="tel:+905538093793" class="text-heading">{{__('+90-553-809-3793')}}</a></h5>
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
                            <h4 class="mb-1">{{__('Info panel')}}</h4>
                            <p class="mb-4">
                                {{__("You're in the right place for everything related to shipping.")}}<br class="d-none d-lg-block" />
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
                                        <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
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