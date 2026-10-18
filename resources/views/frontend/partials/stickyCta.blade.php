{{-- Mobile-only sticky bottom banner. Shown on marketing pages only (not on the journey or the panel). --}}
<div class="fb-sticky-cta" role="complementary" aria-label="Quick apply">
    <div>
        <small>{{ $label ?? 'Need instant funds?' }}</small>
        <strong>{{ $text ?? "Loan up to \u{20B9} 1 Crore" }}</strong>
    </div>
    <a class="fl-btn" href="{{ $url ?? route('_personalServiceStart') }}">{{ $button ?? 'Apply Now' }} <i class="bi bi-arrow-right"></i></a>
</div>
