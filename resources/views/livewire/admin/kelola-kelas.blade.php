<div>
    <div class="flex flex-wrap -mx-3">

        <div class="w-full max-w-full px-3 mt-6 md:w-7/12 md:flex-none">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Tabel Kelas</h6>
                </div>
                <livewire:admin.kelola-kelas.table />
            </div>
        </div>

        <!-- Bagian Form Tambah Kelas -->
        <div class="w-full max-w-full px-3 mt-6 md:w-5/12 md:flex-none">
            <!-- Menampilkan pesan 'success' jika ada -->
            @if (session('success'))
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
                            <h6 class="mb-0">Create Kelas</h6>
                        </div>
                    </div>
                </div>
                <div class="flex-auto p-4 pt-4">
                    <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                        <form wire:submit.prevent="simpan">
                            <div class="mb-3">
                                <x-select
                                    label="Pilih Prodi"
                                    placeholder="pilih satu prodi"
                                    :options="$dataProdi"
                                    option-label="nama_prodi"
                                    option-value="id_prodi"
                                    wire:model.defer="prodi"
                                />
                            </div>
                            <div class="mb-5">
                                <x-input wire:model.defer="nama" label="Nama Kelas" placeholder="nama kelas" />
                            </div>

                            <!-- Tombol submit untuk mengirimkan form -->
                            <x-button icon="plus" dark label="Tambahkan" type="submit" class="w-full"/>
                        </form>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
