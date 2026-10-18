@extends('frontend.layoutIndex')

@section('pageTitle', 'Shipping & Delivery Policy')

@section('bodyIndex')
    @include('frontend.partials.pageHead', [
        'title' => 'Shipping & Delivery Policy',
        'subtitle' => 'How digital services are delivered after payment.',
        'crumbs' => ['Shipping & Delivery Policy'],
    ])

    <section class="fb-legal">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    <nav class="fb-legal__toc" aria-label="On this page">
                        <h6>On this page</h6>
                        <ol></ol>
                    </nav>
                </div>
                <div class="col-lg-9">
                    <article class="fb-legal__body">
                        <p class="fb-legal__meta"><i class="bi bi-calendar3"></i> Last updated: {{ date('d F Y') }}</p>

                        <h2>Shipping &amp; Delivery Policy</h2>
                        <hr>

                        <p>
                            This Shipping &amp; Delivery Policy explains how {{ config('web.store_data.company_name') }}
                            (“we”, “us”, “our”) delivers the services purchased through the
                            {{ config('web.store_data.app_name') }} website.
                        </p>

                        <hr>

                        <h3>1. Nothing is shipped physically</h3>
                        <p>
                            {{ config('web.store_data.app_name') }} is a digital loan consultancy platform. We do not sell or
                            ship physical goods. No courier, postal or delivery charges apply to any of our services, and no
                            shipping address is collected from you.
                        </p>

                        <h3>2. What you receive and when</h3>
                        <p>All services are delivered electronically to the mobile number and email address registered with your account:</p>
                        <ul>
                            <li><strong>Eligibility check and pre-approved offer</strong> – shown instantly on screen as you complete the application steps.</li>
                            <li><strong>Self Login</strong> – the lending partner list with direct application links is unlocked immediately after the platform fee payment is confirmed. Your selection and the partner link also stay available under <em>My Account › My Applications</em>.</li>
                            <li><strong>Hire Agent</strong> – a {{ config('web.store_data.app_name') }} agent contacts you within one working day of payment confirmation and manages document collection and lender coordination thereafter.</li>
                            <li><strong>Payment receipts and application updates</strong> – available under <em>My Account › Transactions</em> and <em>My Applications</em>, and sent by SMS / email where applicable.</li>
                        </ul>

                        <h3>3. Delivery timelines</h3>
                        <p>
                            Digital services are activated automatically once the payment gateway confirms your payment, usually
                            within a few seconds. In rare cases of a delayed confirmation from the payment gateway, activation may
                            take up to 24 hours. If a service is not visible in your account after this period, please contact
                            support with your application number.
                        </p>

                        <h3>4. Loan disbursal</h3>
                        <p>
                            {{ config('web.store_data.company_name') }} is a technology and service provider, not a lender. The
                            sanction, disbursal amount, timeline and mode of disbursal of any loan are decided solely by the
                            lending partner (bank / NBFC) under its own policies, and are not covered by this Policy.
                        </p>

                        <h3>5. Failed or incomplete deliveries</h3>
                        <p>
                            If a payment is debited but the service is not activated, the amount is either activated on
                            confirmation or refunded as per our
                            <a href="{{ route('_refundPolicyPost') }}">Refund &amp; Cancellation Policy</a>.
                        </p>

                        <h3>6. Contact</h3>
                        <p>
                            {{ config('web.store_data.company_name') }}<br>
                            {{ config('web.store_data.location') }}<br>
                            Email: <a href="mailto:{{ config('web.store_data.support_mail') }}">{{ config('web.store_data.support_mail') }}</a><br>
                            Phone: <a href="tel:{{ config('web.store_data.phone') }}">{{ config('web.store_data.phone') }}</a>
                        </p>

                        <p><em>Last updated: {{ date('d F Y') }}</em></p>
                    </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
