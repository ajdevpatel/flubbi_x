@extends('frontend.layoutIndex')

@section('pageTitle', $service['label'] . ' application - ' . $step_meta['label'])

@php
    $progress_labels = [];
    foreach ($steps as $s_meta) {
        if (!array_key_exists($s_meta['no'], $progress_labels)) {
            $progress_labels[$s_meta['no']] = $s_meta['label'];
        }
    }
    $current_no = (int) $step_meta['no'];
    $is_result = in_array($step, ['success', 'failed'], true);
    $amount_max = \App\Http\Controllers\Fend\LoanServiceController::LOAN_AMOUNT_MAX;
@endphp

@section('bodyIndex')
    @include('frontend.partials.pageHead', [
        'title' => $service['label'] . ' application',
        'subtitle' => $is_result ? null : 'Step ' . $current_no . ' of ' . $total_steps . ' - ' . ($progress_labels[$current_no] ?? ''),
        'crumbs' => [$service['label'] => route('_' . $service['type'] . 'ServiceIndex'), 'Apply'],
    ])

    <section class="fl-service">
        <div class="container">
            <div class="row fl-row g-4">

                <div class="col-lg-7 order-1">
                    <div class="fl-card">

                        @unless ($is_result)
                            <div class="fl-progress">
                                <div class="fl-progress__count">
                                    Step {{ $current_no }} of {{ $total_steps }} &mdash; {{ $progress_labels[$current_no] ?? '' }}
                                </div>
                                <div class="fl-progress__track">
                                    @foreach ($progress_labels as $p_no => $p_label)
                                        <div class="fl-progress__item {{ $p_no < $current_no ? 'is-done' : '' }} {{ $p_no == $current_no ? 'is-active' : '' }}">
                                            <div class="fl-progress__dot">
                                                @if ($p_no < $current_no)
                                                    <i class="bi bi-check-lg"></i>
                                                @else
                                                    {{ $p_no }}
                                                @endif
                                            </div>
                                            <span class="fl-progress__label">{{ $p_label }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endunless

                        <div class="fl-card__head">
                            <h2 class="fl-card__title">{{ $step_meta['title'] }}</h2>
                            @hasSection('stepSubtitle')
                                <p class="fl-card__sub">@yield('stepSubtitle')</p>
                            @endif
                        </div>

                        <div class="fl-inline-msg"></div>

                        @yield('stepBody')

                        @hasSection('stepFoot')
                            <div class="fl-consent">@yield('stepFoot')</div>
                        @else
                            <div class="fl-consent">
                                By continuing you agree to {{ config('web.store_data.app_name') }}'s
                                <a href="{{ route('_termsAndConditionsPost') }}" target="_blank">Terms &amp; Conditions</a> and
                                <a href="{{ route('_privacyPolicyPost') }}" target="_blank">Privacy Policy</a>, and consent to be
                                contacted by SMS, email and WhatsApp.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5 order-2">
                    <div class="fl-info">
                        <span class="fl-card__eyebrow">{{ $service['short'] }} &middot; 100% digital</span>
                        <h2 class="fl-info__title">
                            Get up to <span>&#8377; 1 Crore</span><br>
                            {{ $service['label'] }} in just a few clicks
                        </h2>
                        <p class="fl-info__sub">Paperless process &nbsp;|&nbsp; Offer in minutes &nbsp;|&nbsp; RBI regulated partners</p>

                        <ul class="fl-ticks">
                            <li><i class="bi bi-check-circle-fill"></i> No impact on your credit score</li>
                            <li><i class="bi bi-check-circle-fill"></i> Apply yourself or hire a {{ config('web.store_data.app_name') }} agent</li>
                            <li><i class="bi bi-check-circle-fill"></i> Progress saved after every step</li>
                        </ul>

                        @if (!empty($session_user->name) || !empty($loan->application_no))
                            <div class="fl-summary">
                                <h4><i class="bi bi-person-lines-fill"></i> Your application</h4>
                                @if (!empty($session_user->name))
                                    <div class="fl-summary__row"><span>Name</span><span>{{ $session_user->name }}</span></div>
                                @endif
                                @if (!empty($session_user->phone))
                                    <div class="fl-summary__row"><span>Mobile</span><span>+91 {{ $session_user->phone }}</span></div>
                                @endif
                                @if (!empty($loan->application_no))
                                    <div class="fl-summary__row"><span>Application no</span><span>{{ $loan->application_no }}</span></div>
                                @endif
                                @if (!empty($loan->eligible_amount))
                                    <div class="fl-summary__row"><span>Offer amount</span><span>&#8377; {{ number_format((float) $loan->eligible_amount) }}</span></div>
                                @endif
                                @if (!empty($loan->tenure_months))
                                    <div class="fl-summary__row"><span>Tenure</span><span>{{ $loan->tenure_months }} months</span></div>
                                @endif
                            </div>
                        @endif

                        @if (count($partners))
                            <div class="fl-info__partners">
                                <h6>Finance facility by our NBFC / lending partners</h6>
                                <div class="fl-partners fl-partners--compact">
                                    @foreach ($partners as $partner)
                                        <img src="{{ asset('banks/' . $partner->logo) }}" alt="{{ $partner->label }}" title="{{ $partner->label }}" loading="lazy">
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="up-note" style="margin-top:20px;">
                            <i class="bi bi-headset"></i>
                            <div>Need help? Call <a class="fl-link" href="tel:{{ preg_replace('/\D/', '', config('web.store_data.phone')) }}">{{ config('web.store_data.phone') }}</a> or write to <a class="fl-link" href="mailto:{{ config('web.store_data.support_mail') }}">{{ config('web.store_data.support_mail') }}</a>.</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('jsIndex')
    <script src="{{ asset('assets/app/loanService.js') }}?v={{ @filemtime(public_path('assets/app/loanService.js')) ?: 1 }}"></script>
    @yield('stepJs')
@endsection
