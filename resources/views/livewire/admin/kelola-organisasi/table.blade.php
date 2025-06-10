<div class="w-full max-w-full px-3 mt-6 md:w-7/12 md:flex-none">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex justify-between">
                <h6 class="w-fit">Tabel Organisasi</h6>
                <div class="w-max">
                    <div class="flex gap-3">
                        <div class="w-max">
                            <x-input wire:model="search" right-icon="search" label="" placeholder="Cari" class="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Isi Tabel -->
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto ps">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <!-- Kolom Nomor -->
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>

                            <!-- Kolom Nama Organisasi -->
                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Organisasi</th>

                            <!-- Kolom Tanggal Dibuat -->
                            <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Mulai</th>

                            <!-- Kolom Tanggal Diperbarui -->
                            <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Selesai</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Active</th>

                            <!-- Kolom Aksi -->
                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Program Studi -->
                        @forelse ($dataOrganisasi as $key => $item)
                            <tr>
                                <!-- Kolom Nomor -->
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="text-center">{{ $key + 1 }}</p>
                                </td>

                                <!-- Kolom Nama Organisasi -->
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $item->name }}</p>
                                </td>

                                <!-- Kolom Tanggal Dibuat -->
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">
                                        {{ \Carbon\Carbon::parse($item->start)->format('d-m-Y H:i') }}
                                    </span>
                                </td>

                                <!-- Kolom Tanggal Diperbarui -->
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">
                                        {{ \Carbon\Carbon::parse($item->end)->format('d-m-Y H:i') }}
                                    </span>
                                </td>

                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex justify-center">
                                        @if ($item->active == true && $item->end > now())
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>
                                        @endif
                                    </div>
                                </td>

                                <!-- Kolom Aksi -->
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex justify-center gap-2">
                                        <x-button icon="pencil" primary label="" wire:click="editModal('{{ $item->id }}')" />
                                        <x-button icon="trash" negative label="" wire:click="deleteConfirm('{{ $item->id }}')" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- Tampilan jika Data Kosong -->
                            <tr>
                                <td colspan="5" class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center h-full">Data Empty</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-6">
                    {{ $dataOrganisasi->links() }}
                </div>

                <!-- Custom Scrollbar -->
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div>

            <x-modal.card title="Edit Organisasi" wire:model.defer="editModal" align="center">
                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-3">
                        <x-input label="Nama Organisasi" placeholder="Nama Organisasi" wire:model="namaOrganisasi"/>
                    </div>
                    <div class="mb-3">
                        <x-datetime-picker label="Waktu Mulai Pemilihan" placeholder="Waktu Mulai"
                            interval="30" wire:model.defer="timeStart" />
                    </div>
                    <div class="mb-3">
                        <x-datetime-picker label="Waktu Selesai Pemilihan" placeholder="Waktu Selesai"
                            interval="30" wire:model.defer="timeEnd" />
                    </div>

                    <x-toggle label="Active" wire:model="active" />
                </div>

                <x-slot name="footer">
                    <div class="flex justify-end">
                        <div class="flex">
                            <x-button flat label="Cancel" x-on:click="close" />
                            <x-button primary label="Save" wire:click="updateOrganisasi('{{ $organisasiId }}')" />
                        </div>
                    </div>
                </x-slot>
            </x-modal.card>
        </div>
    </div>
</div>
