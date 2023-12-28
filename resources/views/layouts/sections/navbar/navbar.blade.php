@php
$containerNav = ($configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme"
    id="layout-navbar">
    @endif
    @if(isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{$containerNav}}">
            @endif

            <!--  Brand demo (display only for navbar-full and hide on below xl) -->
            @if(isset($navbarFull))
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                <a href="{{url('/dashboard')}}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                        @include('_partials.macros',["height"=>20])
                    </span>
                    <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
                </a>
            </div>
            @endif

            <!-- ! Not required for layout-without-menu -->
            @if(!isset($navbarHideToggle))
            <div
                class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                    <i class="ti ti-menu-2 ti-sm"></i>
                </a>
            </div>
            @endif

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                @if($configData['hasCustomizer'] == true)
                <!-- Style Switcher -->

                <!--/ Style Switcher -->
                @endif

                <ul class="navbar-nav flex-row align-items-center ms-auto">

                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                            data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="{{ isset(Auth::user()->profile_photo_url) ? Auth::user()->profile_photo_url : asset('assets/img/avatars/3.png') }}"
                                    alt class="h-auto rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item"
                                    href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="{{ isset(Auth::user()->profile_photo_url) ? Auth::user()->profile_photo_url : asset('assets/img/avatars/3.png') }}"
                                                    alt class="h-auto rounded-circle">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-medium d-block">
                                                @if (Auth::check())
                                                {{ Auth::user()->name }}
                                                @else
                                                John Doe
                                                @endif
                                            </span>
                                            <small class="text-muted">Admin</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
                                    <i class="ti ti-user-check me-2 ti-sm"></i>
                                    <span class="align-middle">{{ __('My Profile') }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="" id="changeLocale">
                                    <i class="ti ti-language me-2 ti-sm"></i>
                                    <span
                                        class="align-middle">{{ app()->getLocale() == 'en' ? 'عربي' : 'English' }}</span></span>

                                </a>

                            </li>
                            <li>
                                <a class="dropdown-item changeMode" href="javascript:void(0);" data-theme="light">
                                    <span class="align-middle"><i
                                            class='ti ti-sun me-2'></i>{{ __('Change Mode') }}</span>
                                </a>
                            </li>
                            {{-- @if (Auth::check() && Laravel\Jetstream\Jetstream::hasApiFeatures())
              <li>
                <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                            <i class='ti ti-key me-2 ti-sm'></i>
                            <span class="align-middle">API Tokens</span>
                            </a>
                    </li>
                    @endif --}}
                    {{-- @if (Auth::User() && Laravel\Jetstream\Jetstream::hasTeamFeatures())
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <h6 class="dropdown-header">Manage Team</h6>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ Auth::user() ? route('teams.show', Auth::user()->currentTeam->id) : 'javascript:void(0)' }}">
                    <i class='ti ti-settings me-2'></i>
                    <span class="align-middle">Team Settings</span>
                    </a>
                    </li> --}}
                    {{-- @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
              <li>
                <a class="dropdown-item" href="{{ route('teams.create') }}">
                    <i class='ti ti-user me-2'></i>
                    <span class="align-middle">Create New Team</span>
                    </a>
                    </li>
                    @endcan --}}
                    {{-- @if (Auth::user()->allTeams()->count() > 1)
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <h6 class="dropdown-header">Switch Teams</h6>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              @endif
              @if (Auth::user())
              @foreach (Auth::user()->allTeams() as $team)
              {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}

                    {{-- <x-switchable-team :team="$team" /> --}}
                    {{-- @endforeach
              @endif
              @endif --}}
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    @if (Auth::check())
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class='ti ti-logout me-2'></i>
                            <span class="align-middle">{{__('Logout')}}</span>
                        </a>
                    </li>
                    <form method="POST" id="logout-form" action="{{ route('logout') }}">
                        @csrf
                    </form>
                    @else
                    <li>
                        <a class="dropdown-item"
                            href="{{ Route::has('login') ? route('login') : url('auth/login-basic') }}">
                            <i class='ti ti-login me-2'></i>
                            <span class="align-middle">{{ __('Login') }}</span>
                        </a>
                    </li>
                    @endif
                </ul>
                </li>
                <!--/ User -->
                </ul>
            </div>

            @if(!isset($navbarDetached))
        </div>
        @endif
    </nav>
    <!-- / Navbar -->

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

        var storageKeyLocaleVertical = 'templateCustomizer-vertical-menu-theme-default-light--Rtl';
        var storageKeyModeVertical = 'templateCustomizer-vertical-menu-theme-default-light--Style';

        var localeKey = 'locale';

        var isRtl = localStorage.getItem(storageKeyLocale) === 'true';
        var currentMode = localStorage.getItem(storageKeyMode) || 'light';

        var iconElement = $('#modeIcon');
        iconElement.attr('class', currentMode === 'dark' ? 'ti ti-sun me-2' : 'ti ti-moon me-2');

        var isRtlVertical = localStorage.getItem(storageKeyLocaleVertical) === 'true';
        var currentModeVertical = localStorage.getItem(storageKeyModeVertical) || 'light';

        // Get current mode and set icon
        var modeCookie = localStorage.getItem(storageKeyMode);
        var defaultValue = 'dark'; // Set your default mode value here

        // Initialize refreshNeeded variable
        var refreshNeeded = false;
        var refreshLocaleNeeded = false;


        // Check if mode is different from default
        if (!modeCookie) {
            refreshNeeded = true;
        }

        var localeCookie = localStorage.getItem(localeKey);
        var locale = "{{ app()->getLocale() }}";

        if (localeCookie && localeCookie !== locale) {
            refreshLocaleNeeded = true;
        }

        createStorageKeyIfNotExist(storageKeyLocale, false);
        createStorageKeyIfNotExist(storageKeyMode, 'dark');
        createStorageKeyIfNotExist(storageKeyLocaleVertical, false);
        createStorageKeyIfNotExist(storageKeyModeVertical, 'dark');
        createStorageKeyIfNotExist(localeKey, 'en');

        // Perform refresh if needed and not on the initial page load

        if (refreshLocaleNeeded) {
            var localeCookie = localStorage.getItem(localeKey);
            var url = '{{ route("changeLocale", ["locale" => ":locale"]) }}';
            url = url.replace(':locale', localeCookie);
            // Update the link's href attribute
            changeLocaleButton.attr('href', url);
            // Navigate to the new URL
            window.location.href = url;
        } else if (refreshNeeded) {
            window.location.reload();
        }

        function createStorageKeyIfNotExist(key, defaultValue) {
            if (localStorage.getItem(key) === null) {
                localStorage.setItem(key, defaultValue.toString());
            }
        }
        // modeIcon.attr('class', (currentMode === 'light') ? 'ti ti-moon me-2 ti-sm' : 'ti ti-sun me-2 ti-sm');

        // Function to toggle the value in local storage and navigate to the appropriate URL
        function toggleLocale() {
            isRtl = !isRtl;
            localStorage.setItem(storageKeyLocale, isRtl.toString());

            isRtlVertical = !isRtlVertical;
            localStorage.setItem(storageKeyLocaleVertical, isRtlVertical.toString());

            // Construct the URL based on the new value
            var locale = "{{ app()->getLocale() }}";

            locale = locale == 'en' ? 'ar' : 'en';

            localStorage.setItem(localeKey, locale.toString());

            var url = '{{ route("changeLocale", ["locale" => ":locale"]) }}';
            url = url.replace(':locale', locale);

            // Update the link's href attribute
            changeLocaleButton.attr('href', url);

            // Navigate to the new URL
            window.location.href = url;
            // location.reload();
        }

        // Function to toggle the mode and update the UI accordingly
        function toggleMode() {
            currentMode = (currentMode === 'light') ? 'dark' : 'light';
            localStorage.setItem(storageKeyMode, currentMode);

            currentModeVertical = (currentModeVertical === 'light') ? 'dark' : 'light';
            localStorage.setItem(storageKeyModeVertical, currentModeVertical);

            location.reload();
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