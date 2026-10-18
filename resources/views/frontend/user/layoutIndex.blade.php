@extends('frontend.layoutIndex')

@section('pageTitle', trim($__env->yieldContent('panelTitle', 'My Account')))

@section('bodyIndex')
    @php
        $panel_crumbs = ['My Account' => route('_userDashboard')];
        $panel_crumb = trim($__env->yieldContent('panelCrumb', ''));
        if ('' !== $panel_crumb) {
            $panel_crumbs[] = $panel_crumb;
        }
    @endphp

    @include('frontend.partials.pageHead', [
        'title' => trim($__env->yieldContent('panelTitle', 'My Account')),
        'subtitle' => 'Hello ' . ($user->name ?: 'there') . ', manage your applications, documents and account here.',
        'crumbs' => $panel_crumbs,
    ])

    <section class="up-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="up-side">
                        @include('frontend.user.menuIndex')
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="fl-inline-msg"></div>
                    @yield('panelBody')
                </div>
            </div>
        </div>
    </section>
@endsection

@section('jsIndex')
    <script src="{{ asset('assets/app/loanService.js') }}?v={{ @filemtime(public_path('assets/app/loanService.js')) ?: 1 }}"></script>
    @yield('panelJs')
@endsection
