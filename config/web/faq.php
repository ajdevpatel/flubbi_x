<?php

$app = $_ENV["APP_NAME"] ?? "FleshFin";

return [
    "faq_page" => [
        [
            "question" => "How fast can I get a loan through " . $app . "?",
            "answer" => "Your eligibility check takes about 2 minutes and your pre-approved offer is shown instantly on screen. Once your file is complete, partner lenders can approve within hours of submission, and the funds are disbursed directly by the lender to your bank account."
        ],
        [
            "question" => "What is the maximum loan amount I can get?",
            "answer" => "Depending on your income, running EMIs and credit profile, our lending partners offer personal and business loans of up to Rs. 1 Crore with tenures from 12 to 240 months. The final sanctioned amount is decided by the lender."
        ],
        [
            "question" => "What is the interest rate on these loans?",
            "answer" => "Interest rates start from 10.55% per annum. The exact rate depends on your credit score, income and the lending partner you choose. We show you an indicative EMI before you decide, so there are no surprises."
        ],
        [
            "question" => "Are there any hidden charges or fees?",
            "answer" => "No. We believe in full disclosure. " . $app . " charges one small platform fee that is shown clearly before you pay, and every lender-side charge is disclosed by the lender at sanction. You always know exactly what you are getting into."
        ],
        [
            "question" => "Does checking my eligibility affect my credit score?",
            "answer" => "No. Checking your eligibility with " . $app . " is a soft enquiry and does not impact your credit score. A hard enquiry happens only when you formally apply with a lender."
        ],
        [
            "question" => "What can a personal loan be used for?",
            "answer" => "Almost any personal need: a medical emergency, wedding, travel, education, home renovation, a big purchase or consolidating high-interest debts into one easy EMI."
        ],
        [
            "question" => "What are the eligibility requirements?",
            "answer" => "For salaried professionals:\n- Minimum age 21 years\n- Minimum salary Rs. 15,000 per month (reflected in your bank statement)\n- At least 1 year of job stability\n\nFor self-employed:\n- Minimum age 21 years\n- Income tax return for at least 1 year\n- At least 1 year of business stability"
        ],
        [
            "question" => "What documents are required?",
            "answer" => "Minimal paperwork, fully online.\n\nFor salaried:\n- Aadhaar card and PAN card\n- Residence proof: rent agreement or utility bill\n- Bank statement\n- Income proof: salary slips or Form 16\n\nFor self-employed:\n- Aadhaar card and PAN card\n- Residence proof: rent agreement or utility bill\n- Bank statement\n- Income tax returns and business proof (GST, MSME or trade licence)\n\nBased on your profile, the lender may ask for additional documents."
        ],
        [
            "question" => "Can I use a personal loan to consolidate debt?",
            "answer" => "Yes. A personal loan can bring together your high-interest credit card and loan dues into a single loan with one lower EMI, making repayment simpler and often cheaper."
        ],
        [
            "question" => "What is the difference between Self Login and Hire Agent?",
            "answer" => "Both give you the same pre-approved offer. With Self Login you get direct apply links to our lending partners and complete the application yourself. With Hire Agent, a dedicated " . $app . " agent calls you within one working day, collects documents over WhatsApp, coordinates with the best-fit lender and follows up until disbursal."
        ],
        [
            "question" => "How can I improve my chances of approval?",
            "answer" => "Maintain a good credit score, keep your income consistent and reflected in your bank account, keep existing EMIs below 40% of your income, and provide accurate documents the first time. Lenders also consider your age, employer and job or business stability."
        ],
        [
            "question" => "Is " . $app . " a lender?",
            "answer" => "No. " . $app . " is a digital loan consultancy and technology platform. We check your eligibility, match you with RBI regulated banks and NBFCs and help with documentation and follow-ups. Loan sanction, interest rate, tenure and disbursal are decided solely by the lending partner."
        ],
    ]
];
