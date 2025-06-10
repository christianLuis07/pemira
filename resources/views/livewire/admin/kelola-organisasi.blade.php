<div class="flex -mx-3">

    <livewire:admin.kelola-organisasi.table />

    <!-- Bagian Form Tambah Program Studi -->
    <div class="w-full max-w-full px-3 mt-6 md:w-5/12 md:flex-none">

        <div
            class="relative flex flex-col h-full min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                <div class="flex flex-wrap -mx-3">
                    <div class="max-w-full px-3 md:w-1/2 md:flex-none">
                        <h6 class="mb-0">Tambah Organisasi</h6>
                    </div>
                </div>
            </div>
            <div class="flex-auto p-4 pt-4">
                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                    <!-- Form untuk Menambahkan Program Studi Baru -->
                    <form wire:submit.prevent="saveOrganisasi">
                        <li
                            class="justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                            <div class="mb-6">
                                <x-input label="Nama Organisasi" placeholder="Nama organisasi"
                                    wire:model="namaOrganisasi" />
                            </div>
                            <div class="mb-6">
                                <x-datetime-picker label="Waktu Mulai Pemilihan" placeholder="Waktu Mulai" interval="30"
                                    wire:model.defer="timeStart" />
                            </div>
                            <div class="mb-6">
                                <x-datetime-picker label="Waktu Selesai Pemilihan" placeholder="Waktu Selesai"
                                    interval="30" wire:model.defer="timeEnd" />
                            </div>
                        </li>
                        <!-- Tombol Submit untuk Menambahkan Program Studi -->
                        <x-button icon="plus" dark label="Tambahkan" type="submit" class="w-full" />
                    </form>
                </ul>
            </div>
        </div>
    </div>
</div>