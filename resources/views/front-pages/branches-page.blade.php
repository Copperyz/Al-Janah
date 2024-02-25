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
                    <div class="swiper-slide" style="background-image: url({{asset('assets/img/backgrounds/2.jpg')}})">
                    </div>
                    <div class="swiper-slide" style="background-image: url({{asset('assets/img/backgrounds/3.jpg')}})">
                    </div>
                    <div class="swiper-slide" style="background-image: url({{asset('assets/img/backgrounds/1.jpg')}})">
                    </div>
                    <div class="swiper-slide" style="background-image: url({{asset('assets/img/backgrounds/5.jpg')}})">
                    </div>
                    <div class="swiper-slide" style="background-image: url({{asset('assets/img/backgrounds/2.jpg')}})">
                    </div>
                    <div class="swiper-slide" style="background-image: url({{asset('assets/img/backgrounds/3.jpg')}})">
                    </div>
                    <div class="swiper-slide" style="background-image: url({{asset('assets/img/backgrounds/1.jpg')}})">
                    </div>
                    <div class="swiper-slide" style="background-image: url({{asset('assets/img/backgrounds/5.jpg')}})">
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="slider-arrow-left"><i class="ti ti-chevron-left"></i></div>
                <div class="slider-arrow-right"><i class="ti ti-chevron-right"></i></div>
            </div>
            <div class="swiper-container slider-thumbs">
                <div class="swiper-wrapper h-auto">
                    <div class="swiper-slide"> <img src="{{asset('assets/img/backgrounds/2.jpg')}}" alt="image"></div>
                    <div class="swiper-slide"> <img src="{{asset('assets/img/backgrounds/3.jpg')}}" alt="image"></div>
                    <div class="swiper-slide"> <img src="{{asset('assets/img/backgrounds/1.jpg')}}" alt="image"></div>
                    <div class="swiper-slide"> <img src="{{asset('assets/img/backgrounds/5.jpg')}}" alt="image"></div>
                    <div class="swiper-slide"> <img src="{{asset('assets/img/backgrounds/2.jpg')}}" alt="image"></div>
                    <div class="swiper-slide"> <img src="{{asset('assets/img/backgrounds/3.jpg')}}" alt="image"></div>
                    <div class="swiper-slide"> <img src="{{asset('assets/img/backgrounds/1.jpg')}}" alt="image"></div>
                    <div class="swiper-slide"> <img src="{{asset('assets/img/backgrounds/5.jpg')}}" alt="image"></div>
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

                        <div class="row gutter-50 justify-content-between">
                            <div class="col-md-6">
                                <!-- Portfolio Single - Description
                        ============================================= -->
                                <h2>Your Portfolio Title</h2>
                                <p class="op-07 fw-normal lead font-primary">Illum molestias cupiditate eveniet dolore
                                    obcaecati voluptatibus est quos eos id recusandae officia.</p>
                                <p class="op-07">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur voluptas,
                                    omnis libero nesciunt quia, vero mollitia dolorum sint quae at dignissimos, et
                                    architecto est aperiam repellendus reprehenderit. Eveniet accusamus aperiam ut illo
                                    animi officia. Voluptatibus nemo atque voluptas illum sed suscipit perferendis fuga
                                    similique nam debitis, labore iste molestiae quas asperiores. Et commodi alias est odio
                                    magnam, ab reprehenderit. Beatae, soluta placeat repellat sunt facere iste ipsa,
                                    similique. Recusandae accusantium ullam consequatur quae a nihil magnam est sunt
                                    blanditiis explicabo? Aliquid corrupti, officiis blanditiis corporis deserunt quibusdam,
                                    ea asperiores a excepturi odit obcaecati natus. Possimus expedita libero animi
                                    cupiditate autem.</p>
                                <!-- Portfolio Single - Description End -->
                            </div>
                            <div class="col-md-5">
                                <!-- Portfolio Single - Meta
                        ============================================= -->
                                <ul class="portfolio-meta">
                                    <li><span><i class="icon-user"></i>Created by:</span> John Doe</li>
                                    <li><span><i class="icon-calendar3"></i>Completed on:</span> 17th March 2021</li>
                                    <li><span><i class="icon-lightbulb"></i>Skills:</span> HTML5 / PHP / CSS3</li>
                                    <li><span><i class="icon-link"></i>Client:</span> <a href="#">Google</a></li>
                                </ul><!-- Portfolio Single - Meta End -->

                                <div class="line my-4"></div>

                                <!-- Portfolio Single - Share
                        ============================================= -->
                                <!-- <div class="d-flex justify-content-between align-items-center">
                                <span>Share:</span>
                                <div>
                                    <a href="#" class="social-icon si-small si-light si-facebook">
                                        <i class="icon-facebook"></i>
                                        <i class="icon-facebook"></i>
                                    </a>
                                    <a href="#" class="social-icon si-small si-light si-twitter">
                                        <i class="icon-twitter"></i>
                                        <i class="icon-twitter"></i>
                                    </a>
                                    <a href="#" class="social-icon si-small si-light si-pinterest">
                                        <i class="icon-pinterest"></i>
                                        <i class="icon-pinterest"></i>
                                    </a>
                                    <a href="#" class="social-icon si-small si-light si-gplus">
                                        <i class="icon-gplus"></i>
                                        <i class="icon-gplus"></i>
                                    </a>
                                    <a href="#" class="social-icon si-small si-light si-rss">
                                        <i class="icon-rss"></i>
                                        <i class="icon-rss"></i>
                                    </a>
                                    <a href="#" class="social-icon si-small si-light si-email3">
                                        <i class="icon-email3"></i>
                                        <i class="icon-email3"></i>
                                    </a>
                                </div>
                            </div>Portfolio Single - Share End -->
                            </div>
                        </div>

                    </div><!-- .portfolio-single-content end -->

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
            loopedSlides: 4
        });
        var sliderThumbs = new Swiper('.slider-thumbs', {
            spaceBetween: 10,
            centeredSlides: true,
            slidesPerView: 'auto',
            touchRatio: 0.2,
            slideToClickedSlide: true,
            loop: true,
            loopedSlides: 4
        });

        sliderTop.controller.control = sliderThumbs;
        sliderThumbs.controller.control = sliderTop;
    });
</script>
@endsection