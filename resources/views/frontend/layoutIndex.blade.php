<!DOCTYPE html>
<html lang="en-IN">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#1a56db">

    <link rel="icon" type="image/png" sizes="56x56" href="{{ asset('store/logo-mark.png') }}">
    <link rel="shortcut icon" href="{{ asset('store/favicon.webp') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('store/logo-mark.png') }}">

    <title>@hasSection('pageTitle')@yield('pageTitle') | {{ config('web.store_data.app_name') }}@else Instant Personal &amp; Business Loans Made Easy | {{ config('web.store_data.app_name') }}@endif</title>
    <meta name="keywords"
        content="Instant {{ config('web.webapp.loan_word.meta_tag') }} approvals, Online {{ config('web.webapp.loan_word.meta_tag') }} applications, Low-interest rates, Flexible repayment options, Personal loan, Business loan, Digital finance solutions">
    <meta name="description"
        content="@hasSection('pageDescription')@yield('pageDescription')@else {{ config('web.store_data.app_name') }} offers quick personal and business {{ config('web.webapp.loan_word.meta_tag') }} with low-interest rates, easy documentation, and fast approval. Apply online today for instant funds!@endif">
    <meta name="author" content="dev sutariya">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="{{ url()->current() }}" />

    @if (!empty(app('request')->input('google_domain_verification')) && app()->environment('production'))
        <meta name="google-site-verification" content="{{ app('request')->input('google_domain_verification') }}" />
    @endif
    @if (!empty(app('request')->input('facebook_domain_verification')) && app()->environment('production'))
        <meta name="facebook-domain-verification" content="{{ app('request')->input('facebook_domain_verification') }}" />
    @endif
    @if (!empty(app('request')->input('pinterest_domain_verification')) && app()->environment('production'))
        <meta name="p:domain_verify" content="{{ app('request')->input('pinterest_domain_verification') }}" />
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @if ([] != config('web.assets.frontend.css'))
        @foreach (config('web.assets.frontend.css') as $k => $v)
            <link rel="stylesheet" href="{{ asset($v) }}?v={{ @filemtime(public_path($v)) ?: 1 }}">
        @endforeach
    @endif

    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

    @hasSection('styleIndex')
        @yield('styleIndex')
    @endif

    @hasSection('inlineStyleIndex')
        @yield('inlineStyleIndex')
    @endif
</head>

@php
    $fb_logged_in = 0 < (int) app('request')->input('panel_user_id');
    $fb_phone = (string) config('web.store_data.phone');
    $fb_phone_digits = preg_replace('/\D/', '', $fb_phone);
    $fb_wa = 'https://wa.me/' . (10 === strlen($fb_phone_digits) ? '91' . $fb_phone_digits : $fb_phone_digits);
    $fb_social = (array) config('web.store_data.social_links', []);
    $fb_social_icons = [
        'facebook' => 'fab fa-facebook-f',
        'instagram' => 'fab fa-instagram',
        'linkedin' => 'fab fa-linkedin-in',
        'youtube' => 'fab fa-youtube',
        'twitter' => 'fab fa-x-twitter',
        'threads' => 'fab fa-threads',
    ];
    $fb_social = array_filter($fb_social, fn ($u) => !empty($u) && '#' !== $u);

    // Brand word mark: "FleshFin" -> Flesh + Fin (second part accented), otherwise last letter accented
    $fb_app = trim((string) config('web.store_data.app_name', 'FleshFin'));
    if (preg_match('/^(.+?)([A-Z][a-z0-9]+)$/u', $fb_app, $fb_m) && $fb_m[1] !== '') {
        [$fb_brand_a, $fb_brand_b] = [$fb_m[1], $fb_m[2]];
    } else {
        $fb_brand_a = mb_substr($fb_app, 0, -1);
        $fb_brand_b = mb_substr($fb_app, -1);
    }
    $fb_brand_html = e($fb_brand_a) . '<span>' . e($fb_brand_b) . '</span>';
@endphp

<body oncontextmenu="return false">

    <div class="fb-progress" aria-hidden="true"></div>

    {{-- Top bar (desktop) --}}
    <div class="fb-topbar">
        <div class="container">
            <div class="fb-topbar__in">
                <div class="fb-topbar__left">
                    <a href="mailto:{{ config('web.store_data.support_mail') }}"><i class="bi bi-envelope"></i> {{ config('web.store_data.support_mail') }}</a>
                    <a href="tel:{{ $fb_phone_digits }}"><i class="bi bi-telephone"></i> {{ $fb_phone }}</a>
                    <span><i class="bi bi-clock"></i> Mon&ndash;Sat, 9 AM &ndash; 6 PM</span>
                </div>
                <div class="fb-topbar__right">
                    <span>RBI regulated lending partners</span>
                    <div class="fb-topbar__social">
                        @foreach ($fb_social as $k => $u)
                            @if (isset($fb_social_icons[$k]))
                                <a href="{{ $u }}" target="_blank" rel="noopener" title="{{ ucfirst($k) }}"><i class="{{ $fb_social_icons[$k] }}"></i></a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Header --}}
    <header class="fb-header">
        <div class="container">
            <div class="fb-header__in">
                <a class="fb-brand" href="{{ route('_homeIndex') }}" aria-label="{{ config('web.store_data.app_name') }} home">
                    <img src="{{ asset('store/logo-mark.png') }}" alt="{{ config('web.store_data.app_name') }}" width="42" height="42">
                    <span class="fb-brand__text">
                        <span class="fb-brand__name">{!! $fb_brand_html !!}</span>
                        <span class="fb-brand__tag">Fintech</span>
                    </span>
                </a>

                <ul class="fb-nav">
                    <li class="{{ request()->routeIs('_homeIndex') ? 'is-active' : '' }}"><a href="{{ route('_homeIndex') }}"><i class="bi bi-house-door fb-nav__ic"></i> Home</a></li>
                    <li class="{{ request()->is('pl-service*', 'bl-service*', 'credit-card') ? 'is-active' : '' }}">
                        <a href="{{ route('_personalServiceIndex') }}" aria-haspopup="true"><i class="bi bi-cash-stack fb-nav__ic"></i> Loans <i class="bi bi-chevron-down"></i></a>
                        <ul class="fb-nav__drop">
                            <li><a href="{{ route('_personalServiceIndex') }}"><i class="bi bi-person-badge"></i><span><strong>Personal Loan</strong><small>Medical, wedding, travel or any personal need</small></span></a></li>
                            <li><a href="{{ route('_businessServiceIndex') }}"><i class="bi bi-briefcase"></i><span><strong>Business Loan</strong><small>Working capital, stock or expansion</small></span></a></li>
                            <li class="is-soon"><a href="{{ route('_creditCardSoonIndex') }}"><i class="bi bi-credit-card-2-front"></i><span><strong>Credit Card</strong><small>Compare partner cards, coming soon</small></span></a></li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('_emiCalculatorIndex') ? 'is-active' : '' }}"><a href="{{ route('_emiCalculatorIndex') }}"><i class="bi bi-calculator fb-nav__ic"></i> EMI Calculator</a></li>
                    <li class="{{ request()->routeIs('_aboutusPost') ? 'is-active' : '' }}"><a href="{{ route('_aboutusPost') }}"><i class="bi bi-info-circle fb-nav__ic"></i> About</a></li>
                    <li class="{{ request()->routeIs('_contactusPost') ? 'is-active' : '' }}"><a href="{{ route('_contactusPost') }}"><i class="bi bi-chat-dots fb-nav__ic"></i> Contact</a></li>
                </ul>

                <div class="fb-header__actions">
                    <a class="fb-header__phone" href="tel:{{ $fb_phone_digits }}"><i class="bi bi-telephone-fill"></i> {{ $fb_phone }}</a>
                    @if ($fb_logged_in)
                        <a class="fl-btn fl-btn--sm" href="{{ route('_userDashboard') }}"><i class="bi bi-person-circle"></i> My Account</a>
                    @else
                        <a class="fl-btn fl-btn--sm fl-btn--ghost" href="{{ route('_userLogin') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        <a class="fl-btn fl-btn--sm" href="{{ route('_personalServiceStart') }}">Apply Now</a>
                    @endif
                    <button class="fb-burger" type="button" data-fb-drawer-open aria-label="Open menu"><i class="bi bi-list"></i></button>
                </div>
            </div>
        </div>
    </header>

    {{-- Mobile drawer --}}
    <div class="fb-drawer-backdrop"></div>
    <aside class="fb-drawer" aria-hidden="true" aria-label="Menu">
        <div class="fb-drawer__head">
            <a class="fb-brand" href="{{ route('_homeIndex') }}">
                <img src="{{ asset('store/logo-mark.png') }}" alt="" width="36" height="36">
                <span class="fb-brand__text">
                    <span class="fb-brand__name">{!! $fb_brand_html !!}</span>
                    <span class="fb-brand__tag">Fintech</span>
                </span>
            </a>
            <button class="fb-drawer__close" type="button" data-fb-drawer-close aria-label="Close menu"><i class="bi bi-x-lg"></i></button>
        </div>

        <ul class="fb-drawer__nav">
            <li class="{{ request()->routeIs('_homeIndex') ? 'is-active' : '' }}"><a href="{{ route('_homeIndex') }}"><i class="bi bi-house-door"></i> Home</a></li>
            <li class="fb-drawer__label">Loans</li>
            <li class="{{ request()->is('pl-service*') ? 'is-active' : '' }}"><a href="{{ route('_personalServiceIndex') }}"><i class="bi bi-person-badge"></i> Personal Loan</a></li>
            <li class="{{ request()->is('bl-service*') ? 'is-active' : '' }}"><a href="{{ route('_businessServiceIndex') }}"><i class="bi bi-briefcase"></i> Business Loan</a></li>
            <li class="{{ request()->routeIs('_creditCardSoonIndex') ? 'is-active' : '' }}"><a href="{{ route('_creditCardSoonIndex') }}"><i class="bi bi-credit-card-2-front"></i> Credit Card <span class="up-tag">Soon</span></a></li>
            <li class="fb-drawer__label">Company</li>
            <li class="{{ request()->routeIs('_emiCalculatorIndex') ? 'is-active' : '' }}"><a href="{{ route('_emiCalculatorIndex') }}"><i class="bi bi-calculator"></i> EMI Calculator</a></li>
            <li class="{{ request()->routeIs('_aboutusPost') ? 'is-active' : '' }}"><a href="{{ route('_aboutusPost') }}"><i class="bi bi-info-circle"></i> About Us</a></li>
            <li class="{{ request()->routeIs('_faqPost') ? 'is-active' : '' }}"><a href="{{ route('_faqPost') }}"><i class="bi bi-question-circle"></i> FAQs</a></li>
            <li class="{{ request()->routeIs('_contactusPost') ? 'is-active' : '' }}"><a href="{{ route('_contactusPost') }}"><i class="bi bi-chat-dots"></i> Contact</a></li>
        </ul>

        <div class="fb-drawer__cta">
            @if ($fb_logged_in)
                <a class="fl-btn" href="{{ route('_userDashboard') }}"><i class="bi bi-person-circle"></i> My Account</a>
                <a class="fl-btn fl-btn--ghost" href="{{ route('_userLogout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a>
            @else
                <a class="fl-btn" href="{{ route('_personalServiceStart') }}">Check eligibility <i class="bi bi-arrow-right"></i></a>
                <a class="fl-btn fl-btn--ghost" href="{{ route('_userLogin') }}"><i class="bi bi-box-arrow-in-right"></i> Login to My Account</a>
            @endif
        </div>

        <div class="fb-drawer__foot">
            <a href="tel:{{ $fb_phone_digits }}"><i class="bi bi-telephone"></i> {{ $fb_phone }}</a>
            <a href="mailto:{{ config('web.store_data.support_mail') }}"><i class="bi bi-envelope"></i> {{ config('web.store_data.support_mail') }}</a>
            <div class="fb-social">
                @foreach ($fb_social as $k => $u)
                    @if (isset($fb_social_icons[$k]))
                        <a href="{{ $u }}" target="_blank" rel="noopener" title="{{ ucfirst($k) }}"><i class="{{ $fb_social_icons[$k] }}"></i></a>
                    @endif
                @endforeach
            </div>
        </div>
    </aside>

    <main id="main">
        @hasSection('bodyIndex')
            @yield('bodyIndex')
        @endif
    </main>

    {{-- Footer --}}
    <footer class="fb-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 fb-footer__col">
                    <a class="fb-brand" href="{{ route('_homeIndex') }}">
                        <img src="{{ asset('store/logo-mark.png') }}" alt="" width="42" height="42">
                        <span class="fb-brand__text">
                            <span class="fb-brand__name">{!! $fb_brand_html !!}</span>
                            <span class="fb-brand__tag">Fintech</span>
                        </span>
                    </a>
                    <p class="fb-footer__about">{{ config('web.store_data.footer_about_us_text') }}</p>
                    <div class="fb-footer__reg">
                        <span><i class="bi bi-building"></i> {{ config('web.store_data.company_name') }}</span>
                        <span><i class="bi bi-file-earmark-text"></i> LLPIN: {{ config('web.store_data.LLPIN') }}</span>
                        <span><i class="bi bi-receipt"></i> GSTIN: {{ config('web.store_data.GSTIN') }}</span>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6 fb-footer__col">
                    <h5>Products</h5>
                    <ul class="fb-footer__links">
                        <li><a href="{{ route('_personalServiceIndex') }}">Personal Loan</a></li>
                        <li><a href="{{ route('_businessServiceIndex') }}">Business Loan</a></li>
                        <li><a href="{{ route('_creditCardSoonIndex') }}">Credit Card</a></li>
                        <li><a href="{{ route('_emiCalculatorIndex') }}">EMI Calculator</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 col-6 fb-footer__col">
                    <h5>Company</h5>
                    <ul class="fb-footer__links">
                        <li><a href="{{ route('_aboutusPost') }}">About Us</a></li>
                        <li><a href="{{ route('_contactusPost') }}">Contact Us</a></li>
                        <li><a href="{{ route('_faqPost') }}">FAQs</a></li>
                        @if ($fb_logged_in)
                            <li><a href="{{ route('_userDashboard') }}">My Account</a></li>
                        @else
                            <li><a href="{{ route('_userLogin') }}">Login</a></li>
                        @endif
                        <li><a href="{{ route('_accountDeleteIndex') }}">Delete Account</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 col-6 fb-footer__col">
                    <h5>Legal</h5>
                    <ul class="fb-footer__links">
                        <li><a href="{{ route('_privacyPolicyPost') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('_refundPolicyPost') }}">Refund Policy</a></li>
                        <li><a href="{{ route('_termsAndConditionsPost') }}">Terms &amp; Conditions</a></li>
                        <li><a href="{{ route('_disclaimerPost') }}">Disclaimer</a></li>
                        <li><a href="{{ route('_shippingPolicyPost') }}">Shipping &amp; Delivery</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 col-6 fb-footer__col">
                    <h5>Contact</h5>
                    <ul class="fb-footer__contact">
                        <li><i class="bi bi-telephone"></i><a href="tel:{{ $fb_phone_digits }}">{{ $fb_phone }}</a></li>
                        <li><i class="bi bi-envelope"></i><a href="mailto:{{ config('web.store_data.support_mail') }}">{{ config('web.store_data.support_mail') }}</a></li>
                        <li><i class="bi bi-geo-alt"></i><a href="{{ config('web.store_data.location_gmap_url') }}" target="_blank" rel="noopener">{{ config('web.store_data.location') }}</a></li>
                    </ul>
                </div>
            </div>

            <p class="fb-footer__disclaimer">
                {{ config('web.store_data.app_name') }} is a loan consultancy and technology platform, not a lender. Loan sanction, interest rate,
                tenure and disbursal are decided solely by the lending partner (bank / NBFC). Platform fees are for consultancy and
                facilitation services only.
            </p>

            <div class="fb-footer__bottom">
                <p>&copy; {{ date('Y') }} {{ config('web.store_data.company_name') }}. All rights reserved. &middot; Developed by <a href="https://wa.me/918530241214" target="_blank" rel="noopener"><strong>Edigitrix</strong></a></p>
                <div class="fb-social">
                    @foreach ($fb_social as $k => $u)
                        @if (isset($fb_social_icons[$k]))
                            <a href="{{ $u }}" target="_blank" rel="noopener" title="{{ ucfirst($k) }}"><i class="{{ $fb_social_icons[$k] }}"></i></a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </footer>

    <div class="fb-float">
        <button class="fb-float__top" type="button" aria-label="Back to top"><i class="bi bi-arrow-up"></i></button>
        <a class="fb-float__wa" href="{{ $fb_wa }}" target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><i class="fab fa-whatsapp"></i></a>
    </div>

    @stack('customJs')

    @if ([] != config('web.assets.frontend.js'))
        @foreach (config('web.assets.frontend.js') as $k => $v)
            <script src="{{ asset($v) }}"></script>
        @endforeach
    @endif

    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/app/layout.js') }}?v={{ @filemtime(public_path('assets/app/layout.js')) ?: 1 }}"></script>
    <script src="{{ asset('assets/app/site.js') }}?v={{ @filemtime(public_path('assets/app/site.js')) ?: 1 }}"></script>

    @hasSection('jsIndex')
        @yield('jsIndex')
    @endif

    @hasSection('inlineJsIndex')
        @yield('inlineJsIndex')
    @endif

    @if ($errors->any())
        <script type="text/javascript">
            @foreach ($errors->all() as $error)
                Notify(@json($error));
            @endforeach
        </script>
    @endif

    @if (session('success'))
        <script type="text/javascript">
            Notify(@json(session('success')), "success");
        </script>
    @endif

    @if (session('error'))
        <script type="text/javascript">
            Notify(@json(session('error')), "error");
        </script>
    @endif
</body>

</html>
