@php
$currentRouteName = Route::currentRouteName();
$activeRoutes = ['front-pages-pricing', 'front-pages-payment', 'front-pages-checkout', 'front-pages-help-center'];
$activeClass = in_array($currentRouteName, $activeRoutes) ? 'active' : '';
@endphp
<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-0">
    <div class="container">
        <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4">
            <!-- Menu logo wrapper: Start -->
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                <!-- Mobile menu toggle: Start-->
                <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-menu-2 ti-sm align-middle"></i>
                </button>
                <!-- Mobile menu toggle: End-->
                <a href="{{route('landing-page')}}" class="app-brand-link" dir="ltr">
                    <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' => "fill:
                        #fff;"])</span>
                    <span
                        class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{ config('variables.templateName') }}</span>
                </a>
            </div>
            <!-- Menu logo wrapper: End -->
            <!-- Menu wrapper: Start -->
            <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                    type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-x ti-sm"></i>
                </button>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-medium" aria-current="page"
                            href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#landingFeatures">{{__('Services')}}</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link fw-medium" href="#landingTeam">Team</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#landingFAQ">{{__('FAQ')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#landingContact">{{__('Contact us')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{route('shipment-price')}}">{{__('Shipping Price')}}</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{url('/dashboard')}}" target="_blank">Admin</a>
                    </li> -->
                </ul>
            </div>
            <div class="landing-menu-overlay d-lg-none"></div>
            <!-- Menu wrapper: End -->
            <!-- Toolbar: Start -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- $configData['hasCustomizer'] -->
                <!-- Style Switcher -->

                <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class='ti ti-sm'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                        <li>
                            <a class="dropdown-item changeMode" href="javascript:void(0);" data-theme="light">
                                <span class="align-middle"><i class='ti ti-sun me-2'></i>{{__('Light')}}</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item changeMode" href="javascript:void(0);" data-theme="dark">
                                <span class="align-middle"><i class="ti ti-moon me-2"></i>{{__('Dark')}}</span>
                            </a>
                        </li>
                        <!-- <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0)" data-bs-toggle="dropdown">
                        <i class='ti ti-language me-2 ti-sm'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" id="changeLocale">
                                <span class="align-middle">{{ app()->getLocale() == 'en' ? 'عربي' : 'English' }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- / Style Switcher-->
                <!-- navbar button: Start -->
                @guest
                <li>
                    <a href="{{route('login')}}" class="btn btn-primary"><span
                            class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span><span
                            class="d-none d-md-block">{{__('Login/Register')}}</span></a>
                </li>
                @else
                <li>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span>
                        <span class="d-none d-md-block">{{__('Logout')}}</span>
                    </a>
                    <form method="POST" id="logout-form" action="{{ route('logout') }}">
                        @csrf
                    </form>
                </li>

                @endguest

                <!-- navbar button: End -->
            </ul>
            <!-- Toolbar: End -->
        </div>
    </div>
</nav>
<!-- Navbar: End -->

<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script>
$(document).ready(function() {
    // Get the elements that represent the buttons
    var changeLocaleButton = $('#changeLocale');
    var changeModeButton = $('.changeMode');
    // var modeIcon = $('#modeIcon');

    // Check local storage for the specified keys
    var storageKeyLocale = 'templateCustomizer-front-menu-theme-default-light--Rtl';
    var storageKeyMode = 'templateCustomizer-front-menu-theme-default-light--Style';

    var isRtl = localStorage.getItem(storageKeyLocale) === 'true';
    var currentMode = localStorage.getItem(storageKeyMode) || 'light';
    // modeIcon.attr('class', (currentMode === 'light') ? 'ti ti-moon me-2 ti-sm' : 'ti ti-sun me-2 ti-sm');


    // Function to toggle the value in local storage and navigate to the appropriate URL
    function toggleLocale() {
        isRtl = !isRtl;
        localStorage.setItem(storageKeyLocale, isRtl.toString());

        // Construct the URL based on the new value
        var locale = isRtl ? 'ar' : 'en';
        // var url = './change-locale/' + locale;
        var url = '{{ route("changeLocale", ["locale" => ":locale"]) }}';
        url = url.replace(':locale', locale);

        // Update the link's href attribute
        changeLocaleButton.attr('href', url);

        // Navigate to the new URL
        // window.location.href = url;
        window.reload();

    }

    // Function to toggle the mode and update the UI accordingly
    function toggleMode() {
        currentMode = (currentMode === 'light') ? 'dark' : 'light';
        localStorage.setItem(storageKeyMode, currentMode);

        // Update the UI or perform any other actions based on the mode change
        // Example: You can toggle CSS classes or update theme styles here
        // document.body.classList.toggle('dark-mode', currentMode === 'dark');
        window.reload();
    }

    // Attach click event handlers to the buttons
    changeLocaleButton.on('click', function(event) {
        toggleLocale();
        event.preventDefault();
    });

    changeModeButton.on('click', function(event) {
        toggleMode();
        event.preventDefault();
    });
});
</script>