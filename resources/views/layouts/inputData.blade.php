@extends('layouts.base')
@section('body')
    <x-navbar />
    <x-sidebar />

    <div class="">
        @yield('content')
    </div>

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection
