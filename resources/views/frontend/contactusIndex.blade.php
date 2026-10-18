@extends('frontend.layoutIndex')

@section('pageTitle', 'Contact Us')

@php
    $phone = (string) config('web.store_data.phone');
    $phone_digits = preg_replace('/\D/', '', $phone);
    $wa = 'https://wa.me/' . (10 === strlen($phone_digits) ? '91' . $phone_digits : $phone_digits);
@endphp

@section('bodyIndex')
    @include('frontend.partials.pageHead', [
        'title' => 'Contact Us',
        'subtitle' => 'Questions about a loan, a payment or your application? We reply on every working day.',
        'crumbs' => ['Contact'],
    ])

    <section class="fb-section">
        <div class="container">
            <div class="row g-4 g-lg-5">
                <div class="col-lg-5 fb-reveal">
                    <span class="fb-eyebrow">Get in touch</span>
                    <h2 class="fb-title">We are here <span>to help</span></h2>
                    <p class="fb-lead" style="margin-bottom:24px;">Call, email or message us on WhatsApp. For anything about an existing application, keep your application number handy.</p>

                    <div class="fb-contact-card">
                        <i class="bi bi-telephone"></i>
                        <div>
                            <small>Call us</small>
                            <a href="tel:{{ $phone_digits }}">{{ $phone }}</a>
                            <span class="fb-note">Mon&ndash;Sat, 9:00 AM to 6:00 PM</span>
                        </div>
                    </div>
                    <div class="fb-contact-card">
                        <i class="fab fa-whatsapp"></i>
                        <div>
                            <small>WhatsApp</small>
                            <a href="{{ $wa }}" target="_blank" rel="noopener">Chat with us</a>
                            <span class="fb-note">Quickest for document and status queries</span>
                        </div>
                    </div>
                    <div class="fb-contact-card">
                        <i class="bi bi-envelope"></i>
                        <div>
                            <small>Email</small>
                            <a href="mailto:{{ config('web.store_data.support_mail') }}">{{ config('web.store_data.support_mail') }}</a>
                            <span class="fb-note">We reply within one working day</span>
                        </div>
                    </div>
                    <div class="fb-contact-card">
                        <i class="bi bi-geo-alt"></i>
                        <div>
                            <small>Office</small>
                            <strong>{{ config('web.store_data.company_name') }}</strong>
                            <a href="{{ config('web.store_data.location_gmap_url') }}" target="_blank" rel="noopener" style="font-size:14px;color:var(--fb-muted);">{{ config('web.store_data.location') }}</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 fb-reveal">
                    <div class="fb-form-card">
                        <span class="fb-eyebrow fb-eyebrow--accent">Request a call back</span>
                        <h3>Send us a message</h3>
                        <p class="fb-note" style="margin-bottom:18px;">Tell us what you need and the best time to call. Our team will get back to you.</p>

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
                                        <label class="fl-field__label" for="message">Message <span class="fl-req">*</span></label>
                                        <textarea class="fl-field__control" name="message" id="message" rows="5" placeholder="Loan type, amount, application number if you have one" required></textarea>
                                        <span class="error-text text-danger" id="error-message"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="fl-btn fl-btn--block" id="contact-submit"><i class="bi bi-send"></i> Send message</button>
                                </div>
                            </div>
                        </form>
                        <div id="status" style="margin-top:12px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fb-section fb-section--soft fb-section--tight">
        <div class="container">
            <div class="fb-map fb-reveal">
                <iframe src="{{ config('web.store_data.location_google_maps_embed') }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Office location"></iframe>
            </div>
        </div>
    </section>
    @include('frontend.partials.stickyCta')
@endsection

@section('jsIndex')
    <script src="{{ asset('assets/app/contactIndex.js') }}"></script>
@endsection
