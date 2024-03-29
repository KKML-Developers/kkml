@if(get_setting('show_language_switcher') == 'on' && get_setting('show_currency_switcher') == 'on')
<!-- Top Bar -->
<div class="top-navbar border-bottom border-soft-secondary z-1035 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col">
                sdsad
                <ul class="list-inline d-flex justify-content-between justify-content-lg-start mb-0">
                    @if (get_setting('show_language_switcher') == 'on')
                        <li class="list-inline-item dropdown mr-3" id="lang-change">
                            @php
                                if (Session::has('locale')) {
                                    $locale = Session::get('locale', Config::get('app.locale'));
                                } else {
                                    $locale = 'en';
                                }
                            @endphp
                            <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2" data-toggle="dropdown"
                                data-display="static">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/flags/' . $locale . '.png') }}"
                                    class="mr-2 lazyload"
                                    alt="{{ \App\Language::where('code', $locale)->first()->name }}" height="11">
                                <span
                                    class="opacity-60">{{ \App\Language::where('code', $locale)->first()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left">
                                @foreach (\App\Language::all() as $key => $language)
                                    <li>
                                        <a href="javascript:void(0)" data-flag="{{ $language->code }}"
                                            class="dropdown-item @if ($locale == $language) active @endif">
                                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                                class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                            <span class="language">{{ $language->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    @if (get_setting('show_currency_switcher') == 'on')
                        <li class="list-inline-item dropdown" id="currency-change">
                            @php
                                if (Session::has('currency_code')) {
                                    $currency_code = Session::get('currency_code');
                                } else {
                                    $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                                }
                            @endphp
                            <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2 opacity-60"
                                data-toggle="dropdown" data-display="static">
                                {{ \App\Currency::where('code', $currency_code)->first()->name }}
                                {{ \App\Currency::where('code', $currency_code)->first()->symbol }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                @foreach (\App\Currency::where('status', 1)->get() as $key => $currency)
                                    <li>
                                        <a class="dropdown-item @if ($currency_code == $currency->code) active @endif"
                                            href="javascript:void(0)"
                                            data-currency="{{ $currency->code }}">{{ $currency->name }}
                                            ({{ $currency->symbol }})</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="col-5 text-right d-none d-lg-block">
               
            </div>
        </div>
    </div>
</div>
@endif
<!-- END Top Bar -->
<header class="@if (get_setting('header_stikcy') == 'on') sticky-top @endif z-1020 bg-white border-bottom shadow-sm">
    <div class="position-relative logo-bar-area z-1 custom-top-color">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">

                <div class="col-auto col-xl-5 pl-0 pr-3 d-flex align-items-center nav-logo">
                    <a class="d-block mr-3 ml-0" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if ($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"
                                class="mw-100 h-50px h-md-50px" height="50">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}"
                                class="mw-100 h-50px h-md-50px" height="50">
                        @endif
                    </a>
                </div>
              
                <div class="d-flex">
                    <div class="d-none d-lg-none ml-3 mr-0">
                        <div class="nav-search-box">
                            <a href="#" class="nav-box-link">
                                <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                            </a>
                        </div>
                    </div>
    
                    <div class="d-none d-lg-block ml-3 mr-0">
                        <div class="" id="compare">
                            @include('frontend.partials.compare')
                        </div>
                    </div>
    
                    <div class="d-none d-lg-block ml-3 mr-0">
                        <div class="" id="wishlist">
                            @include('frontend.partials.wishlist')
                        </div>
                    </div>
    
                    <div class="d-none d-lg-block align-self-stretch ml-3 mr-0" data-hover="dropdown">
                        <div class="nav-cart-box dropdown dropdown-menu-left h-100" id="cart_items">
                            @include('frontend.partials.cart')
                        </div>
                    </div>
                    <div class="d-none d-lg-block align-self-stretch ml-3 mr-0" data-hover="dropdown">
                        <div class="nav-cart-box dropdown dropdown-menu-left h-100" id="cart_items">
                            <a href="javascript:void(0)" class="d-flex align-items-center text-reset h-100" data-toggle="dropdown" data-display="static">
                            <i class="las la-user-shield la-2x opacity-80"></i>
                            {{-- <span class="flex-grow-1 ml-1">
                                <span class="nav-box-text d-none d-xl-block opacity-70">User</span>
                            </span> --}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-xs p-0 stop-propagation">
                            <ul class="list-inline mb-0">
                                @auth
                                    @if (isAdmin())
                                        <li class="">
                                            <a href="{{ route('admin.dashboard') }}"
                                                class="text-reset py-2 d-block opacity-60">{{ translate('My Panel') }}</a>
                                        </li>
                                    @else
                                        <li class="">
                                            <a href="{{ route('dashboard') }}"
                                                class="text-reset py-2 d-block opacity-60">{{ translate('My Panel') }}</a>
                                        </li>
                                    @endif
                                    <li class="">
                                        <a href="{{ route('logout') }}"
                                            class="text-reset py-2 d-block opacity-60">{{ translate('Logout') }}</a>
                                    </li>
                                @else
                                    <li class="">
                                        <a href="{{ route('user.login') }}"
                                            class="text-reset py-2 d-block opacity-60">{{ translate('Login') }}</a>
                                    </li>
                                    <li class="">
                                        <a href="{{ route('user.registration') }}"
                                            class="text-reset py-2 d-block opacity-60">{{ translate('Registration') }}</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if (get_setting('header_menu_labels') != null)
        <div class="border-top border-gray-200 py-1 custom-top-color-2">
            <div class="container d-flex justify-content-between">
                <div class="list-inline mb-0 pl-0">
                    @include('frontend.partials.category_menu')
                </div>
                <div class="flex-grow-1 front-header-search d-flex align-items-center">
                    <div class="position-relative flex-grow-1">
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center">
                                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                    <button class="btn px-2" type="button"><i
                                            class="la la-2x la-long-arrow-left"></i></button>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="border-0 border-lg form-control" id="search"
                                        name="q" placeholder="{{ translate('I am searching for...') }}"
                                        autocomplete="off">
                                    <div class="input-group-append d-none d-lg-block">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="la la-search la-flip-horizontal fs-18"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100"
                            style="min-height: 200px">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16">

                            </div>
                            <div id="search-content" class="text-left">

                            </div>
                        </div>
                    </div>
                </div>

                <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">
                    @foreach (json_decode(get_setting('header_menu_labels'), true) as $key => $value)
                        <li class="list-inline-item mx-0">
                            <a href="{{ json_decode(get_setting('header_menu_links'), true)[$key] }}"
                                class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                                {{ translate($value) }}
                            </a>
                        </li>
                        @if ($key == 0)
                            <li class="list-inline-item mx-0">
                                <a href="{{ route('search') }}"
                                    class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                                    {{ 'Book Store' }}
                                </a>
                            </li>
                            <li class="list-inline-item mx-0">
                                <a href="{{ route('orders.track') }}"
                                    class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                                    {{ 'Track Order' }}
                                </a>
                            </li>
                            <li class="list-inline-item mx-0">
                                <a href="{{ route('authors.all') }}"
                                    class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                                    {{ 'All Authors' }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</header>
