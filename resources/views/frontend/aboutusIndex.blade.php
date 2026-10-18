@extends('frontend.layoutIndex')

@section('pageTitle', 'About Us')

@php
    $app_name = config('web.store_data.app_name');
@endphp

@section('bodyIndex')
    @include('frontend.partials.pageHead', [
        'title' => 'About ' . $app_name,
        'subtitle' => 'A digital loan consultancy platform that connects borrowers with RBI regulated banks and NBFCs.',
        'crumbs' => ['About Us'],
    ])

    <section class="fb-section">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6 fb-reveal">
                    <span class="fb-eyebrow">Who we are</span>
                    <h2 class="fb-title">Trusted digital loan <span>consultancy platform</span></h2>
                    <p class="fb-lead" style="margin-bottom:16px;">
                        {{ $app_name }} is a registered Limited Liability Partnership in India. We operate as a digital loan
                        consultancy platform connecting users with trusted financial institutions including banks and NBFCs.
                    </p>
                    <p>Our goal is to simplify the loan process by giving you quick access to verified lending partners, a clear
                        pre-approved offer, and real people who help you through documentation and follow-ups.</p>
                    <p><strong>We do not provide loans directly</strong> and act solely as a technology and service platform.
                        Loan sanction, rate, tenure and disbursal are always decided by the lending partner.</p>

                    <ul class="fb-ticks" style="margin:20px 0 26px;">
                        <li><i class="bi bi-check-circle-fill"></i> Loan eligibility and advisory</li>
                        <li><i class="bi bi-check-circle-fill"></i> Secure and guided applications</li>
                        <li><i class="bi bi-check-circle-fill"></i> Documentation and lender coordination</li>
                    </ul>

                    <div class="fl-actions" style="margin:0;">
                        <a class="fl-btn" href="{{ route('_personalServiceStart') }}">Check eligibility <i class="bi bi-arrow-right"></i></a>
                        <a class="fl-btn fl-btn--ghost" href="{{ route('_contactusPost') }}">Contact us</a>
                    </div>
                </div>

                <div class="col-lg-6 fb-reveal">
                    <div class="fb-about-visual">
                        <span class="fb-eyebrow" style="background:rgba(255,255,255,0.14);color:#fff;">{{ config('web.store_data.company_name') }}</span>
                        <h3>Transparent, secure and RBI-compliant loan guidance</h3>
                        <p>Registered in India &middot; LLPIN {{ config('web.store_data.LLPIN') }} &middot; GSTIN {{ config('web.store_data.GSTIN') }}</p>
                        <div class="fb-about-visual__grid">
                            <div><strong>100%</strong><span>RBI guideline compliance</span></div>
                            <div><strong>0</strong><span>Hidden fees or unauthorised access</span></div>
                            <div><strong>30+</strong><span>Lending partners</span></div>
                            <div><strong>Mon&ndash;Sat</strong><span>Customer support</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fb-section fb-section--soft">
        <div class="container">
            <div class="fb-head fb-reveal">
                <span class="fb-eyebrow">Why choose us</span>
                <h2 class="fb-title">Responsible and ethical <span>fintech</span></h2>
                <p class="fb-lead">We operate strictly as a technology and service provider, not a lender. Our platform ensures complete transparency, data privacy and ethical practices while guiding you to the right financial partner.</p>
            </div>
            <div class="row g-3 g-lg-4">
                @foreach ([
                    ['bi-bank', 'RBI regulated lending partners', 'Every lender on the platform is a registered bank or NBFC.'],
                    ['bi-shield-lock', 'Zero unauthorised data access', 'Your documents are shared only with the lender handling your file.'],
                    ['bi-receipt', 'Transparent and fair processes', 'One clearly stated platform fee, shown before you pay.'],
                    ['bi-people', 'Customer-first loan guidance', 'Agents and support who explain options instead of pushing products.'],
                ] as [$icon, $title, $text])
                    <div class="col-lg-3 col-md-6 fb-reveal">
                        <div class="fb-value">
                            <i class="bi {{ $icon }}"></i>
                            <h4>{{ $title }}</h4>
                            <p>{{ $text }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="fb-section">
        <div class="container">
            <div class="fb-head fb-reveal">
                <span class="fb-eyebrow">How we work</span>
                <h2 class="fb-title">From enquiry to <span>disbursal</span></h2>
            </div>
            <div class="fb-steps fb-reveal">
                <div class="fb-step">
                    <span class="fb-step__icon"><i class="bi bi-search"></i></span>
                    <h4>Assess</h4>
                    <p>We check your eligibility from income, running EMIs and credit band.</p>
                </div>
                <div class="fb-step">
                    <span class="fb-step__icon"><i class="bi bi-diagram-3"></i></span>
                    <h4>Match</h4>
                    <p>Your profile is matched to lenders whose policies fit it best.</p>
                </div>
                <div class="fb-step">
                    <span class="fb-step__icon"><i class="bi bi-folder-check"></i></span>
                    <h4>Prepare</h4>
                    <p>Documents are collected and checked so the file goes through cleanly.</p>
                </div>
                <div class="fb-step">
                    <span class="fb-step__icon"><i class="bi bi-cash-coin"></i></span>
                    <h4>Follow through</h4>
                    <p>We coordinate with the lender until sanction and disbursal.</p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.ctaBand')
    @include('frontend.partials.stickyCta')
@endsection
