@extends('layouts.dashboard')

@section('content')
    <div class="flex flex-wrap -mx-3">

        <div class="w-full max-w-full px-3 mt-6 md:w-7/12 md:flex-none">
            <!-- Tabel Tahun Ajar -->
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Tabel Tahun Ajar</h6>
                </div>
                <livewire:admin.kelola-tahun-ajar.table />
            </div>
        </div>

        <div class="w-full max-w-full px-3 mt-6 md:w-5/12 md:flex-none">
            <!-- Bagian untuk menampilkan pesan success jika berhasil menambahkan tahun ajar -->
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-white bg-gradient-to-br from-green-400 to-green-700 rounded-lg" role="alert">
                    {{-- Menampilkan pesan success yang diterima dari session --}}
                    <span class="font-medium">Success alert!</span> {{ session('success') }}
                </div>
            @endif
            <!-- Form untuk menambahkan tahun ajar baru -->
            <div class="relative flex flex-col h-full min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <div class="flex flex-wrap -mx-3">
                        <div class="max-w-full px-3 md:w-1/2 md:flex-none">
                            <h6 class="mb-0">Create Tahun Ajar</h6>
                        </div>
                    </div>
                </div>
                <div class="flex-auto p-4 pt-4">
                    <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                        <form action="{{ route('admin.kelola-tahun.store') }}" method="POST">
                            @csrf
                            <li class="justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                                <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kode Prodi</label>
                                <input name="id_tahun_ajar" type="text" readonly id="base-input" value="{{ $newKodeTahunAjar }}" class="bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white">

                                @error('id_tahun_ajar')
                                    <span class="text-red-600 text-xs">{{ $message }}</span>
                                @enderror
                            </li>

                            <li class="justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                                <div class="mb-6">
                                    <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tahun Ajar</label>
                                    <input type="text" name="tahun" id="base-input" class="bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white">

                                    @error('tahun')
                                        <span class="text-red-600 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                            </li>
                            <!-- Tombol submit untuk menyimpan data tahun ajar baru -->
                            <x-button icon="plus" dark label="Tambahkan" type="submit" class="w-full"/>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
