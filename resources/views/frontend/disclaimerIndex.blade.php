@extends('frontend.layoutIndex')

@section('pageTitle', 'Disclaimer')

@section('bodyIndex')
    @include('frontend.partials.pageHead', [
        'title' => 'Disclaimer',
        'subtitle' => 'What we are, what we are not, and the limits of our role.',
        'crumbs' => ['Disclaimer'],
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

                        <h2>Disclaimer – Legal Liability Protection</h2>
                        <hr>

                        <p>
                            This Disclaimer (“Disclaimer”) applies to the use of the {{ config('web.store_data.app_name') }} website
                            (“Website”)
                            operated by {{ config('web.store_data.company_name') }} (“we”, “us”, “our”).
                        </p>

                        <p>
                            By accessing or using the Website, you agree to this Disclaimer.
                        </p>

                        <hr>

                        <h3>1. No Lender Relationship</h3>
                        <p>
                            {{ config('web.store_data.company_name') }} is not a bank, NBFC, or financial institution, and we do not:
                        </p>
                        <ul>
                            <li>Approve or reject loans</li>
                            <li>Disburse loan amounts</li>
                            <li>Decide interest rates or tenure</li>
                            <li>Influence lender decisions</li>
                        </ul>
                        <p>
                            All loan decisions are made solely by the respective banks/NBFCs.
                        </p>

                        <hr>

                        <h3>2. Consultancy-Only Role</h3>
                        <p>
                            We operate only as a loan consultancy and facilitation platform.
                            Our services are limited to:
                        </p>
                        <ul>
                            <li>Providing general financial information</li>
                            <li>Assessing eligibility</li>
                            <li>Offering lender suggestions</li>
                            <li>Assisting with documentation</li>
                            <li>Facilitating the loan application process</li>
                        </ul>
                        <p>
                            We do not provide financial, legal, tax, investment, or credit advice.
                        </p>

                        <hr>

                        <h3>3. No Guarantee of Loan Approval</h3>
                        <p>We do not guarantee:</p>
                        <ul>
                            <li>Loan approval</li>
                            <li>Loan amount or terms</li>
                            <li>Processing speed or timeline</li>
                            <li>Accuracy of lender decisions</li>
                        </ul>
                        <p>
                            Loan approval depends solely on lender policies, internal risk models,
                            credit bureau checks, and other independent factors.
                        </p>

                        <hr>

                        <h3>4. Information Accuracy</h3>
                        <p>
                            While we strive to keep the information accurate and updated, we do not guarantee:
                        </p>
                        <ul>
                            <li>Completeness</li>
                            <li>Timeliness</li>
                            <li>Accuracy</li>
                            <li>Reliability</li>
                        </ul>
                        <p>
                            Interest rates, loan details, lender criteria, and eligibility norms are subject to change
                            without notice.
                            We are not responsible for errors, omissions, or outdated information.
                        </p>

                        <hr>

                        <h3>5. Third-Party Links &amp; Services</h3>
                        <p>The Website may contain links to:</p>
                        <ul>
                            <li>Banks/NBFC websites</li>
                            <li>Third-party APIs</li>
                            <li>Verification services</li>
                            <li>External financial tools</li>
                        </ul>
                        <p>
                            We do not endorse or control these external services.
                            We are not liable for:
                        </p>
                        <ul>
                            <li>Their content</li>
                            <li>Their practices</li>
                            <li>Any loss or damage caused by their services</li>
                        </ul>

                        <hr>

                        <h3>6. User Responsibility</h3>
                        <p>You acknowledge that:</p>
                        <ul>
                            <li>You submit information voluntarily.</li>
                            <li>You are responsible for the correctness of all documents and details.</li>
                            <li>You assume all risks associated with financial decisions.</li>
                        </ul>
                        <p>
                            We strongly advise consulting professional financial advisors before making financial
                            commitments.
                        </p>

                        <hr>

                        <h3>7. No Professional Advice</h3>
                        <p>
                            Information provided on the Website is for general educational and informational purposes only.
                            It should not be treated as:
                        </p>
                        <ul>
                            <li>Financial advice</li>
                            <li>Legal advice</li>
                            <li>Investment advice</li>
                            <li>Tax planning advice</li>
                        </ul>
                        <p>
                            Any decisions made based on Website content are at your own risk.
                        </p>

                        <hr>

                        <h3>8. Limitation of Liability</h3>
                        <p>
                            To the maximum extent permitted by law, we are not liable for:
                        </p>
                        <ul>
                            <li>Loan rejection or modification</li>
                            <li>Financial loss or damages</li>
                            <li>Delay in processing by lenders</li>
                            <li>Incorrect or incomplete data from third parties</li>
                            <li>Technical errors, downtime, or service interruptions</li>
                            <li>Loss of profits, data, or business opportunities</li>
                        </ul>
                        <p>
                            Your use of the Website is at your sole risk.
                        </p>

                        <hr>

                        <h3>9. Indemnification</h3>
                        <p>
                            You agree to indemnify and hold {{ config('web.store_data.company_name') }} harmless from any claims, damages,
                            losses, and liabilities arising out of:
                        </p>
                        <ul>
                            <li>Misuse of the Website</li>
                            <li>Submission of incorrect information</li>
                            <li>Violation of Terms &amp; Conditions</li>
                            <li>Fraudulent activities</li>
                        </ul>

                        <hr>

                        <h3>10. Changes to Disclaimer</h3>
                        <p>
                            We may update or amend this Disclaimer at any time.
                            Updates will be posted on the Website with a revised “Last Updated” date.
                        </p>

                        <hr>

                        <h3>11. Contact Us</h3>
                        @include('frontend.block.contactus')



                    </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
