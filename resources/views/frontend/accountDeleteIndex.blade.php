@extends('frontend.layoutIndex')

@section('pageTitle', 'Delete Account')

@section('bodyIndex')
    @include('frontend.partials.pageHead', [
        'title' => 'Delete Account',
        'subtitle' => 'We respect your privacy and your data. Verify your mobile number and your account is removed.',
        'crumbs' => ['Delete Account'],
    ])

    <section class="fb-section fb-section--soft">
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-start">
                <div class="col-lg-6 fb-reveal">
                    <span class="fb-eyebrow fb-eyebrow--accent">Important</span>
                    <h2 class="fb-title">Before you <span>delete</span></h2>
                    <p class="fb-lead" style="margin-bottom:22px;">Deleting your account removes your login and contact details from {{ config('web.store_data.app_name') }}. Please read what happens next.</p>

                    <div class="fb-contact-card">
                        <i class="bi bi-exclamation-triangle" style="color:var(--fb-err);background:var(--fb-err-soft);"></i>
                        <div>
                            <small>Irreversible action</small>
                            <strong>Your access to My Account, applications and documents is removed permanently.</strong>
                        </div>
                    </div>
                    <div class="fb-contact-card">
                        <i class="bi bi-person-x"></i>
                        <div>
                            <small>Unlinked data</small>
                            <strong>Your contact information is unlinked so you receive no further marketing from us.</strong>
                        </div>
                    </div>
                    <div class="fb-contact-card">
                        <i class="bi bi-bank"></i>
                        <div>
                            <small>Lender records</small>
                            <strong>Applications already submitted to a lender stay with that lender under their own policy.</strong>
                        </div>
                    </div>
                    <div class="fb-contact-card">
                        <i class="bi bi-arrow-counterclockwise"></i>
                        <div>
                            <small>Fresh start</small>
                            <strong>You are welcome to register again any time with the same mobile number.</strong>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 fb-reveal">
                    <div class="fl-card">
                        <div class="fl-card__head" style="text-align:center;">
                            <span class="fl-card__eyebrow">Verification</span>
                            <h2 class="fl-card__title">Confirm account deletion</h2>
                            <p class="fl-card__sub">Enter your registered mobile number. We will send a 6 digit OTP to confirm it is you.</p>
                        </div>

                        <div id="_deleteMessage" class="fb-msg"></div>

                        <form id="_deleteStep1" method="post" action="javascript:void(0);" novalidate>
                            <div class="fl-field">
                                <label class="fl-field__label" for="phone">Registered mobile number <span class="fl-req">*</span></label>
                                <div class="fl-field__prefix">
                                    <span>+91</span>
                                    <input class="fl-field__control numeric" type="tel" name="phone" id="phone" placeholder="10 digit mobile number" inputmode="numeric" required maxlength="10">
                                </div>
                            </div>
                            <div class="fl-actions">
                                <button type="submit" class="fl-btn fl-btn--block" id="sendOtpBtn"><i class="bi bi-send"></i> Send OTP</button>
                            </div>
                        </form>

                        <form id="_deleteStep2" method="post" action="javascript:void(0);" style="display:none;" novalidate>
                            <div class="fl-field">
                                <label class="fl-field__label" for="otp">One time password <span class="fl-req">*</span></label>
                                <input class="fl-field__control fl-otp numeric" type="text" name="otp" id="otp" inputmode="numeric" autocomplete="one-time-code" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" required maxlength="6">
                                <span class="fl-field__hint">Valid for 5 minutes. Your account is deleted the moment it is verified.</span>
                            </div>
                            <div class="fl-actions">
                                <button type="submit" class="fl-btn fl-btn--danger fl-btn--block" id="verifyOtpBtn"><i class="bi bi-trash3"></i> Confirm deletion</button>
                            </div>
                        </form>

                        <div class="fl-consent" style="text-align:center;">
                            Changed your mind? <a href="{{ route('_homeIndex') }}">Go back to the home page</a>. Platform fees already paid are non-refundable as per the <a href="{{ route('_refundPolicyPost') }}" target="_blank">Refund Policy</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('jsIndex')
    <script>
        $(document).ready(function() {
            function showMessage(msg, isError) {
                $('#_deleteMessage').text(msg).removeClass('is-ok is-err').addClass(isError ? 'is-err' : 'is-ok');
            }

            function busy($btn, on, label) {
                if (on) {
                    $btn.data('label', $btn.html()).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> ' + label);
                } else {
                    $btn.prop('disabled', false).html($btn.data('label'));
                }
            }

            $('#_deleteStep1').on('submit', function(e) {
                e.preventDefault();
                var phone = $('#phone').val();

                $.ajax({
                    url: "{{ route('_accountDeleteSendOtp') }}",
                    type: "POST",
                    data: { _token: "{{ csrf_token() }}", phone: phone },
                    beforeSend: function() {
                        busy($('#sendOtpBtn'), true, 'Sending...');
                        $('#_deleteMessage').removeClass('is-ok is-err');
                    },
                    success: function(response) {
                        busy($('#sendOtpBtn'), false);
                        if (response.status) {
                            showMessage(response.message, false);
                            $('#_deleteStep1').hide();
                            $('#_deleteStep2').show();
                            $('#otp').trigger('focus');
                        } else {
                            showMessage(response.message || 'Error sending OTP', true);
                        }
                    },
                    error: function(xhr) {
                        busy($('#sendOtpBtn'), false);
                        showMessage(429 === xhr.status ? 'Too many attempts. Please try again after a minute.' : 'Network error occurred.', true);
                    }
                });
            });

            $('#_deleteStep2').on('submit', function(e) {
                e.preventDefault();
                var phone = $('#phone').val();
                var otp = $('#otp').val();

                if (confirm("Are you sure you want to permanently delete your account? This action cannot be undone.")) {
                    $.ajax({
                        url: "{{ route('_accountDeleteVerify') }}",
                        type: "POST",
                        data: { _token: "{{ csrf_token() }}", phone: phone, otp: otp },
                        beforeSend: function() {
                            busy($('#verifyOtpBtn'), true, 'Verifying...');
                            $('#_deleteMessage').removeClass('is-ok is-err');
                        },
                        success: function(response) {
                            busy($('#verifyOtpBtn'), false);
                            if (response.status) {
                                showMessage(response.message, false);
                                $('#_deleteStep2').hide();
                            } else {
                                showMessage(response.message || 'Error verifying OTP', true);
                            }
                        },
                        error: function(xhr) {
                            busy($('#verifyOtpBtn'), false);
                            showMessage(429 === xhr.status ? 'Too many attempts. Please try again after a minute.' : 'Network error occurred.', true);
                        }
                    });
                }
            });
        });
    </script>
@endsection
