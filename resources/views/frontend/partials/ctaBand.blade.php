<section class="fb-section fb-section--tight">
    <div class="container">
        <div class="fb-cta fb-reveal">
            <div class="fb-cta__in">
                <div>
                    <h2>{{ $heading ?? 'Need quick funds? Get your loan offer today.' }}</h2>
                    <p>{{ $text ?? 'Join 15,000+ customers who trust ' . config('web.store_data.app_name') . ' for hassle-free loans. Two minutes, minimal paperwork, no impact on your credit score.' }}</p>
                </div>
                <div class="fl-actions">
                    <a class="fl-btn fl-btn--white" href="{{ route('_personalServiceStart') }}">Personal Loan <i class="bi bi-arrow-right"></i></a>
                    <a class="fl-btn fl-btn--outline-white" href="{{ route('_businessServiceStart') }}">Business Loan</a>
                </div>
            </div>
        </div>
    </div>
</section>
