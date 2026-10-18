@extends('frontend.layoutIndex')

@section('pageTitle', $service['label'] . ' - Check eligibility online')

@php
    $amount_max = \App\Http\Controllers\Fend\LoanServiceController::LOAN_AMOUNT_MAX;
    $tenures = \App\Http\Controllers\Fend\LoanServiceController::TENURES;
    $start_url = route('_' . $service['type'] . 'ServiceStart');
    $rate_text = rtrim(rtrim(number_format((float) $interest_rate, 2), '0'), '.');
    $sample_amount = 'business' === $service['type'] ? 1000000 : 500000;
    $sample_months = 36;
    $r = ((float) $interest_rate) / 1200;
    $sample_emi = $r > 0 ? round($sample_amount * $r * pow(1 + $r, $sample_months) / (pow(1 + $r, $sample_months) - 1)) : round($sample_amount / $sample_months);
    $how = [
        ['bi-phone', 'Verify your mobile', 'Name and mobile number, confirmed with an OTP.'],
        ['bi-envelope', 'Basic details', 'Email, PIN code, city and state. PIN code fills the rest.'],
        ['bi-briefcase', 'Employment', 'Tell us if you are salaried or self employed.'],
        ['bi-cash-stack', 'Income details', 'Monthly income, CIBIL band, running EMI and the amount you need.'],
        ['bi-patch-check', 'Pre-approved offer', 'See the amount you qualify for and pick a tenure.'],
        ['bi-signpost-split', 'Choose your route', 'Apply yourself, or hire a ' . config('web.store_data.app_name') . ' agent to do it for you.'],
        ['bi-lock', 'Pay and proceed', 'Pay the one time fee and get your lender links right away.'],
    ];
@endphp

@section('bodyIndex')
    <section class="fl-hero">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <span class="fb-eyebrow"><i class="bi bi-lightning-charge-fill"></i> {{ $service['short'] }} &middot; Loans made easy</span>
                    <h1>Instant {{ strtolower($service['label']) }} offers, <span style="color:var(--fb-primary);">in minutes</span></h1>
                    <p>{{ $service['tagline'] }} Share a few details, get your pre-approved offer and apply with RBI regulated lenders. Minimal paperwork, no hidden charges, no branch visit, and it never affects your credit score.</p>

                    <div class="fl-stats">
                        <div class="fl-stat"><strong>&#8377; 1 Cr</strong><span>Offers up to</span></div>
                        <div class="fl-stat"><strong>{{ $rate_text }}%*</strong><span>Rate from, per year</span></div>
                        <div class="fl-stat"><strong>{{ max(count($partners), 10) }}+</strong><span>Lending partners</span></div>
                    </div>

                    <ul class="fl-ticks">
                        <li><i class="bi bi-check-circle-fill"></i> Eligibility check in under 2 minutes, offer in 7 easy steps</li>
                        <li><i class="bi bi-check-circle-fill"></i> Fast approvals and competitive rates from 30+ lenders</li>
                        <li><i class="bi bi-check-circle-fill"></i> Apply yourself, or let a dedicated agent handle it</li>
                    </ul>

                    <div class="fl-actions" style="margin-top:0;">
                        <a class="fl-btn fl-btn--lg" href="{{ $start_url }}">Check my eligibility <i class="bi bi-arrow-right"></i></a>
                        <a class="fl-btn fl-btn--lg fl-btn--ghost" href="{{ route('_emiCalculatorIndex') }}"><i class="bi bi-calculator"></i> EMI calculator</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="fb-hero__visual">
                        <div class="fb-float-badge fb-float-badge--a" aria-hidden="true">
                            <i class="bi bi-bank"></i>
                            <div><strong>RBI regulated</strong>Banks and NBFCs only</div>
                        </div>
                        <div class="fb-phone" aria-hidden="true">
                            <div class="fb-phone__screen">
                                <div class="fb-phone__bar"><span>9:41</span><span><i class="bi bi-reception-4"></i><i class="bi bi-wifi"></i><i class="bi bi-battery-full"></i></span></div>
                                <div class="fb-phone__app"><img src="{{ asset('store/logo-mark.png') }}" alt=""> {{ config('web.store_data.app_name') }} <span>Step 5 of 7</span></div>
                                <div class="fb-offer-card">
                                    <div class="fb-offer-card__top">
                                        <div>
                                            <small>Sample offer</small>
                                            <strong>{{ $service['label'] }}</strong>
                                        </div>
                                        <span class="fb-pill"><i class="bi bi-patch-check-fill"></i> Eligible</span>
                                    </div>
                                    <div class="fb-offer-card__amount">&#8377; {{ number_format($sample_amount) }}<small>Indicative, based on a sample profile</small></div>
                                    <div class="fb-offer-card__grid">
                                        <div><span>Tenure</span><strong>{{ $sample_months }} mo</strong></div>
                                        <div><span>EMI</span><strong>&#8377; {{ number_format($sample_emi) }}</strong></div>
                                        <div><span>Rate</span><strong>{{ $rate_text }}%*</strong></div>
                                    </div>
                                    <div class="fb-offer-card__steps">
                                        <i class="is-done"></i><i class="is-done"></i><i class="is-done"></i><i class="is-done"></i><i class="is-now"></i><i></i><i></i>
                                    </div>
                                    <a class="fl-btn fl-btn--block" href="{{ $start_url }}" tabindex="-1">Start my application <i class="bi bi-arrow-right"></i></a>
                                </div>
                                <div class="fb-phone__hint"><i class="bi bi-check-circle-fill"></i> Progress saved automatically</div>
                                <div class="fb-phone__home"></div>
                            </div>
                        </div>
                        <div class="fb-float-badge fb-float-badge--b" aria-hidden="true">
                            <i class="bi bi-graph-up-arrow"></i>
                            <div><strong>Soft check</strong>No impact on credit score</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fl-how fb-section--soft">
        <div class="container">
            <div class="fb-head fb-reveal">
                <span class="fb-eyebrow">How it works</span>
                <h2 class="fb-title">Your {{ strtolower($service['label']) }} offer in <span>7 easy steps</span></h2>
                <p class="fb-lead">Complete a few simple steps to get started. Each one takes under a minute and your progress is saved automatically.</p>
            </div>

            <div class="row g-3">
                @foreach ($how as $k => $row)
                    <div class="col-lg-3 col-md-4 col-sm-6 fb-reveal">
                        <div class="fl-how__item">
                            <div class="fl-how__no">{{ $k + 1 }}</div>
                            <h5><i class="bi {{ $row[0] }}" style="color:var(--fb-primary);margin-right:6px;"></i>{{ $row[1] }}</h5>
                            <p>{{ $row[2] }}</p>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-3 col-md-4 col-sm-6 fb-reveal">
                    <a class="fl-how__item d-flex flex-column justify-content-center text-center" href="{{ $start_url }}" style="background:linear-gradient(135deg,var(--fb-primary),var(--fb-primary-dark));border-color:transparent;color:#fff;">
                        <i class="bi bi-arrow-right-circle" style="font-size:34px;margin-bottom:10px;"></i>
                        <h5 style="color:#fff;">Ready when you are</h5>
                        <p style="color:#d6e2ff;">Start the {{ strtolower($service['label']) }} journey</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="fl-service">
        <div class="container">
            <div class="fb-head fb-reveal">
                <span class="fb-eyebrow">Two ways to apply</span>
                <h2 class="fb-title">Pick what <span>suits you</span></h2>
                <p class="fb-lead">Both routes give you the same pre-approved offer. Pick how much help you want.</p>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach ([$fee_self, $fee_consultant] as $plan)
                    <div class="col-lg-5 col-md-6 fb-reveal">
                        <div class="fl-plan {{ 'consultant' === $plan['login_type'] ? 'fl-plan--featured' : '' }}">
                            @if ('consultant' === $plan['login_type'])
                                <span class="fl-plan__flag">Recommended</span>
                            @endif
                            <span class="fl-plan__icon"><i class="bi {{ 'self' === $plan['login_type'] ? 'bi-person-check' : 'bi-headset' }}"></i></span>
                            <h4>{{ $plan['label'] }}</h4>
                            <span class="fl-plan__price">
                                &#8377; {{ number_format($plan['base_amount']) }}
                                <small>One time fee</small>
                            </span>
                            <p>{{ $plan['note'] }}</p>
                            <ul class="fl-plan__list">
                                @if ('self' === $plan['login_type'])
                                    <li><i class="bi bi-check2"></i> Lender apply links unlocked right after payment</li>
                                    <li><i class="bi bi-check2"></i> Apply directly on the lender's secure portal</li>
                                    <li><i class="bi bi-check2"></i> Email and WhatsApp support</li>
                                @else
                                    <li><i class="bi bi-check2"></i> Dedicated agent calls you within one working day</li>
                                    <li><i class="bi bi-check2"></i> Documents, follow-ups and lender coordination done for you</li>
                                    <li><i class="bi bi-check2"></i> Best-fit lender chosen for your profile</li>
                                @endif
                            </ul>
                            <div class="fl-actions">
                                <a class="fl-btn fl-btn--block {{ 'consultant' === $plan['login_type'] ? '' : 'fl-btn--ghost' }}" href="{{ $start_url }}?login_type={{ $plan['login_type'] }}">
                                    Continue with {{ $plan['label'] }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if (count($partners))
        <section class="fb-section fb-section--soft fb-section--tight">
            <div class="container">
                <div class="fb-head fb-reveal">
                    <span class="fb-eyebrow">Our lending partners</span>
                    <h2 class="fb-title">Backed by RBI regulated lenders</h2>
                </div>
                <div class="fl-partners fb-reveal">
                    @foreach ($partners as $partner)
                        <img src="{{ asset('banks/' . $partner->logo) }}" alt="{{ $partner->label }}" title="{{ $partner->label }}" loading="lazy">
                    @endforeach
                </div>
                <p class="fb-note text-center" style="margin:24px auto 0;max-width:720px;">
                    *Interest rates, eligibility and final approval are decided solely by the lending partner.
                    {{ config('web.store_data.app_name') }} is a technology and service provider, not a lender.
                </p>
            </div>
        </section>
    @endif

    @include('frontend.partials.ctaBand', ['heading' => 'Start your ' . strtolower($service['label']) . ' application', 'text' => 'Two minutes, a few details and no impact on your credit score.'])

    <div class="fb-sticky-cta">
        <div>
            <small>{{ $service['label'] }}</small>
            <strong>Up to &#8377; 1 Crore</strong>
        </div>
        <a class="fl-btn" href="{{ $start_url }}">Check eligibility <i class="bi bi-arrow-right"></i></a>
    </div>
@endsection
