<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		    <link rel="shortcut icon" href="{{ url(asset('assets/images/logo-pemira.png')) }}">

        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- Nucleo Icons -->
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Popper -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>

        <link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css') }}" rel="stylesheet" />

        @wireUiScripts
        @vite('resources/sass/app.scss')
        {{-- <link rel="stylesheet" href="{{ url(asset('build/assets/app-1a00ccc2.css')) }}"> --}}
        {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
        {{-- <script src="{{ url(asset('build/assets/app-238bd84c.js')) }}"></script> --}}
        @vite('resources/js/app.js')
        
        @livewireStyles
        @livewireScripts
        @livewireChartsScripts
        @stack('styles')

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body class="">
        <x-notifications />
        <x-dialog />

        @yield('body')
    </body>

    @livewire('livewire-ui-modal')
    <!-- plugin for charts  -->
    {{-- <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}" async></script> --}}
    <!-- plugin for scrollbar  -->
    {{-- <script src="{{ asset('assets/js/perfect-scrollbar.js') }}" async></script> --}}
    <!-- github button -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- main script file  -->
    {{-- <script src="{{ asset('assets/js/sidenav-burger.js') }}"></script> --}}
    {{-- <script asy src="{{ asset('assets/js/soft-ui-dashboard-tailwind.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    @stack('scripts')
</html>
