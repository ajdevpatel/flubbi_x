@extends('frontend.layoutIndex')

@section('pageTitle', 'Page not found')

@section('bodyIndex')
    <section class="fb-404">
        <div class="container">
            <div class="fb-404__code">404</div>
            <h2>We could not find that page</h2>
            <p>The link may be old or the page may have moved. Let us take you somewhere useful.</p>
            <div class="fl-actions fl-actions--center">
                <a class="fl-btn" href="{{ route('_homeIndex') }}"><i class="bi bi-house-door-fill"></i> Back to home</a>
                <a class="fl-btn fl-btn--ghost" href="{{ route('_personalServiceStart') }}">Check eligibility</a>
                <a class="fl-btn fl-btn--ghost" href="{{ route('_contactusPost') }}">Contact us</a>
            </div>
        </div>
    </section>
@endsection
