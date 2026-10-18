@extends('frontend.layoutIndex')

@section('pageTitle', 'Frequently Asked Questions')

@section('bodyIndex')
    @include('frontend.partials.pageHead', [
        'title' => 'Frequently Asked Questions',
        'subtitle' => 'Everything about eligibility, documents, fees and how the process works.',
        'crumbs' => ['FAQs'],
    ])

    <section class="fb-section fb-section--soft">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="fb-faq fb-reveal">
                        @foreach ((array) config('web.faq.faq_page', []) as $k => $v)
                            <details class="fb-faq__item" @if (0 === $k) open @endif>
                                <summary>{{ $v['question'] }}</summary>
                                <div class="fb-faq__body">{{ $v['answer'] }}</div>
                            </details>
                        @endforeach
                    </div>

                    <div class="up-note fb-reveal" style="margin-top:24px;">
                        <i class="bi bi-chat-dots"></i>
                        <div>Still have a question? <a class="fl-link" href="{{ route('_contactusPost') }}">Contact us</a> or call
                            <a class="fl-link" href="tel:{{ preg_replace('/\D/', '', config('web.store_data.phone')) }}">{{ config('web.store_data.phone') }}</a>.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.ctaBand')
    @include('frontend.partials.stickyCta')
@endsection
