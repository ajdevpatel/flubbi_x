@extends('frontend.layoutIndex')

@section('pageTitle', 'Loan EMI Calculator')

@php
    $app_name = config('web.store_data.app_name');
    $amount_presets = [100000, 500000, 1000000, 2500000, 5000000, 10000000];
    $tenure_presets = [12, 36, 60, 120, 240, 360];
@endphp

@section('bodyIndex')
    @include('frontend.partials.pageHead', [
        'title' => 'EMI Calculator',
        'subtitle' => 'Plan before you borrow. See your monthly EMI, how much goes to interest, and how a different tenure changes the picture.',
        'crumbs' => ['EMI Calculator'],
    ])

    <section class="emx">
        <div class="container">
            <div class="row g-4 align-items-start">

                {{-- Controls --}}
                <div class="col-lg-7 order-2 order-lg-1">
                    <div class="emx-panel">
                        <div class="emx-panel__head">
                            <span class="fb-eyebrow"><i class="bi bi-sliders"></i> Your loan</span>
                            <button type="button" class="fl-btn fl-btn--link emx-reset" id="emx_reset"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                        </div>

                        <div class="emx-control">
                            <div class="emx-control__head">
                                <label for="emx_amount">Loan amount</label>
                                <div class="emx-input emx-input--prefix">
                                    <span>&#8377;</span>
                                    <input type="text" id="emx_amount" inputmode="numeric" maxlength="11" value="5,00,000" aria-label="Loan amount">
                                </div>
                            </div>
                            <input type="range" class="fl-range" id="emx_amount_range" min="50000" max="10000000" step="10000" value="500000" aria-label="Loan amount slider">
                            <div class="fl-range__scale"><span>&#8377; 50,000</span><span>&#8377; 1 Crore</span></div>
                            <div class="emx-chips" data-for="amount">
                                @foreach ($amount_presets as $a)
                                    <button type="button" data-value="{{ $a }}">&#8377; {{ $a >= 10000000 ? rtrim(rtrim(number_format($a / 10000000, 1), "0"), ".") . " Cr" : rtrim(rtrim(number_format($a / 100000, 1), "0"), ".") . " L" }}</button>
                                @endforeach
                            </div>
                        </div>

                        <div class="emx-control">
                            <div class="emx-control__head">
                                <label for="emx_rate">Interest rate <small>per year</small></label>
                                <div class="emx-input emx-input--suffix">
                                    <input type="text" id="emx_rate" inputmode="decimal" maxlength="5" value="10.55" aria-label="Interest rate">
                                    <span>%</span>
                                </div>
                            </div>
                            <input type="range" class="fl-range" id="emx_rate_range" min="6" max="36" step="0.05" value="10.55" aria-label="Interest rate slider">
                            <div class="fl-range__scale"><span>6%</span><span>36%</span></div>
                        </div>

                        <div class="emx-control">
                            <div class="emx-control__head">
                                <label for="emx_months">Tenure</label>
                                <div class="emx-input emx-input--suffix">
                                    <input type="text" id="emx_months" inputmode="numeric" maxlength="3" value="36" aria-label="Tenure in months">
                                    <span>months</span>
                                </div>
                            </div>
                            <input type="range" class="fl-range" id="emx_months_range" min="6" max="360" step="6" value="36" aria-label="Tenure slider">
                            <div class="fl-range__scale"><span>6 months</span><span>30 years</span></div>
                            <div class="emx-chips" data-for="months">
                                @foreach ($tenure_presets as $m)
                                    <button type="button" data-value="{{ $m }}">{{ $m < 12 ? $m . " mo" : ($m / 12) . ($m == 12 ? " yr" : " yrs") }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Compare tenures --}}
                    <div class="emx-panel emx-panel--soft">
                        <div class="emx-panel__head">
                            <div>
                                <h4>Compare tenures</h4>
                                <p>Same amount and rate. Tap a card to switch tenure.</p>
                            </div>
                        </div>
                        <div class="emx-compare" id="emx_compare"></div>
                    </div>
                </div>

                {{-- Result --}}
                <div class="col-lg-5 order-1 order-lg-2">
                    <div class="emx-result">
                        <div class="emx-donut">
                            <svg viewBox="0 0 120 120" aria-hidden="true">
                                <circle class="emx-donut__track" cx="60" cy="60" r="50"></circle>
                                <circle class="emx-donut__interest" id="emx_arc_i" cx="60" cy="60" r="50"></circle>
                                <circle class="emx-donut__principal" id="emx_arc_p" cx="60" cy="60" r="50"></circle>
                            </svg>
                            <div class="emx-donut__center">
                                <small>Monthly EMI</small>
                                <strong id="emx_emi">&#8377; 0</strong>
                                <span id="emx_summary">for 36 months</span>
                            </div>
                        </div>

                        <div class="emx-legend">
                            <span><i class="is-p"></i> Principal <b id="emx_pct_p">0%</b></span>
                            <span><i class="is-i"></i> Interest <b id="emx_pct_i">0%</b></span>
                        </div>

                        <div class="emx-kv">
                            <div><span>Principal</span><strong id="emx_principal">&#8377; 0</strong></div>
                            <div><span>Total interest</span><strong id="emx_interest">&#8377; 0</strong></div>
                            <div class="is-total"><span>Total payable</span><strong id="emx_total">&#8377; 0</strong></div>
                        </div>

                        <div class="emx-insight" id="emx_insight"></div>

                        <a class="fl-btn fl-btn--block" href="{{ route('_personalServiceStart') }}">Check my real eligibility <i class="bi bi-arrow-right"></i></a>
                        <p class="emx-note">No paperwork, no impact on your credit score. Takes about 2 minutes.</p>
                    </div>
                </div>
            </div>

            {{-- Schedule --}}
            <div class="emx-panel emx-schedule fb-reveal">
                <div class="emx-panel__head">
                    <div>
                        <h4>Repayment schedule</h4>
                        <p>How each payment splits between principal and interest, and what is left to pay.</p>
                    </div>
                    <div class="emx-toggle" role="tablist">
                        <button type="button" class="is-active" data-view="year">Yearly</button>
                        <button type="button" data-view="month">Monthly</button>
                    </div>
                </div>
                <div class="emx-table-wrap">
                    <table class="emx-table">
                        <thead>
                            <tr>
                                <th id="emx_th_period">Year</th>
                                <th>Principal paid</th>
                                <th>Interest paid</th>
                                <th>Total paid</th>
                                <th>Balance</th>
                                <th class="emx-th-bar">Paid off</th>
                            </tr>
                        </thead>
                        <tbody id="emx_tbody"></tbody>
                    </table>
                </div>
                <div class="emx-more">
                    <button type="button" class="fl-btn fl-btn--ghost fl-btn--sm" id="emx_more" hidden>Show all months <i class="bi bi-chevron-down"></i></button>
                </div>
            </div>

            {{-- How it works --}}
            <div class="row g-3 g-lg-4 fb-reveal">
                <div class="col-md-4">
                    <div class="fb-feature">
                        <i class="bi bi-calculator"></i>
                        <div>
                            <h4>How EMI is calculated</h4>
                            <p>EMI = P &times; r &times; (1 + r)<sup>n</sup> / ((1 + r)<sup>n</sup> &minus; 1), where P is the amount, r the monthly rate and n the number of months.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fb-feature">
                        <i class="bi bi-hourglass-split"></i>
                        <div>
                            <h4>Shorter tenure, less interest</h4>
                            <p>A longer tenure lowers the EMI but raises the total interest. Use the compare cards above to find your balance.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fb-feature">
                        <i class="bi bi-info-circle"></i>
                        <div>
                            <h4>Indicative figures</h4>
                            <p>Calculated on a reducing balance. The final EMI, rate and tenure are decided by the lending partner at sanction.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.ctaBand', ['heading' => 'Like the numbers?', 'text' => 'Check your real eligibility in two minutes and get a pre-approved offer from ' . $app_name . '.'])
@endsection

@section('jsIndex')
    <script>
        (function () {
            var LIM = { amount: [50000, 10000000], rate: [6, 36], months: [6, 360] };
            var DEF = { amount: 500000, rate: 10.55, months: 36 };
            var TENURES = @json($tenure_presets);
            var CIRC = 2 * Math.PI * 50;
            var state = { amount: DEF.amount, rate: DEF.rate, months: DEF.months };
            var view = "year", expanded = false;

            function inr(n) { return "₹ " + Math.round(n).toLocaleString("en-IN"); }
            function num(s) { return parseInt(String(s).replace(/[^0-9]/g, ""), 10); }
            function dec(s) { return parseFloat(String(s).replace(/[^0-9.]/g, "")); }
            function clamp(v, k) { v = isNaN(v) ? LIM[k][0] : v; return Math.max(LIM[k][0], Math.min(LIM[k][1], v)); }
            function emiOf(p, rate, n) { var r = rate / 1200; return r > 0 ? p * r * Math.pow(1 + r, n) / (Math.pow(1 + r, n) - 1) : p / n; }
            function fmtMonths(n) { var y = Math.floor(n / 12), m = n % 12; return (y ? y + (y > 1 ? " years" : " year") : "") + (y && m ? " " : "") + (m ? m + " mo" : ""); }

            var $ = window.jQuery;
            var el = {
                amount: $("#emx_amount"), amountR: $("#emx_amount_range"),
                rate: $("#emx_rate"), rateR: $("#emx_rate_range"),
                months: $("#emx_months"), monthsR: $("#emx_months_range")
            };

            function paintRange($r, v) {
                var min = parseFloat($r.attr("min")), max = parseFloat($r.attr("max"));
                $r.val(v).css("--fl-range-fill", ((v - min) / (max - min) * 100) + "%");
            }

            function syncInputs() {
                el.amount.val(state.amount.toLocaleString("en-IN"));
                el.rate.val(String(state.rate));
                el.months.val(String(state.months));
                paintRange(el.amountR, state.amount);
                paintRange(el.rateR, state.rate);
                paintRange(el.monthsR, state.months);
                $(".emx-chips[data-for=amount] button").each(function () { $(this).toggleClass("is-active", num(this.getAttribute("data-value")) === state.amount); });
                $(".emx-chips[data-for=months] button").each(function () { $(this).toggleClass("is-active", num(this.getAttribute("data-value")) === state.months); });
            }

            function render() {
                var p = state.amount, n = state.months, rate = state.rate;
                var emi = emiOf(p, rate, n), total = emi * n, interest = total - p;
                var pctI = total > 0 ? interest / total : 0, pctP = 1 - pctI;

                $("#emx_emi").text(inr(emi));
                $("#emx_summary").text("for " + n + " months (" + fmtMonths(n) + ") at " + rate + "%");
                $("#emx_principal").text(inr(p));
                $("#emx_interest").text(inr(interest));
                $("#emx_total").text(inr(total));
                $("#emx_pct_p").text(Math.round(pctP * 100) + "%");
                $("#emx_pct_i").text(Math.round(pctI * 100) + "%");

                document.getElementById("emx_arc_p").style.strokeDasharray = (CIRC * pctP) + " " + CIRC;
                document.getElementById("emx_arc_i").style.strokeDasharray = CIRC + " " + CIRC;

                // insight: compare with next shorter preset tenure
                var shorter = null;
                for (var i = TENURES.length - 1; i >= 0; i--) { if (TENURES[i] < n) { shorter = TENURES[i]; break; } }
                var $ins = $("#emx_insight");
                if (shorter) {
                    var e2 = emiOf(p, rate, shorter), save = interest - (e2 * shorter - p);
                    $ins.html('<i class="bi bi-lightbulb"></i><div>Choose <strong>' + fmtMonths(shorter) + '</strong> instead and pay <strong>' + inr(e2 - emi) + '</strong> more per month, but save <strong>' + inr(save) + '</strong> in interest.</div>').show();
                } else {
                    $ins.html('<i class="bi bi-lightbulb"></i><div>You are on the shortest preset tenure. Interest is <strong>' + Math.round(pctI * 100) + '%</strong> of what you pay back.</div>').show();
                }

                renderCompare(p, rate, n);
                renderSchedule(p, rate, n, emi);
            }

            function renderCompare(p, rate, n) {
                var html = "";
                TENURES.forEach(function (m) {
                    var e = emiOf(p, rate, m), it = e * m - p;
                    html += '<button type="button" class="emx-cmp' + (m === n ? ' is-active' : '') + '" data-months="' + m + '">'
                        + '<small>' + fmtMonths(m) + '</small><strong>' + inr(e) + '</strong><span>Interest ' + inr(it) + '</span></button>';
                });
                $("#emx_compare").html(html);
            }

            function renderSchedule(p, rate, n, emi) {
                var r = rate / 1200, bal = p, rows = [], now = new Date();
                var yP = 0, yI = 0, yStart = 1;
                for (var m = 1; m <= n; m++) {
                    var it = bal * r, pr = emi - it;
                    bal = Math.max(0, bal - pr);
                    if (view === "month") {
                        var d = new Date(now.getFullYear(), now.getMonth() + m, 1);
                        rows.push({ label: d.toLocaleString("en-IN", { month: "short", year: "numeric" }), p: pr, i: it, bal: bal });
                    } else {
                        yP += pr; yI += it;
                        if (m % 12 === 0 || m === n) {
                            rows.push({ label: "Year " + Math.ceil(m / 12), p: yP, i: yI, bal: bal });
                            yP = 0; yI = 0; yStart = m + 1;
                        }
                    }
                }
                $("#emx_th_period").text(view === "month" ? "Month" : "Year");
                var limit = (view === "month" && !expanded) ? 12 : rows.length;
                var html = "";
                rows.slice(0, limit).forEach(function (row) {
                    var paid = p > 0 ? Math.round((1 - row.bal / p) * 100) : 0;
                    html += "<tr><td><strong>" + row.label + "</strong></td><td>" + inr(row.p) + "</td><td>" + inr(row.i) + "</td><td>" + inr(row.p + row.i) + "</td><td>" + inr(row.bal) + "</td>"
                        + '<td class="emx-th-bar"><div class="emx-bar"><i style="width:' + paid + '%"></i></div><small>' + paid + '%</small></td></tr>';
                });
                $("#emx_tbody").html(html);
                var $more = $("#emx_more");
                if (view === "month" && rows.length > 12) {
                    $more.prop("hidden", false).html(expanded ? 'Show first 12 months <i class="bi bi-chevron-up"></i>' : 'Show all ' + rows.length + ' months <i class="bi bi-chevron-down"></i>');
                } else {
                    $more.prop("hidden", true);
                }
            }

            function set(k, v) { state[k] = clamp(v, k); syncInputs(); render(); }

            el.amountR.on("input change", function () { set("amount", parseInt(this.value, 10)); });
            el.rateR.on("input change", function () { set("rate", Math.round(parseFloat(this.value) * 100) / 100); });
            el.monthsR.on("input change", function () { set("months", parseInt(this.value, 10)); });

            el.amount.on("input", function () { var v = num(this.value); if (!isNaN(v)) { state.amount = clamp(v, "amount"); paintRange(el.amountR, state.amount); render(); } })
                .on("blur", function () { set("amount", Math.round(num(this.value) / 1000) * 1000); });
            el.rate.on("input", function () { var v = dec(this.value); if (!isNaN(v)) { state.rate = clamp(v, "rate"); paintRange(el.rateR, state.rate); render(); } })
                .on("blur", function () { set("rate", Math.round(dec(this.value) * 100) / 100); });
            el.months.on("input", function () { var v = num(this.value); if (!isNaN(v)) { state.months = clamp(v, "months"); paintRange(el.monthsR, state.months); render(); } })
                .on("blur", function () { set("months", num(this.value)); });

            $(document).on("click", ".emx-chips[data-for=amount] button", function () { set("amount", num(this.getAttribute("data-value"))); });
            $(document).on("click", ".emx-chips[data-for=months] button", function () { set("months", num(this.getAttribute("data-value"))); });
            $(document).on("click", ".emx-cmp", function () { set("months", parseInt(this.getAttribute("data-months"), 10)); });
            $(".emx-toggle button").on("click", function () {
                view = this.getAttribute("data-view"); expanded = false;
                $(".emx-toggle button").removeClass("is-active"); $(this).addClass("is-active");
                render();
            });
            $("#emx_more").on("click", function () { expanded = !expanded; render(); });
            $("#emx_reset").on("click", function () { state = { amount: DEF.amount, rate: DEF.rate, months: DEF.months }; syncInputs(); render(); });

            syncInputs();
            render();
        })();
    </script>
@endsection
