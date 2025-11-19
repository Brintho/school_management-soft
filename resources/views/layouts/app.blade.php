<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="">

    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="referrer" content="no-referrer-when-downgrade">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

    <title>@stack('title') | {{ config('app.name') }}</title>
    {{-- <link rel="icon" href="{{ getImage(settings('favicon')) }}" type="image/x-icon"> --}}

    <link rel="stylesheet" href="{{ asset('assets/global/flaticon/css/all/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/flaticon/css/bold/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/flaticon/css/brands/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/flaticon/css/regular/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/flaticon/css/solid/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/flaticon/css/thin/rounded.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/flaticon/css/thin/straight.css') }}">

    @yield('loadCssFiles')
    @stack('css')
</head>

<body>

    @yield('mainContent')
    @yield('loadJsFiles')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @include('core::initJs')
    @include('core::toastr')
    @include('core::scripts')
    @include('core::modal')
    @stack('js')
</body>

</html>
