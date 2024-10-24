@php
    $containerNav = $configData['contentLayout'] === 'compact' ? 'container-xxl' : 'container-fluid';
    $navbarDetached = $navbarDetached ?? '';
@endphp

<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
    <nav class="layout-navbar {{ $containerNav }} navbar navbar-expand-xl {{ $navbarDetached }} align-items-center bg-navbar-theme"
        id="layout-navbar">
@endif
@if (isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{ $containerNav }}">
@endif

<!--  Brand demo (display only for navbar-full and hide on below xl) -->
@if (isset($navbarFull))
    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{ url('/dashboard') }}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
                @include('_partials.macros', ['height' => 20])
            </span>
            <span class="app-brand-text demo menu-text fw-bold">{{ config('variables.templateName') }}</span>
        </a>
    </div>
@endif

<!-- ! Not required for layout-without-menu -->
@if (!isset($navbarHideToggle))
    <div
        class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>
@endif

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

    @if ($configData['hasCustomizer'] == true)
        <!-- Style Switcher -->

        <!--/ Style Switcher -->
    @endif

    <ul class="navbar-nav flex-row align-items-center ms-auto">

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
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
                                <small class="text-muted">{{ Auth::user()?->email }}</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                @if (Auth::check() && auth()->user()->hasRole('Customer'))
                <li>
                    <a class="dropdown-item"
                        href="{{ Route::has('customer.profile') ? route('customer.profile') : 'javascript:void(0);' }}">
                        <i class="ti ti-user-check me-2 ti-sm"></i>
                        <span class="align-middle">{{ __('My Profile') }}</span>
                    </a>
                </li>
                @endif
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                        <a class="dropdown-item" href="javascript:void(0);" id="changeLocaleVertical">
                            <i class="ti ti-language me-2 ti-sm"></i>
                            <span class="align-middle">{{ app()->getLocale() == 'en' ? 'عربي' : 'English' }}</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                        <a class="dropdown-item changeModeVertical" href="javascript:void(0);" data-theme="light">
                            <span class="align-middle"><i id='modeIconVertical'
                                    class='ti ti-sun me-2'></i>{{ __('Change Mode') }}</span>
                        </a>
                    </li>
                </ul>
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
                            <span class="align-middle">{{ __('Logout') }}</span>
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

@if (!isset($navbarDetached))
    </div>
@endif
</nav>
<!-- / Navbar -->

<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script>
    $(document).ready(function() {
        var changeLocaleButton = $('#changeLocaleVertical');
        var changeModeButton = $('.changeModeVertical');
        var iconElement = $('#modeIconVertical');

        var storageKeys = {
            locale: 'locale',
            mode: 'templateCustomizer-front-menu-theme-default-light--Style',
            rtl: 'templateCustomizer-front-menu-theme-default-light--Rtl',
            modeVertical: 'templateCustomizer-vertical-menu-theme-default-light--Style',
            rtlVertical: 'templateCustomizer-vertical-menu-theme-default-light--Rtl'
        };

        var locale = localStorage.getItem(storageKeys.locale) || "{{ app()->getLocale() }}";
        var currentMode = localStorage.getItem(storageKeys.modeVertical) || 'light';
        var isRtl = localStorage.getItem(storageKeys.rtl) === 'true';

        var refreshNeeded = false;

        for (var key in storageKeys) {
            if (localStorage.getItem(storageKeys[key]) === null) {
                localStorage.setItem(storageKeys[key], getDefaultValue(key));
                refreshNeeded = true;
            }
        }

        if (refreshNeeded) {
            window.location.reload();
        } else {
            updateModeIcon(currentMode);
        }

        function updateModeIcon(mode) {
            iconElement.attr('class', mode === 'dark' ? 'ti ti-sun me-2' : 'ti ti-moon me-2');
        }

        function toggleLocale() {
            var newLocale = locale === 'en' ? 'ar' : 'en';
            localStorage.setItem(storageKeys.locale, newLocale);
            localStorage.setItem(storageKeys.rtl, newLocale === 'ar');
            localStorage.setItem(storageKeys.rtlVertical, newLocale === 'ar');
            updateLocaleURL(newLocale);
        }

        function updateLocaleURL(newLocale) {
            var url = '{{ route('changeLocale', ['locale' => ':locale']) }}';
            url = url.replace(':locale', newLocale);
            window.location.href = url;
        }

        function toggleMode() {
            currentMode = currentMode === 'light' ? 'dark' : 'light';
            localStorage.setItem(storageKeys.modeVertical, currentMode);
            localStorage.setItem(storageKeys.mode, currentMode);
            window.location.reload();
        }

        function getDefaultValue(key) {
            if (key === storageKeys.locale) return 'en';
            if (key === storageKeys.mode || key === storageKeys.modeVertical) return 'dark';
            if (key === storageKeys.rtl || key === storageKeys.rtlVertical) return 'false';
            return '';
        }

        changeLocaleButton.on('click', function(event) {
            event.preventDefault();
            toggleLocale();
        });

        changeModeButton.on('click', function(event) {
            event.preventDefault();
            toggleMode();
        });
    });
</script>
