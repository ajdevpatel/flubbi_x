@extends('frontend.layoutIndex')

@section('pageTitle', 'Credit Cards - Coming Soon')

@section('bodyIndex')
    <section class="cs-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="cs-soon"><i></i> Coming soon</span>
                    <h1 class="cs-title">Credit cards, <span>the {{ config('web.store_data.app_name') }} way.</span></h1>
                    <p class="cs-lead">We are building a simpler way to find the right credit card. Compare cards from our
                        partner banks, check where you stand, and apply online without the paperwork. It is almost ready.</p>
                    <ul class="fb-chips">
                        <li><i class="bi bi-columns-gap"></i> Compare partner cards</li>
                        <li><i class="bi bi-lightning-charge"></i> Quick eligibility check</li>
                        <li><i class="bi bi-shield-check"></i> 100% online</li>
                    </ul>
                    <div class="fl-actions" style="margin:0;">
                        <a class="fl-btn fl-btn--white" href="{{ route('_personalServiceIndex') }}">Explore Personal Loan <i class="bi bi-arrow-right"></i></a>
                        <a class="fl-btn fl-btn--outline-white" href="{{ route('_businessServiceIndex') }}">Business Loan</a>
                    </div>
                    <p class="fb-note" style="margin:18px 0 0;color:#9db2d9;">Need funds today? Our loan services are live right now.</p>
                </div>
                <div class="col-lg-6">
                    <div class="cs-stage" aria-hidden="true">
                        <div class="cs-card cs-card--back">
                            <div class="cs-card__top"><span>{{ strtoupper(config('web.store_data.app_name')) }}</span><i class="bi bi-wifi"></i></div>
                            <div class="cs-card__chip"></div>
                            <div class="cs-card__number">&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; 0000</div>
                            <div class="cs-card__foot">
                                <div>Card holder<strong>Your name</strong></div>
                                <div>Valid<strong>&bull;&bull;/&bull;&bull;</strong></div>
                            </div>
                        </div>
                        <div class="cs-card cs-card--front">
                            <div class="cs-card__top"><span>{{ strtoupper(config('web.store_data.app_name')) }}</span><i class="bi bi-wifi"></i></div>
                            <div class="cs-card__chip"></div>
                            <div class="cs-card__number">&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; {{ date('Y') }}</div>
                            <div class="cs-card__foot">
                                <div>Card holder<strong>Coming soon</strong></div>
                                <div>Status<strong>In progress</strong></div>
                            </div>
                        </div>
                        <div class="cs-glow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fb-section fb-section--soft">
        <div class="container">
            <div class="fb-head fb-reveal">
                <span class="fb-eyebrow">What to expect</span>
                <h2 class="fb-title">The same simple, guided experience, <span>built for cards</span></h2>
            </div>
            <div class="row g-4">
                @foreach ([
                    ['bi-columns-gap', 'Compare side by side', 'See cards from our partner banks in one place, so you can pick what fits how you spend.'],
                    ['bi-speedometer2', 'Know before you apply', 'Share a few details and find out which cards you are likely to qualify for.'],
                    ['bi-phone', 'Apply from your phone', 'A short online journey with clear steps, and our team on hand if you get stuck.'],
                ] as [$icon, $title, $text])
                    <div class="col-md-4 fb-reveal">
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

    @include('frontend.partials.ctaBand', ['heading' => 'Have a question about cards?', 'text' => 'Tell us what you are looking for and we will get back to you. Meanwhile, our loan services are live.'])
    @include('frontend.partials.stickyCta', ['label' => 'Cards coming soon', 'text' => 'Loans are live today'])
@endsection
