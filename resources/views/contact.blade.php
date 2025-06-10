@extends('layouts.app')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6">
        <div class="mx-auto mb-8 max-w-screen-sm lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">NARAHUBUNG</h2>
            <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400"> jika terjadi kendala pada login web e-voting dapat menghubungi narahubung yang sudah tertera di bawah</p>
        </div>
        <div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @forelse ($narahubungs as $narahubung)
            <div class="text-center text-gray-500 dark:text-gray-400">
                <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="{{ asset('storage/photos/'.$narahubung->image) }}" alt="Bonnie Avatar">
                <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    <a target="_blank" href="https://api.whatsapp.com/send/?phone={{ $narahubung->phone }}&text=Hai {{ $narahubung->name }}">{{ $narahubung->name }}</a>
                </h3>
                <p>{{ $narahubung->description }}</p>
                <div class="mt-3">
                    <a target="_blank" href="https://api.whatsapp.com/send/?phone={{ $narahubung->phone }}" class="text-white mt-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kirim Pesan</a>
                </div>
            </div>
            @empty
            <p>Tidak Ada Narahubung saat ini</p>
            @endforelse

        </div>
    </div>
  </section>
  <div class="border w-full">

  </div>
@endsection
