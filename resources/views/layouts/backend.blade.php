@extends('layouts::app')

@section('loadCssFiles')
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/bootstrap-slider.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/fontawesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/nice-select.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/jquery-ui.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/simplebar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/summernote-lite.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/custom.css') }}" rel="stylesheet" />
@endsection


@section('mainContent')
    <main>
        @include('backend::sidebar')
        <div class="sidebar-overlay"></div>

        @include('backend::navbar')

        <div class="main-content">
            <div class="container-fluid p-0">
                @yield('content')
            </div>
        </div>

    </main>
@endsection


@section('loadJsFiles')
    <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/chart.js') }}"></script>
    <script src="{{ asset('assets/backend/js/script.js') }}"></script>


    @stack('js')
@endsection
