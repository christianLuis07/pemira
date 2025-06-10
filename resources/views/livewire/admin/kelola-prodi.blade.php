    <!-- Bagian Tabel Data Program Studi -->
    <div class="flex flex-wrap -mx-3">
        
        <livewire:admin.kelola-prodi.table />

        <!-- Bagian Form Tambah Program Studi -->
        <div class="w-full max-w-full px-3 mt-6 md:w-5/12 md:flex-none">
            @if (session('success'))
                <!-- Pesan Alert Jika Berhasil Menambahkan Program Studi -->
                <div class="p-4 mb-4 text-sm text-white bg-gradient-to-br from-green-400 to-green-700 rounded-lg"
                    role="alert">
                    <span class="font-medium">Success alert!</span> {{ session('success') }}
                </div>
            @endif

            <div
                class="relative flex flex-col h-full min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <div class="flex flex-wrap -mx-3">
                        <div class="max-w-full px-3 md:w-1/2 md:flex-none">
                            <h6 class="mb-0">Create Prodi</h6>
                        </div>
                    </div>
                </div>
                <div class="flex-auto p-4 pt-4">
                    <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                        <!-- Form untuk Menambahkan Program Studi Baru -->
                        <form action="{{ route('admin.kelola-prodi.store') }}" method="POST">
                            @csrf
                            <li
                                class="justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                                <label for="base-input"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kode
                                    Prodi</label>
                                <input name="id_prodi" type="text" readonly id="base-input"
                                    value="{{ $newKodeProdi }}"
                                    class="bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white">

                                <!-- Menampilkan Pesan Error jika Validasi Gagal untuk Kolom 'id_prodi' -->
                                @if ($errors->has('id_prodi'))
                                    <p class="text-red-500 text-xs italic">{{ $errors->first('id_prodi') }}</p>
                                @endif
                            </li>

                            <li
                                class="justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                                <div class="mb-6">
                                    <label for="base-input"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama
                                        Prodi</label>
                                    <input type="text" name="nama_prodi" id="base-input"
                                        class="bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white">

                                    <!-- Menampilkan Pesan Error jika Validasi Gagal untuk Kolom 'nama_prodi' -->
                                    @if ($errors->has('nama_prodi'))
                                        <p class="text-red-500 text-xs italic">{{ $errors->first('nama_prodi') }}</p>
                                    @endif
                                </div>
                            </li>

                            <!-- Tombol Submit untuk Menambahkan Program Studi -->
                            <x-button icon="plus" dark label="Tambahkan" type="submit" class="w-full"/>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
