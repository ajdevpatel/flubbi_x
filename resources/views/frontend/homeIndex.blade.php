@extends('frontend.layoutIndex')

@php
    $app_name = config('web.store_data.app_name');
    $gst_rate = (float) config('web.fees.gst_rate', 18);
    $plans = [];
    foreach ((array) config('web.fees.login_type', []) as $key => $cfg) {
        $base = (float) ($cfg['base_amount'] ?? 0);
        $gst = round($base * $gst_rate / 100, 2);
        $plans[$key] = [
            'login_type' => $key,
            'label' => $cfg['label'] ?? ucfirst($key),
            'note' => $cfg['note'] ?? '',
            'base_amount' => $base,
            'gst_amount' => $gst,
            'total_amount' => round($base + $gst, 2),
        ];
    }
    $amount_max = \App\Http\Controllers\Fend\LoanServiceController::LOAN_AMOUNT_MAX;
    $tenures = \App\Http\Controllers\Fend\LoanServiceController::TENURES;
    $faqs = array_slice((array) config('web.faq.faq_page', []), 0, 5);
    // Partner logo files live in public/store/partners; build the URL from the current host so it works on any domain.
    $partners = collect($our_partners ?? [])
        ->filter(fn ($p) => !empty($p->partner_logo))
        ->map(function ($p) {
            $p->partner_logo = asset('store/partners/' . basename((string) parse_url($p->partner_logo, PHP_URL_PATH)));
            return $p;
        })
        ->values();
@endphp

@section('bodyIndex')

    {{-- Hero --}}
    <section class="fb-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="fb-eyebrow"><i class="bi bi-lightning-charge-fill"></i> Loans made easy &middot; RBI regulated partners</span>
                    <h1>Need quick funds? Get your loan offer <span>in minutes.</span></h1>
                    <p class="fb-hero__lead">
                        Instant personal and business loan offers for salaried and self-employed people. Check your eligibility in
                        2 minutes, see your pre-approved offer and apply with trusted banks and NBFCs. Minimal paperwork, no hidden
                        charges, and no impact on your credit score.
                    </p>
                    <div class="fb-hero__actions">
                        <a class="fl-btn fl-btn--lg" href="{{ route('_personalServiceStart') }}">Get my loan offer <i class="bi bi-arrow-right"></i></a>
                        <a class="fl-btn fl-btn--lg fl-btn--ghost" href="{{ route('_businessServiceIndex') }}"><i class="bi bi-briefcase"></i> Business Loan</a>
                    </div>
                    <ul class="fb-chips">
                        <li><i class="bi bi-check-circle-fill"></i> Up to &#8377; 1 Crore</li>
                        <li><i class="bi bi-check-circle-fill"></i> 12&ndash;240 month tenure</li>
                        <li><i class="bi bi-check-circle-fill"></i> Offer in 2 minutes</li>
                        <li><i class="bi bi-check-circle-fill"></i> No hidden charges</li>
                    </ul>
                </div>

                <div class="col-lg-6">
                    <div class="fb-hero__visual">
                        <div class="fb-hero__blob" aria-hidden="true"></div>

                        <div class="fb-float-badge fb-float-badge--a" aria-hidden="true">
                            <i class="bi bi-shield-lock-fill"></i>
                            <div><strong>Payment secured</strong>Razorpay &middot; 256-bit SSL</div>
                        </div>

                        <div class="fb-phone" aria-hidden="true">
                            <div class="fb-phone__screen">
                                <div class="fb-phone__bar"><span>9:41</span><span><i class="bi bi-reception-4"></i><i class="bi bi-wifi"></i><i class="bi bi-battery-full"></i></span></div>
                                <div class="fb-phone__app"><img src="{{ asset('store/logo-mark.png') }}" alt=""> {{ $app_name }} <span>Step 5 of 7</span></div>
                                <div class="fb-offer-card">
                                    <div class="fb-offer-card__top">
                                        <div>
                                            <small>Pre-approved offer</small>
                                            <strong>Personal Loan</strong>
                                        </div>
                                        <span class="fb-pill"><i class="bi bi-patch-check-fill"></i> Eligible</span>
                                    </div>
                                    <div class="fb-offer-card__amount">&#8377; 5,00,000<small>Based on income and running EMIs</small></div>
                                    <div class="fb-offer-card__grid">
                                        <div><span>Tenure</span><strong>36 mo</strong></div>
                                        <div><span>EMI</span><strong>&#8377; 16,263</strong></div>
                                        <div><span>Rate</span><strong>10.55%*</strong></div>
                                    </div>
                                    <div class="fb-offer-card__steps">
                                        <i class="is-done"></i><i class="is-done"></i><i class="is-done"></i><i class="is-done"></i><i class="is-now"></i><i></i><i></i>
                                    </div>
                                    <a class="fl-btn fl-btn--block" href="{{ route('_personalServiceStart') }}" tabindex="-1">Accept offer <i class="bi bi-arrow-right"></i></a>
                                </div>
                                <div class="fb-phone__hint"><i class="bi bi-check-circle-fill"></i> Progress saved automatically</div>
                                <div class="fb-phone__home"></div>
                            </div>
                        </div>

                        <div class="fb-float-badge fb-float-badge--b" aria-hidden="true">
                            <i class="bi bi-lightning-charge-fill"></i>
                            <div><strong>2 minute check</strong>No impact on credit score</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stat strip --}}
    <section class="fb-strip">
        <div class="container">
            <div class="fb-strip__in">
                <div class="fb-strip__item"><i class="bi bi-people-fill"></i><div><strong><span data-count="15000" data-suffix="+">15,000+</span></strong><span>Happy customers</span></div></div>
                <div class="fb-strip__item"><i class="bi bi-bank2"></i><div><strong><span data-count="30" data-suffix="+">30+</span></strong><span>Banks &amp; NBFC partners</span></div></div>
                <div class="fb-strip__item"><i class="bi bi-stopwatch-fill"></i><div><strong>2 min</strong><span>Eligibility check</span></div></div>
                <div class="fb-strip__item"><i class="bi bi-ui-checks-grid"></i><div><strong>4 steps</strong><span>From offer to lender</span></div></div>
            </div>
        </div>
    </section>

    {{-- Live eligibility checker --}}
    <section class="fb-section" id="eligibility">
        <div class="container">
            <div class="fb-head fb-reveal">
                <span class="fb-eyebrow"><i class="bi bi-speedometer2"></i> Instant estimate</span>
                <h2 class="fb-title">How much can you <span>borrow today?</span></h2>
                <p class="fb-lead">Move the sliders and see your indicative loan amount and EMI instantly. No sign-up, no credit check.</p>
            </div>

            <div class="row g-4 align-items-stretch fb-reveal">
                <div class="col-lg-7">
                    <div class="emx-panel fb-elig__panel">
                        <div class="emx-control">
                            <div class="emx-control__head">
                                <label>I am</label>
                            </div>
                            <div class="emx-chips fb-elig__type" data-for="type">
                                <button type="button" class="is-active" data-value="salaried"><i class="bi bi-briefcase"></i> Salaried</button>
                                <button type="button" data-value="self_employed"><i class="bi bi-shop"></i> Self employed</button>
                            </div>
                        </div>

                        <div class="emx-control">
                            <div class="emx-control__head">
                                <label for="el_income">Monthly income <small>net in hand</small></label>
                                <div class="emx-input emx-input--prefix">
                                    <span>&#8377;</span>
                                    <input type="text" id="el_income" inputmode="numeric" maxlength="9" value="50,000" aria-label="Monthly income">
                                </div>
                            </div>
                            <input type="range" class="fl-range" id="el_income_range" min="10000" max="500000" step="5000" value="50000" aria-label="Monthly income slider">
                            <div class="fl-range__scale"><span>&#8377; 10,000</span><span>&#8377; 5,00,000</span></div>
                        </div>

                        <div class="emx-control">
                            <div class="emx-control__head">
                                <label for="el_emi">Existing EMIs <small>per month, 0 if none</small></label>
                                <div class="emx-input emx-input--prefix">
                                    <span>&#8377;</span>
                                    <input type="text" id="el_emi" inputmode="numeric" maxlength="9" value="0" aria-label="Existing EMI">
                                </div>
                            </div>
                            <input type="range" class="fl-range" id="el_emi_range" min="0" max="200000" step="1000" value="0" aria-label="Existing EMI slider">
                            <div class="fl-range__scale"><span>&#8377; 0</span><span>&#8377; 2,00,000</span></div>
                        </div>

                        <div class="emx-control">
                            <div class="emx-control__head">
                                <label>Tenure</label>
                            </div>
                            <div class="emx-chips" data-for="months">
                                @foreach ([12, 24, 36, 48, 60, 84] as $m)
                                    <button type="button" class="{{ 36 === $m ? 'is-active' : '' }}" data-value="{{ $m }}">{{ $m }} mo</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="emx-result fb-elig__result">
                        <small class="fb-elig__label">You may be eligible for up to</small>
                        <div class="fb-elig__amount" id="el_amount">&#8377; 0</div>
                        <div class="fb-elig__sub" id="el_sub">Based on 50% of your free monthly income</div>

                        <div class="emx-kv">
                            <div><span>Indicative EMI</span><strong id="el_emi_out">&#8377; 0</strong></div>
                            <div><span>Tenure</span><strong id="el_months_out">36 months</strong></div>
                            <div class="is-total"><span>Rate from</span><strong>10.55% p.a.*</strong></div>
                        </div>

                        <div class="emx-insight" id="el_insight"><i class="bi bi-lightbulb"></i><div></div></div>

                        <a class="fl-btn fl-btn--block" id="el_cta" href="{{ route('_personalServiceStart') }}">Get this offer <i class="bi bi-arrow-right"></i></a>
                        <p class="emx-note">*Indicative only. The final amount, rate and tenure are decided by the lending partner after verification.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Products --}}
    <section class="fb-section fb-section--soft" id="products">
        <div class="container">
            <div class="fb-head fb-reveal">
                <span class="fb-eyebrow">Loans made easy</span>
                <h2 class="fb-title">Pick the loan that <span>fits your need</span></h2>
                <p class="fb-lead">Fast approvals, competitive interest rates, an easy application and no hidden charges, whichever product you choose.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6 fb-reveal">
                    <div class="fb-product">
                        <span class="fb-product__icon"><i class="bi bi-person-badge"></i></span>
                        <h3>Personal Loan</h3>
                        <p>Quick cash for a medical emergency, wedding, travel, education or any personal need. Offer in minutes, minimal paperwork.</p>
                        <div class="fb-product__facts">
                            <div><span>Amount up to</span><strong>&#8377; 1 Crore</strong></div>
                            <div><span>Tenure</span><strong>12&ndash;240 months</strong></div>
                        </div>
                        <ul class="fb-ticks">
                            <li><i class="bi bi-check-circle-fill"></i> Salaried and self-employed</li>
                            <li><i class="bi bi-check-circle-fill"></i> Minimal documents, fully online</li>
                        </ul>
                        <div class="fl-actions">
                            <a class="fl-btn fl-btn--grow" href="{{ route('_personalServiceStart') }}">Apply now <i class="bi bi-arrow-right"></i></a>
                            <a class="fl-btn fl-btn--ghost" href="{{ route('_personalServiceIndex') }}">Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 fb-reveal">
                    <div class="fb-product fb-product--business">
                        <span class="fb-product__icon"><i class="bi bi-briefcase"></i></span>
                        <h3>Business Loan</h3>
                        <p>Working capital, stock, machinery or expansion funding for your business. Collateral-free options from partner lenders.</p>
                        <div class="fb-product__facts">
                            <div><span>Amount up to</span><strong>&#8377; 1 Crore</strong></div>
                            <div><span>Tenure</span><strong>12&ndash;240 months</strong></div>
                        </div>
                        <ul class="fb-ticks">
                            <li><i class="bi bi-check-circle-fill"></i> Traders, manufacturers, services</li>
                            <li><i class="bi bi-check-circle-fill"></i> GST, MSME or trade licence accepted</li>
                        </ul>
                        <div class="fl-actions">
                            <a class="fl-btn fl-btn--grow" href="{{ route('_businessServiceStart') }}">Apply now <i class="bi bi-arrow-right"></i></a>
                            <a class="fl-btn fl-btn--ghost" href="{{ route('_businessServiceIndex') }}">Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 fb-reveal">
                    <div class="fb-product fb-product--card">
                        <span class="fb-product__flag">Coming soon</span>
                        <span class="fb-product__icon"><i class="bi bi-credit-card-2-front"></i></span>
                        <h3>Credit Card</h3>
                        <p>Compare cards from partner banks, check where you stand and apply online.</p>
                        <div class="fb-product__facts">
                            <div><span>Compare</span><strong>Partner cards</strong></div>
                            <div><span>Apply</span><strong>From your phone</strong></div>
                        </div>
                        <ul class="fb-ticks">
                            <li><i class="bi bi-check-circle-fill"></i> Quick eligibility check</li>
                            <li><i class="bi bi-check-circle-fill"></i> Same guided experience</li>
                        </ul>
                        <div class="fl-actions">
                            <a class="fl-btn fl-btn--ghost fl-btn--block" href="{{ route('_creditCardSoonIndex') }}">Know more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section class="fb-section" id="how-it-works">
        <div class="container">
            <div class="fb-head fb-reveal">
                <span class="fb-eyebrow">How it works</span>
                <h2 class="fb-title">Get your loan offer in <span>just 4 easy steps</span></h2>
                <p class="fb-lead">Complete a few simple steps to get started. Your progress is saved automatically, so you can pause and pick up any time.</p>
            </div>

            <div class="fb-steps fb-reveal">
                <div class="fb-step">
                    <span class="fb-step__icon"><i class="bi bi-phone"></i></span>
                    <h4>Verify your mobile</h4>
                    <p>Your name and mobile number, confirmed with a one time password.</p>
                </div>
                <div class="fb-step">
                    <span class="fb-step__icon"><i class="bi bi-ui-checks"></i></span>
                    <h4>Share a few details</h4>
                    <p>Email, PIN code, employment type, income and the amount you need.</p>
                </div>
                <div class="fb-step">
                    <span class="fb-step__icon"><i class="bi bi-patch-check"></i></span>
                    <h4>Get your offer</h4>
                    <p>See the amount you qualify for, pick a tenure and view the indicative EMI.</p>
                </div>
                <div class="fb-step">
                    <span class="fb-step__icon"><i class="bi bi-bank"></i></span>
                    <h4>Pay and apply</h4>
                    <p>Pay a small one time fee, then apply yourself or let a {{ $app_name }} agent handle it.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Two ways to apply --}}
    @if (count($plans))
        <section class="fb-section" id="plans">
            <div class="container">
                <div class="fb-head fb-reveal">
                    <span class="fb-eyebrow">Two ways to apply</span>
                    <h2 class="fb-title">Do it yourself, or <span>hire an agent</span></h2>
                    <p class="fb-lead">Both routes give you the same pre-approved offer. Pick how much help you want.</p>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach ($plans as $plan)
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
                                        <li><i class="bi bi-check2"></i> Instant access to 30+ lender apply links</li>
                                        <li><i class="bi bi-check2"></i> Apply directly on the lender's portal</li>
                                        <li><i class="bi bi-check2"></i> Email and WhatsApp support</li>
                                    @else
                                        <li><i class="bi bi-check2"></i> Dedicated {{ $app_name }} agent on call</li>
                                        <li><i class="bi bi-check2"></i> Documents, follow-ups and lender coordination done for you</li>
                                        <li><i class="bi bi-check2"></i> Best-fit lender chosen for your profile</li>
                                    @endif
                                </ul>
                                <div class="fl-actions">
                                    <a class="fl-btn {{ 'consultant' === $plan['login_type'] ? '' : 'fl-btn--ghost' }} fl-btn--block" href="{{ route('_personalServiceStart', ['login_type' => $plan['login_type']]) }}">
                                        Start with {{ $plan['label'] }} <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Why us --}}
    <section class="fb-section fb-section--soft" id="why">
        <div class="container">
            <div class="fb-head fb-reveal">
                <span class="fb-eyebrow">Why {{ $app_name }}</span>
                <h2 class="fb-title">Hassle-free loans, <span>done the right way</span></h2>
                <p class="fb-lead">Fast approvals, competitive rates and full transparency. We are a technology and consultancy platform, not a lender, so we stay on your side of the table.</p>
            </div>

            <div class="row g-3 g-lg-4">
                @foreach ([
                    ['bi-lightning-charge', 'Fast approvals', 'Your offer in minutes. Once your file is complete, partner lenders can approve within hours.'],
                    ['bi-percent', 'Competitive interest rates', 'Rates from 10.55% p.a. from 30+ banks and NBFCs, matched to your profile.'],
                    ['bi-receipt-cutoff', 'No hidden charges', 'Every applicable fee is disclosed before you pay, so you know exactly what you are getting into.'],
                    ['bi-file-earmark-check', 'Minimal paperwork', 'A few basic details and standard KYC. No branch visits, no long forms.'],
                    ['bi-graph-up-arrow', 'No credit score impact', 'Checking your eligibility with us is a soft enquiry and never hurts your score.'],
                    ['bi-headset', 'Real people to help', 'Dedicated agents, email and WhatsApp support on every working day.'],
                ] as [$icon, $title, $text])
                    <div class="col-lg-4 col-md-6 fb-reveal">
                        <div class="fb-feature">
                            <i class="bi {{ $icon }}"></i>
                            <div>
                                <h4>{{ $title }}</h4>
                                <p>{{ $text }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Partners --}}
    @if ($partners->count())
        <section class="fb-section fb-section--tight" id="partners">
            <div class="container">
                <div class="fb-head fb-reveal" style="margin-bottom:28px;">
                    <span class="fb-eyebrow">Lending partners</span>
                    <h2 class="fb-title">Backed by <span>trusted lenders</span></h2>
                </div>
            </div>
            @php
                $half = (int) ceil($partners->count() / 2);
                $rows = $partners->count() > 6 ? [$partners->slice(0, $half)->values(), $partners->slice($half)->values()] : [$partners];
            @endphp
            @foreach ($rows as $ri => $row)
                <div class="fb-logos">
                    <div class="fb-logos__track {{ 1 === $ri ? 'fb-logos__track--rev' : '' }}">
                        @for ($i = 0; $i < 2; $i++)
                            @foreach ($row as $p)
                                <div class="fb-logos__item"><img src="{{ $p->partner_logo }}" alt="Lending partner" loading="lazy" onerror="this.closest('.fb-logos__item').remove()"></div>
                            @endforeach
                        @endfor
                    </div>
                </div>
            @endforeach
        </section>
    @endif

    {{-- Testimonials --}}
    @if (!empty($testimonials))
        <section class="fb-section fb-section--tint" id="testimonials">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-4 fb-reveal">
                        <span class="fb-eyebrow">Customer stories</span>
                        <h2 class="fb-title">Join 15,000+ customers who <span>trust {{ $app_name }}</span></h2>
                        <p class="fb-lead" style="margin-bottom:6px;">Hassle-free loans, real people and honest advice. Here is what they say.</p>
                        <div class="fb-rating">
                            <strong>4.9</strong>
                            <div>
                                <div class="fb-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                                <span>Average customer rating</span>
                            </div>
                        </div>
                        <p class="fb-note">Reviews shared by customers after their application was processed.</p>
                    </div>
                    <div class="col-lg-8 fb-reveal" data-fb-scroller>
                        <div class="fb-testi-nav">
                            <button type="button" data-fb-scroll="prev" aria-label="Previous"><i class="bi bi-arrow-left"></i></button>
                            <button type="button" data-fb-scroll="next" aria-label="Next"><i class="bi bi-arrow-right"></i></button>
                        </div>
                        <div class="fb-testi-scroller">
                            @foreach ($testimonials as $t)
                                <article class="fb-testi">
                                    <div class="fb-testi__quote"><i class="bi bi-quote"></i></div>
                                    <p>{{ $t['review'] }}</p>
                                    <div class="fb-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star-fill {{ $i <= (int) $t['rating'] ? '' : 'is-off' }}"></i>
                                        @endfor
                                    </div>
                                    <div class="fb-testi__who">
                                        <span class="fb-avatar">{{ mb_strtoupper(mb_substr($t['name'], 0, 1)) }}</span>
                                        <div>
                                            <strong>{{ $t['name'] }}</strong>
                                            <span>{{ $t['profession'] }}</span>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- FAQ + Contact --}}
    <section class="fb-section" id="contact">
        <div class="container">
            <div class="row g-4 g-lg-5">
                <div class="col-lg-6 fb-reveal">
                    <span class="fb-eyebrow">Common questions</span>
                    <h2 class="fb-title">Everything you need to know <span>before you apply</span></h2>
                    <p class="fb-lead" style="margin-bottom:22px;">Straight answers on fees, speed, eligibility and documents. <a class="fl-link" href="{{ route('_faqPost') }}">See all FAQs</a></p>
                    <div class="fb-faq">
                        @foreach ($faqs as $k => $f)
                            <details class="fb-faq__item" @if (0 === $k) open @endif>
                                <summary>{{ $f['question'] }}</summary>
                                <div class="fb-faq__body">{{ $f['answer'] }}</div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6 fb-reveal">
                    <div class="fb-form-card">
                        <span class="fb-eyebrow fb-eyebrow--accent">Request a call back</span>
                        <h3>Talk to a {{ $app_name }} advisor</h3>
                        <p class="fb-note" style="margin-bottom:18px;">Tell us a little about what you need and we will call you back on a working day.</p>

                        <form id="_inquiryModule" method="POST" action="{{ route('_contactusPost') }}" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="fl-field">
                                        <label class="fl-field__label" for="name">Your name <span class="fl-req">*</span></label>
                                        <input class="fl-field__control" type="text" name="name" id="name" placeholder="Full name" required>
                                        <span class="error-text text-danger" id="error-name"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fl-field">
                                        <label class="fl-field__label" for="phone">Mobile number <span class="fl-req">*</span></label>
                                        <div class="fl-field__prefix">
                                            <span>+91</span>
                                            <input class="fl-field__control" type="tel" name="phone" id="phone" placeholder="10 digit number" inputmode="numeric" maxlength="10" required>
                                        </div>
                                        <span class="error-text text-danger" id="error-phone"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="fl-field">
                                        <label class="fl-field__label" for="mail">Email address <span class="fl-req">*</span></label>
                                        <input class="fl-field__control" type="email" name="mail" id="mail" placeholder="you@example.com" required>
                                        <span class="error-text text-danger" id="error-mail"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="fl-field">
                                        <label class="fl-field__label" for="message">How can we help? <span class="fl-req">*</span></label>
                                        <textarea class="fl-field__control" name="message" id="message" rows="4" placeholder="Loan type, amount and the best time to call" required></textarea>
                                        <span class="error-text text-danger" id="error-message"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="fl-btn fl-btn--block" id="contact-submit"><i class="bi bi-telephone-outbound"></i> Request call back</button>
                                </div>
                            </div>
                        </form>
                        <div id="status"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Trust bar --}}
    <section class="fb-section--tight" style="padding-top:0;">
        <div class="container">
            <div class="fb-trust fb-reveal">
                <div class="fb-trust__item"><i class="bi bi-shield-lock-fill"></i><div><strong>Secured by Razorpay</strong><span>256-bit SSL encrypted payments</span></div></div>
                <div class="fb-trust__item"><i class="bi bi-bank2"></i><div><strong>RBI regulated partners</strong><span>Registered banks and NBFCs only</span></div></div>
                <div class="fb-trust__item"><i class="bi bi-file-earmark-lock2-fill"></i><div><strong>Your data stays private</strong><span>Shared only with your lender</span></div></div>
                <div class="fb-trust__item"><i class="bi bi-graph-up-arrow"></i><div><strong>No credit score impact</strong><span>Soft check, always</span></div></div>
            </div>
        </div>
    </section>

    @include('frontend.partials.ctaBand')
@endsection

@section('jsIndex')
    <script src="{{ asset('assets/app/contactIndex.js') }}"></script>
    <script>
        (function () {
            var RATE = 10.55, MAX = 10000000, MIN = 50000;
            var st = { type: "salaried", income: 50000, emi: 0, months: 36 };
            var $ = window.jQuery;
            function inr(n) { return "₹ " + Math.round(n).toLocaleString("en-IN"); }
            function num(s) { return parseInt(String(s).replace(/[^0-9]/g, ""), 10) || 0; }
            function emiOf(p, n) { var r = RATE / 1200; return p * r * Math.pow(1 + r, n) / (Math.pow(1 + r, n) - 1); }
            function paint($r, v) { var a = +$r.attr("min"), b = +$r.attr("max"); $r.val(v).css("--fl-range-fill", ((v - a) / (b - a) * 100) + "%"); }
            function lakh(n) { return n >= 10000000 ? (n / 10000000).toFixed(1).replace(/\.0$/, "") + " Cr" : (n / 100000).toFixed(1).replace(/\.0$/, "") + " L"; }

            function render() {
                var share = st.type === "salaried" ? 0.5 : 0.45;
                var free = Math.max(0, st.income * share - st.emi);
                var r = RATE / 1200, n = st.months;
                var maxEmi = free;
                var amount = r > 0 ? maxEmi * (Math.pow(1 + r, n) - 1) / (r * Math.pow(1 + r, n)) : maxEmi * n;
                amount = Math.min(MAX, Math.floor(amount / 10000) * 10000);
                var ok = amount >= MIN;
                var emi = ok ? emiOf(amount, n) : 0;

                $("#el_amount").text(ok ? inr(amount) : "₹ 0");
                $("#el_sub").text(ok
                    ? "Based on " + Math.round(share * 100) + "% of your free monthly income (" + inr(free) + ")"
                    : "Your existing EMIs use up most of your income. Reduce them or try a longer tenure.");
                $("#el_emi_out").text(ok ? inr(emi) : "—");
                $("#el_months_out").text(n + " months");

                var tip = "";
                if (ok && n < 84) {
                    var n2 = n >= 60 ? 84 : (n >= 36 ? 60 : 36);
                    var amt2 = Math.min(MAX, Math.floor(maxEmi * (Math.pow(1 + r, n2) - 1) / (r * Math.pow(1 + r, n2)) / 10000) * 10000);
                    if (amt2 > amount) { tip = "Choose <strong>" + n2 + " months</strong> and you could qualify for up to <strong>" + inr(amt2) + "</strong>."; }
                }
                if (!tip && ok) { tip = "Good to go. Up to <strong>₹ " + lakh(amount) + "</strong> with an EMI of about <strong>" + inr(emi) + "</strong> a month."; }
                if (!ok) { tip = "Tip: an EMI below 40% of your income gives the best chance of approval."; }
                $("#el_insight div").html(tip);

                $("#el_cta").attr("href", "{{ route('_personalServiceStart') }}");
            }

            function sync() {
                $("#el_income").val(st.income.toLocaleString("en-IN")); paint($("#el_income_range"), st.income);
                $("#el_emi").val(st.emi.toLocaleString("en-IN")); paint($("#el_emi_range"), st.emi);
                $(".emx-chips[data-for=months] button", "#eligibility").each(function () { $(this).toggleClass("is-active", +this.getAttribute("data-value") === st.months); });
                $(".fb-elig__type button").each(function () { $(this).toggleClass("is-active", this.getAttribute("data-value") === st.type); });
            }

            $("#el_income_range").on("input change", function () { st.income = +this.value; sync(); render(); });
            $("#el_emi_range").on("input change", function () { st.emi = +this.value; sync(); render(); });
            $("#el_income").on("input", function () { st.income = Math.max(10000, Math.min(500000, num(this.value))); paint($("#el_income_range"), st.income); render(); }).on("blur", function () { sync(); });
            $("#el_emi").on("input", function () { st.emi = Math.max(0, Math.min(200000, num(this.value))); paint($("#el_emi_range"), st.emi); render(); }).on("blur", function () { sync(); });
            $("#eligibility").on("click", ".emx-chips[data-for=months] button", function () { st.months = +this.getAttribute("data-value"); sync(); render(); });
            $("#eligibility").on("click", ".fb-elig__type button", function () { st.type = this.getAttribute("data-value"); sync(); render(); });

            sync();
            render();
        })();
    </script>
@endsection
