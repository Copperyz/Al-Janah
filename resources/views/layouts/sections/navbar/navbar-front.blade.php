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
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="ti ti-menu-2 ti-sm align-middle"></i>
                </button>
                <!-- Mobile menu toggle: End-->
                <a href="{{ route('landing-page') }}" class="app-brand-link" dir="ltr">
                    <span class="app-brand-logo demo">@include('_partials.macros', [
                        'height' => 20,
                        'withbg' => "fill:
                                                                                                                                                                                                                                                                                                                                                                            #fff;",
                    ])</span>
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
                    @auth
                        <li class="nav-item">
                            <a class="nav-link fw-medium" aria-current="page"
                                href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#landingFeatures">{{ __('Services') }}</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link fw-medium" href="#landingTeam">Team</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#landingFAQ">{{ __('FAQ') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#landingContact">{{ __('Contact') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{ route('shipment-price') }}">{{ __('Rates') }}</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{ url('/dashboard') }}" target="_blank">Admin</a>
                    </li> -->
                </ul>
                <!-- Toolbar: Start -->
                <ul class="navbar-nav ms-auto">
                    <!-- $configData['hasCustomizer'] -->
                    <!-- Style Switcher -->

                    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                        <a class="nav-link me-2 me-xl-0 changeMode" href="javascript:void(0);" data-theme="light">
                            <i id="modeIcon" class="me-2"></i>
                            <span class="d-sm-none" id="themeToggleText">{{ __('Change Mode') }}</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0)"
                            data-bs-toggle="dropdown">
                            <i class="ti ti-language me-2 ti-sm"></i>
                            <span id="changeLocaleMobile"
                                class="align-middle d-sm-none">{{ app()->getLocale() == 'en' ? 'عربي' : 'English' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" id="changeLocale">
                                    <span
                                        class="align-middle">{{ app()->getLocale() == 'en' ? 'عربي' : 'English' }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>


                <!-- / Style Switcher-->
                </ul>

                <!-- Toolbar: End -->
            </div>
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                @guest
                    <li>
                        <a href="{{ route('login') }}" class="btn btn-primary"><span
                                class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span><span
                                class="d-none d-md-block">{{ __('Sign in') }}</span></a>
                    </li>
                @else
                    <li>
                        <a class="btn btn-primary" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span>
                            <span class="d-none d-md-block">{{ __('Logout') }}</span>
                        </a>
                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </li>

                @endguest
            </ul>
            <div class="landing-menu-overlay d-lg-none"></div>
            <!-- Menu wrapper: End -->

        </div>
    </div>
</nav>
<!-- Navbar: End -->

<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script>
    $(document).ready(function() {
        var changeLocaleButton = $('#changeLocale');
        var changeModeButton = $('.changeMode');
        var changeLocaleMobileButton = $('#changeLocaleMobile');

        var storageKeys = {
            locale: 'locale',
            mode: 'templateCustomizer-front-menu-theme-default-light--Style',
            rtl: 'templateCustomizer-front-menu-theme-default-light--Rtl',
            modeVertical: 'templateCustomizer-vertical-menu-theme-default-light--Style',
            rtlVertical: 'templateCustomizer-vertical-menu-theme-default-light--Rtl'
        };

        var allKeysExist = true;

        for (var key in storageKeys) {
            if (localStorage.getItem(storageKeys[key]) === null) {
                allKeysExist = false;
                break;
            }
        }

        if (!allKeysExist) {
            createStorageKeyIfNotExist(storageKeys.locale, 'en');
            createStorageKeyIfNotExist(storageKeys.mode, 'dark');
            createStorageKeyIfNotExist(storageKeys.rtl, false);
            createStorageKeyIfNotExist(storageKeys.modeVertical, 'dark');
            createStorageKeyIfNotExist(storageKeys.rtlVertical, false);
            window.location.reload();
        }

        var locale = localStorage.getItem(storageKeys.locale) || "{{ app()->getLocale() }}";
        var currentMode = localStorage.getItem(storageKeys.mode) || 'light';
        var isRtl = locale === 'ar';

        $('#modeIcon').attr('class', currentMode === 'dark' ? 'ti ti-sun me-2' : 'ti ti-moon me-2');

        function toggleLocale() {
            var newLocale = locale === 'en' ? 'ar' : 'en';
            localStorage.setItem(storageKeys.locale, newLocale);
            localStorage.setItem(storageKeys.rtl, newLocale === 'ar');
            localStorage.setItem(storageKeys.rtlVertical, newLocale === 'ar');
            updateLocaleURL(newLocale);
        }

        function updateLocaleURL(locale) {
            var url = '{{ route('changeLocale', ['locale' => ':locale']) }}';
            url = url.replace(':locale', locale);
            window.location.href = url;
        }

        function toggleMode() {
            var newMode = currentMode === 'light' ? 'dark' : 'light';
            localStorage.setItem(storageKeys.mode, newMode);
            localStorage.setItem(storageKeys.modeVertical, newMode);
            window.location.reload();
        }

        function createStorageKeyIfNotExist(key, defaultValue) {
            if (localStorage.getItem(key) === null) {
                localStorage.setItem(key, defaultValue.toString());
            }
        }

        changeLocaleButton.on('click', function(event) {
            event.preventDefault();
            toggleLocale();
        });

        changeLocaleMobileButton.on('click', function(event) {
            event.preventDefault();
            toggleLocale();
        });

        changeModeButton.on('click', function(event) {
            event.preventDefault();
            toggleMode();
        });
    });
</script>
