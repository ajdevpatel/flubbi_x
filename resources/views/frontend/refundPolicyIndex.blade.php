@extends('frontend.layoutIndex')

@section('pageTitle', 'Refund & Cancellation Policy')

@section('bodyIndex')
    @include('frontend.partials.pageHead', [
        'title' => 'Refund & Cancellation Policy',
        'subtitle' => 'How cancellations and refunds are handled for our services.',
        'crumbs' => ['Refund & Cancellation Policy'],
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

                        <h2>Refund &amp; Cancellation Policy</h2>
                        <hr>

                        <p>
                            This Refund &amp; Cancellation Policy (“Policy”) explains how
                            {{ config('web.store_data.company_name') }} (“we”, “us”, “our”) handles cancellations and refunds for
                            services offered through the {{ config('web.store_data.app_name') }} website (“Website”).
                        </p>

                        <p>
                            By using our Website or purchasing any services, you agree to this Policy.
                        </p>

                        <hr>

                        <h3>1. Nature of Services</h3>
                        <p>
                            {{ config('web.store_data.company_name') }} provides personal loan consultancy and related assistance services.
                            We are not a lender and do not sanction, approve, or disburse loans.
                            Our fees (if any) are charged for consultancy, assessment, documentation assistance,
                            and support only.
                        </p>

                        <hr>

                        <h3>2. No Refund for Services Already Provided</h3>
                        <p>Once a service has been:</p>
                        <ul>
                            <li>Availed</li>
                            <li>Processed</li>
                            <li>Assigned to a consultant</li>
                            <li>Partially or fully completed</li>
                            <li>Used for loan eligibility assessment or submission</li>
                        </ul>

                        <p><strong>No refund shall be issued.</strong></p>

                        <p>This includes services like:</p>
                        <ul>
                            <li>Eligibility analysis</li>
                            <li>Documentation support</li>
                            <li>Loan application submission</li>
                            <li>KYC verification assistance</li>
                        </ul>

                        <hr>

                        <h3>3. Refund Eligibility</h3>
                        <p>A refund may be considered only in the following exceptional situations:</p>

                        <ul>
                            <li>
                                <strong>Duplicate payment</strong><br>
                                If you have been charged twice for the same service due to a technical error.
                            </li>
                            <li>
                                <strong>Payment made but service not started</strong><br>
                                If we have not initiated any consultancy or document review within
                                24–48 hours of payment (excluding weekends/holidays).
                            </li>
                            <li>
                                <strong>Service not delivered due to technical failure</strong><br>
                                If you were unable to access paid services because of system errors on our side.
                            </li>
                        </ul>

                        <hr>

                        <h3>4. Non-Refundable Situations</h3>
                        <p>Refunds will not be provided for:</p>
                        <ul>
                            <li>Loan rejection by lender</li>
                            <li>Change of mind after payment</li>
                            <li>Incorrect details submitted by the user</li>
                            <li>Delay caused by banks/NBFCs</li>
                            <li>Incomplete documentation from the user</li>
                            <li>Consultant time already spent on your case</li>
                            <li>Loan not meeting your expectations (amount, interest rate, tenure, etc.)</li>
                        </ul>

                        <hr>

                        <h3>5. Cancellation Policy</h3>

                        <h4>5.1 User-Initiated Cancellation</h4>
                        <ul>
                            <li>You may cancel a service request before it is assigned or initiated.</li>
                            <li>If the service has already started, cancellation will not be allowed.</li>
                        </ul>

                        <h4>5.2 Company-Initiated Cancellation</h4>
                        <p>We reserve the right to cancel orders due to:</p>
                        <ul>
                            <li>Fraudulent documents</li>
                            <li>Misrepresentation</li>
                            <li>Non-cooperation</li>
                            <li>Regulatory issues</li>
                            <li>Technical limitations</li>
                        </ul>

                        <p>
                            In such cases, refunds (if any) will be determined on a case-by-case basis.
                        </p>

                        <hr>

                        <h3>6. Refund Process</h3>
                        <p>If your refund request is approved:</p>
                        <ul>
                            <li>Refund will be processed within 7–14 working days</li>
                            <li>Amount will be credited to the original payment method</li>
                            <li>You will receive a confirmation via email/SMS</li>
                        </ul>

                        <hr>

                        <h3>7. How to Request a Refund</h3>
                        <p>To raise a refund or cancellation request, contact:</p>

                        @include('frontend.block.contactus')


                        <p>Please provide:</p>
                        <ul>
                            <li>Your name</li>
                            <li>Registered mobile number</li>
                            <li>Payment receipt / transaction ID</li>
                            <li>Reason for refund request</li>
                        </ul>

                        <hr>

                        <h3>8. Amendments to Policy</h3>
                        <p>
                            We may update or modify this Policy at any time.
                            Changes will be posted on the Website along with the updated “Last Updated” date.
                        </p>


                    </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
