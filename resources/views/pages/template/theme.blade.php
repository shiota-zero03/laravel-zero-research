@php
    $set = \App\Models\Setting::get()->first();
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $set->app_name }} - @yield('title')</title>
        @include('pages.template.head')
    </head>
    <body>
        <div class="container-scroller">

            @include('pages.template.sidebar')

            <div class="container-fluid page-body-wrapper">

                @include('pages.template.topbar')

                <div class="main-panel">
                    <div class="content-wrapper">

                        @yield('content')

                    </div>

                    @include('pages.template.footer')

                </div>
            </div>
        </div>

        @include('pages.template.script')

        @yield('script')
    </body>
</html>
