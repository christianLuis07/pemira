<div class="w-full max-w-full px-3 mt-6 md:w-7/12 md:flex-none">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex justify-between">
                <h6 class="w-fit">Tabel Prodi</h6>
                <div class="w-max">
                    <div class="flex gap-3">
                        <div class="w-max">
                            <x-input wire:model="search" right-icon="search" label="" placeholder="Cari"
                                class="" />
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
        
                            <!-- Kolom Nama Prodi -->
                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Prodi</th>
        
                            <!-- Kolom Tanggal Dibuat -->
                            <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Created At</th>
        
                            <!-- Kolom Tanggal Diperbarui -->
                            <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Updated At</th>
        
                            <!-- Kolom Aksi -->
                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Program Studi -->
                        @forelse ($dataProdi as $item)
                            <tr>
                                <!-- Kolom Nomor -->
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="text-center">{{ $item->id_prodi }}</p>
                                </td>
        
                                <!-- Kolom Nama Prodi -->
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $item->nama_prodi }}</p>
                                </td>
        
                                <!-- Kolom Tanggal Dibuat -->
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('l, d-m-Y') }}
                                    </span>
                                </td>
        
                                <!-- Kolom Tanggal Diperbarui -->
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">
                                        {{ \Carbon\Carbon::parse($item->updated_at)->format('l, d-m-Y') }}
                                    </span>
                                </td>
        
                                <!-- Kolom Aksi -->
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex justify-center gap-2">
                                        <x-button icon="pencil" primary label="" wire:click="editModal('{{ $item->id_prodi }}')" />
                                        <x-button icon="trash" negative label="" wire:click="deleteConfirm('{{ $item->id_prodi }}')" />
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
                    {{ $dataProdi->links() }}
                </div>
        
                <!-- Custom Scrollbar -->
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div>
        
            <x-modal.card title="Edit Prodi" wire:model.defer="editModal" align="center">
                <div class="grid grid-cols-1 gap-4">
                    <x-input label="Kode Prodi" placeholder="kode prodi" wire:model="idProdi" readonly/>
                    <x-input label="Nama Prodi" placeholder="Nama prodi" wire:model="namaProdi"/>
                </div>
                
                <x-slot name="footer">
                    <div class="flex justify-end">
                        <div class="flex">
                            <x-button flat label="Cancel" x-on:click="close" />
                            <x-button primary label="Save" wire:click="updateProdi('{{ $idProdi }}')" />
                        </div>
                    </div>
                </x-slot>
            </x-modal.card>
        </div>
    </div>
</div>
