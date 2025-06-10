@extends('layouts.base')

@section('body')
    <div class="m-0 font-sans antialiased font-normal text-base leading-default text-slate-500">
        <x-sidebar/>

      <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 min-h-screen">
        <x-navbar/>

        <div class="mx-4 lg:mx-10 mt-4">
          @yield('content')
        </div>
      </main>

      @isset($slot)
          {{ $slot }}
      @endisset
    </div>
@endsection
