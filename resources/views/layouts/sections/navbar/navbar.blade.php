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
                <a href="{{url('/')}}" class="app-brand-link gap-2">
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
                                <a class="dropdown-item" href="" id="changeMode">
                                    <!-- Assuming you have a sun icon for light mode and a moon icon for dark mode -->
                                    <i id="modeIcon"></i>
                                    <span class="align-middle">{{ __('Change Mode') }}</span></span>
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
        var changeModeButton = $('#changeMode');
        var modeIcon = $('#modeIcon');

        // Check local storage for the specified keys
        var storageKeyLocale = 'templateCustomizer-vertical-menu-theme-default-light--Rtl';
        var storageKeyMode = 'templateCustomizer-vertical-menu-theme-default-light--Style';

        var isRtl = localStorage.getItem(storageKeyLocale) === 'true';
        var currentMode = localStorage.getItem(storageKeyMode) || 'light';
        modeIcon.attr('class', (currentMode === 'light') ? 'ti ti-moon me-2 ti-sm' : 'ti ti-sun me-2 ti-sm');


        // Function to toggle the value in local storage and navigate to the appropriate URL
        function toggleLocale() {
            isRtl = !isRtl;
            localStorage.setItem(storageKeyLocale, isRtl.toString());

            // Construct the URL based on the new value
            var locale = isRtl ? 'ar' : 'en';
            var url = './change-locale/' + locale;

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
            document.body.classList.toggle('dark-mode', currentMode === 'dark');
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