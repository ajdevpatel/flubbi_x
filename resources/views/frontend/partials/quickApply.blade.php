{{--
    Quick apply box: mode toggle (Self Apply / Hire Agent) + mobile number.
    Pure frontend: the number is kept in sessionStorage and pre-filled on the verify step.
    $type = personal | business (default personal)
--}}
@php
    $qa_type = $type ?? 'personal';
    $qa_self = route('_' . $qa_type . 'ServiceStart', ['login_type' => 'self']);
    $qa_agent = route('_' . $qa_type . 'ServiceStart', ['login_type' => 'consultant']);
    $qa_default = in_array($mode ?? '', ['self', 'consultant'], true) ? $mode : 'self';
@endphp
<div class="fb-quick" data-fb-quick>
    <div class="fb-mode" role="group" aria-label="How would you like to apply?">
        <button type="button" class="{{ 'self' === $qa_default ? 'is-active' : '' }}" data-mode="self"><i class="bi bi-person-check"></i> Easy Self-Apply</button>
        <button type="button" class="{{ 'consultant' === $qa_default ? 'is-active' : '' }}" data-mode="consultant"><i class="bi bi-headset"></i> Hire Loan Agent</button>
    </div>
    <form class="fb-quick__form" data-mode="{{ $qa_default }}" data-self="{{ $qa_self }}" data-consultant="{{ $qa_agent }}" novalidate>
        <div class="fb-quick__field">
            <span>+91</span>
            <input type="tel" name="phone" inputmode="numeric" maxlength="10" pattern="[0-9]{10}" placeholder="Enter mobile number" aria-label="Mobile number" autocomplete="tel-national">
        </div>
        <button type="submit" class="fl-btn">{{ $button ?? 'Get Started' }} <i class="bi bi-arrow-right"></i></button>
    </form>
    <div class="fb-quick__hint" aria-live="polite"></div>
    <p class="fb-quick__note">
        By clicking "{{ $button ?? 'Get Started' }}" you agree to our
        <a href="{{ route('_termsAndConditionsPost') }}" target="_blank">Terms</a> and
        <a href="{{ route('_privacyPolicyPost') }}" target="_blank">Privacy Policy</a>. No impact on your credit score.
    </p>
</div>
