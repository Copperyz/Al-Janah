<!-- Footer: Start -->
<footer class="landing-footer bg-body footer-text">
    <div class="footer-top">
        <div class="container">
            <div class="row gx-0 gy-4 g-md-5">
                <div class="col-lg-6">
                    <a href="{{route('landing-page')}}"
                        class="app-brand-link mb-4 @if(app()->getLocale() == 'ar') justify-content-end @endif"
                        dir="ltr">
                        <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' => "fill:
                            #fff;"])</span>
                        <span
                            class="app-brand-text demo footer-link fw-bold ms-2 ps-1">{{ config('variables.templateName') }}</span>
                    </a>
                    <p class="footer-text mb-6" style="text-align: justify;">
                        {{__('ALJANAH Company is a specialized firm in the field of shipping and express logistics services, providing comprehensive and tailored solutions for all your shipping needs. ALJANAH Company boasts a professional team of experts in air freight who work efficiently and precisely to ensure the timely arrival of your shipment at its destination at the lowest cost. Additionally, ALJANAH Company possesses an extensive network of relationships with global shipping and transportation companies and institutions, enabling it to offer diverse and flexible services to its clients. ALJANAH Shipping Company is the company that meets and exceeds your expectations if you are looking for fast, premium, and competitively priced air freight services.')}}<br>

                    </p>
                    <!-- <form class="footer-form">
                        <label for="footer-email" class="small">Subscribe to newsletter</label>
                        <div class="d-flex mt-1">
                            <input type="email" class="form-control rounded-0 rounded-start-bottom rounded-start-top"
                                id="footer-email" placeholder="Your email" />
                            <button type="submit"
                                class="btn btn-primary shadow-none rounded-0 rounded-end-bottom rounded-end-top">
                                Subscribe
                            </button>
                        </div>
                    </form> -->
                </div>
                <div class="col-lg-6">
                    <h4 class="footer-title mb-4">{{__('What We Do')}}</h4>

                    <p class="footer-text mb-6" style="text-align: justify;">
                        {{__('We deliver all types of cargo from Libya to all around the world, whether it were Full Shipments, Shared Shipments, or Air Freight. Completing all paperwork and procedures required with due diligance, and also delivering cargo from Libya to all around the globe')}}.
                    </p>
                    <!-- <form class="footer-form">
                        <label for="footer-email" class="small">Subscribe to newsletter</label>
                        <div class="d-flex mt-1">
                            <input type="email" class="form-control rounded-0 rounded-start-bottom rounded-start-top"
                                id="footer-email" placeholder="Your email" />
                            <button type="submit"
                                class="btn btn-primary shadow-none rounded-0 rounded-end-bottom rounded-end-top">
                                Subscribe
                            </button>
                        </div>
                    </form> -->
                </div>

                <div class="col-md-6 text-center mt-2">
                    <h6 class="footer-title mb-4">{{__('Menu')}}</h6>
                    <ul class="list-unstyled d-flex justify-content-center gap-5">
                        <li class="mb-3">
                            <a class="footer-link" aria-current="page"
                                href="{{route('landing-page')}}">{{__('Home')}}</a>
                        </li>
                        <li class="mb-3">
                            <a class="footer-link" href="#landingFeatures">{{__('Services')}}</a>
                        </li>
                        <li class="mb-3">
                            <a class="footer-link" href="#landingFAQ">{{__('FAQ')}}</a>
                        </li>
                        <li class="mb-3">
                            <a class="footer-link" href="#landingContact">{{__('Contact us')}}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 text-center mt-2">
                    <h6 class="footer-title mb-4">{{__('Pages')}}</h6>
                    <ul class="list-unstyled d-flex justify-content-center gap-5">
                        <li class="mb-3">
                            <a href="javascript:;" class="footer-link"
                                href="{{route('shipment-price')}}">{{__('Shipping Price')}}</a>
                        </li>
                        <li class="mb-3">
                            <a href="javascript:;" class="footer-link">{{__('Shipment tracking')}}</a>
                        </li>
                    </ul>
                </div>
                <!-- <div class="col-lg-3 col-md-4">
                    <h6 class="footer-title mb-4">Download our app</h6>
                    <a href="javascript:void(0);" class="d-block footer-link mb-3 pb-2"><img
                            src="{{asset('assets/img/front-pages/landing-page/apple-icon.png')}}"
                            alt="apple icon" /></a>
                    <a href="javascript:void(0);" class="d-block footer-link"><img
                            src="{{asset('assets/img/front-pages/landing-page/google-play-icon.png')}}"
                            alt="google play icon" /></a>
                </div> -->
            </div>
        </div>
    </div>
    <div class="footer-bottom py-3">
        <div
            class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
            <div class="mb-2 mb-md-0">
                <span class="footer-text">©
                    <script>
                    document.write(new Date().getFullYear());
                    </script>
                </span>
                <span class="footer-text">
                    {{config('variables.templateName')}}.</span>
            </div>
            <div>
                <a href="{{config('variables.githubFreeUrl')}}" class="footer-link me-3" target="_blank">
                    <img src="{{asset('assets/img/front-pages/icons/github-'.$configData['style'].'.png') }}"
                        alt="github icon" data-app-light-img="front-pages/icons/github-light.png"
                        data-app-dark-img="front-pages/icons/github-dark.png" />
                </a>
                <a href="{{config('variables.facebookUrl')}}" class="footer-link me-3" target="_blank">
                    <img src="{{asset('assets/img/front-pages/icons/facebook-'.$configData['style'].'.png') }}"
                        alt="facebook icon" data-app-light-img="front-pages/icons/facebook-light.png"
                        data-app-dark-img="front-pages/icons/facebook-dark.png" />
                </a>
                <a href="{{config('variables.twitterUrl')}}" class="footer-link me-3" target="_blank">
                    <img src="{{asset('assets/img/front-pages/icons/twitter-'.$configData['style'].'.png') }}"
                        alt="twitter icon" data-app-light-img="front-pages/icons/twitter-light.png"
                        data-app-dark-img="front-pages/icons/twitter-dark.png" />
                </a>
                <a href="{{config('variables.instagramUrl')}}" class="footer-link" target="_blank">
                    <img src="{{asset('assets/img/front-pages/icons/instagram-'.$configData['style'].'.png') }}"
                        alt="google icon" data-app-light-img="front-pages/icons/instagram-light.png"
                        data-app-dark-img="front-pages/icons/instagram-dark.png" />
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- Footer: End -->