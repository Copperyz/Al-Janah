@php
$customizerHidden = 'customizer-hide';

$configData = Helper::appClasses();

@endphp

@extends('layouts/layoutMaster')

@section('title', __('branches'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/ui-carousel.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/our-branches.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/swiper.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/ui-carousel.js')}}"></script>
@endsection
<style>
    .portfolio-single-content h2 {
        font-size: 1.75rem;
    }

    .portfolio-meta {
        font-size: 1rem;
    }

    .portfolio-meta li {
        margin-bottom: 1rem;
    }

    /* Swiper */
    .slider-top .swiper-slide {
        width: 100%;
        height: 100%;
        min-height: 500px;
        background-size: cover;
        background-position: center center;
    }

    @media (min-width: 992px) {
        .slider-top .swiper-slide {
            width: 85%;
            min-height: 550px;
        }
    }

    .slider-thumbs {
        padding: 10px 0;
    }

    .slider-thumbs .swiper-slide {
        width: 23%;
        height: 100%;
        opacity: 0.3;
    }

    .slider-thumbs .swiper-slide-active {
        opacity: 1;
    }
</style>
@section('content')
<section class="section">
    <div id="wrapper">

        <section id="slider" class="slider-element swiper_wrapper customjs h-auto">
            <div class="swiper-container swiper-parent slider-top">
                <div class="swiper-wrapper h-auto">
                    @for($i = 1; $i <= $numberOfImage; $i++)
                    <div class="swiper-slide" 
                        style="background-image: url({{asset('assets/img/front-pages/landing-page/' .$branch. '/' .$i. '.jpg')}})">
                    </div>
                    @endfor
                </div>
                <!-- Add Arrows -->
                <div class="slider-arrow-left"><i class="ti ti-chevron-left"></i></div>
                <div class="slider-arrow-right"><i class="ti ti-chevron-right"></i></div>
            </div>
            <div class="swiper-container slider-thumbs">
                <div class="swiper-wrapper h-auto">
                    @for($i = 1; $i <= $numberOfImage; $i++)
                        <div class="swiper-slide"> <img src="{{asset('assets/img/front-pages/landing-page/' .$branch. '/' .$branch. '/' .$i. '.jpg')}}" alt="image"></div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- Content
============================================= -->
        <section id="content">
            <div class="content-wrap">

                <div class="container">

                    <!-- Portfolio Single Content
            ============================================= -->
                    <div class="portfolio-single-content">
                            @foreach($warehouse['title'] as $key => $value)
                            <div class="row gutter-50 justify-content-between">
                                <div class="col-md-6" style="margin: 4em 0;">
                                    <!-- Portfolio Single - Description
                                ============================================= -->
                                    <h2>{{__($value)}}</h2>
                                    <p class="op-07 fw-normal lead font-primary">{{__($warehouse['description'][$key])}}</p>
                                    
                                    <!-- Portfolio Single - Description End -->
                                </div>
                                @if(isset($warehouse['addresses'][$key]))
                                <div class="col-md-5" style="margin: 4em 0;">
                                    <ul class="portfolio-meta">
                                    <li style="line-height: 2.5;">{!! nl2br(e($warehouse['addresses'][$key])) !!}</li>
                                    </ul>

                                    <div class="line my-4"></div>

                                </div>
                                @endif
                            </div>
                            @endforeach 
                        
                    </div>
                </div>
            </div>
        </section><!-- #content end -->

    </div><!-- #wrapper end -->
</section>
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="../assets/js/functions.js"></script>
<script>
    jQuery(window).on('pluginSwiperReady', function() {
        var sliderTop = new Swiper('.slider-top', {
            spaceBetween: 10,
            slidesPerView: 'auto',
            centeredSlides: true,
            navigation: {
                nextEl: '.slider-arrow-right',
                prevEl: '.slider-arrow-left',
            },
            loop: true,
            loopedSlides: 3
        });
        var sliderThumbs = new Swiper('.slider-thumbs', {
            spaceBetween: 10,
            centeredSlides: true,
            slidesPerView: 'auto',
            touchRatio: 0.2,
            slideToClickedSlide: true,
            loop: true,
            loopedSlides: 3
        });

        sliderTop.controller.control = sliderThumbs;
        sliderThumbs.controller.control = sliderTop;
    });
</script>
@endsection