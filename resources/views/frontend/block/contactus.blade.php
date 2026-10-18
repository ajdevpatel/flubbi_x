<div class="up-note" style="margin:10px 0 18px;">
    <i class="bi bi-building"></i>
    <div>
        <strong>{{ config('web.store_data.company_name') }}</strong><br>
        Email: <a class="fl-link" href="mailto:{{ config('web.store_data.support_mail') }}">{{ config('web.store_data.support_mail') }}</a><br>
        Phone: <a class="fl-link" href="tel:{{ preg_replace('/\D/', '', config('web.store_data.phone')) }}">{{ config('web.store_data.phone') }}</a><br>
        Address: {{ config('web.store_data.location') }}
    </div>
</div>
