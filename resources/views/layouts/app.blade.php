@extends('layouts.base')

@section('body')

<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-6">
    <a href="https://flowbite.com/" class="flex items-center">
        <img src="{{ asset('assets/images/logo-pnc.png') }}" class="h-10 mr-3" alt="Flowbite Logo" />
        <img src="{{ asset('assets/images/logo-pemira.png') }}" class="h-10 mr-3" alt="Flowbite Logo" />
        <span class="self-center text-1xl font-semibold whitespace-nowrap dark:text-white">PEMIRA PNC</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium text-sm flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="{{ route('home') }}" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent @if (request()->routeIs('beranda')) text-blue-600 @endif" >Beranda</a>
        </li>
        <li>
          <a href="{{ route('organisasi') }}" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent @if (request()->routeIs('organisasi')) text-blue-600 @endif" >Organisasi</a>
        </li>
        <li>
          <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent @if (request()->routeIs('pemira')) text-blue-600 @endif" >Pemira</a>
        </li>
        <li>
          <a href="{{ route('contact') }}" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent @if (request()->routeIs('contact')) text-blue-600 @endif" >Contact Us</a>
        </li>
        <li>
          <a href="{{ auth()->user() ? (auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('pemilih.dashboard')) : route('login') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-3 md:mt-0 ">{{ auth()->user() ? 'Dashboard' : 'Masuk' }}</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


    @yield('content')

    <x-floating-whatsapp />

    <footer class="bg-blue dark:bg-gray-900 ">
      <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-10">
        <div class="md:flex md:justify-between">
          <div class="flex w-full flex-col lg:flex-row">
              <div class="w-full lg:w-8/12">
                  <h2 class="mb-4 text-xl font-bold text-blue-800 uppercase dark:text-white ">
                    Pemilihan Raya Politeknik Negeri Cilacap
                  </h2>
                  <p class="text-gray-800 text-1xl justify-center">
                    Pemilihan Raya Politeknik Negeri Cilacap merupakan pemilihan yang dilakukan oleh mahasiswa Politeknik Negeri 
                    Cilacap untuk memilih calon ketua dan wakil ketua BPM dan BEM Politeknik Negeri Cilacap.
                  </p>
                    <p class="mt-4">&copy; {{ date('Y') }} Protic. All rights reserved.</p>
              </div>

              {{-- <div class="w-full lg:w-2/12">
                <ul class="font-bold">
                    <li class="mb-2">
                        <a href="{{ route('home') }}"
                            class="block font-medium py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Beranda</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('organisasi') }}"
                            class="block font-medium py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Organisasi</a>
                    </li>
                    <li class="mb-2">
                        <a href="#"
                            class="block font-medium py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent ">Pemira</a>
                    </li>
                    <li class="mb-2">
                        <a href="#"
                            class="block font-medium py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent ">Contact
                            Us</a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </nav>
@endsection
