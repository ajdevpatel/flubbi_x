@php
    $crumbs = $crumbs ?? [];
@endphp
<section class="fb-pagehead">
    <div class="container">
        <ol class="fb-crumb" aria-label="Breadcrumb">
            <li><a href="{{ route('_homeIndex') }}"><i class="bi bi-house-door-fill"></i> Home</a></li>
            @foreach ($crumbs as $label => $url)
                @if (is_int($label))
                    <li aria-current="page">{{ $url }}</li>
                @else
                    <li><a href="{{ $url }}">{{ $label }}</a></li>
                @endif
            @endforeach
        </ol>
        <h1>{{ $title }}</h1>
        @if (!empty($subtitle))
            <p>{{ $subtitle }}</p>
        @endif
    </div>
</section>
