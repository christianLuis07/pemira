<div class="flex-none w-full max-w-full px-3">

    <livewire:admin.kelola-kandidat.add-kandidat />

    <div
        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex justify-between">
                <h6 class="w-fit">Tabel Kandidat</h6>
                <div class="w-6/12">
                    <div class="flex gap-3 justify-end">
                        <div class="w-8/12">
                            <x-input wire:model="search" right-icon="search" label=""
                                placeholder="Cari nama ketua atau wakil" class="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto ps">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Organisasi</th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                KETUA</th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                WAKIL</th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Visi</th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Misi</th>
                            <th
                                class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataKandidat as $item)
                            <tr>
                                <td
                                    class="pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $item->organisasi->name }}</p>
                                </td>
                                <td
                                    class="pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $item->ketua }}</p>
                                </td>
                                <td
                                    class="pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $item->wakil }}</p>
                                </td>
                                <td
                                    class="pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span
                                        class="font-semibold leading-tight text-xs text-slate-400 ">{{ Str::limit($item->visi, 30) }}</span>
                                </td>
                                <td
                                    class="pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span
                                        class="font-semibold leading-tight text-xs text-slate-400">{{ Str::limit($item->misi, 30) }}</span>
                                </td>
                                <td
                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex justify-center gap-2">
                                        <x-button icon="pencil" primary label=""
                                            wire:click="editKandidat('{{ $item->id }}')" />
                                        <x-button icon="trash" negative label=""
                                            wire:click="deleteConfirm('{{ $item->id }}')" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-6">
                    {{ $dataKandidat->links() }}
                </div>

                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
                {{-- Form Edit Kandidat --}}
                <div>
                    <x-modal.card title="Edit Kandidat" wire:model.defer="editKandidat" max-width="4xl">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-4 mb-6">
                            <x-select label="Pilih Organisasi" placeholder="pilih orgasisasi" :options="$dataOrganisasi"
                                option-label="name" option-value="id" wire:model.defer="organisasi" />

                            <x-input label="Periode" placeholder="periode jabatan" wire:model="periode" />
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">

                            <div class="grid grid-cols-1 gap-4">
                                <x-input label="Nama Ketua" placeholder="nama ketua" wire:model="namaKetua" />

                                <x-select label="Kelas Ketua" placeholder="pilih kelas ketua" :options="$dataKelas"
                                    option-label="nama_kelas" option-value="id_kelas" wire:model.defer="kelasKetua" />
                                <x-select label="Prodi Ketua" placeholder="pilih prodi ketua" :options="$dataProdi"
                                    option-label="nama_prodi" option-value="id_prodi" wire:model.defer="prodiKetua" />

                            </div>
                            <div class="grid grid-cols-1 gap-4">
                                <x-input label="Nama Wakil" placeholder="nama wakil" wire:model="namaWakil" />

                                <x-select label="Kelas Wakil" placeholder="pilih kelas wakil" :options="$dataKelas"
                                    option-label="nama_kelas" option-value="id_kelas" wire:model.defer="kelasWakil" />
                                <x-select label="Prodi Wakil" placeholder="pilih prodi wakil" :options="$dataProdi"
                                    option-label="nama_prodi" option-value="id_prodi" wire:model.defer="prodiWakil" />

                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-4 mt-6">
                            <x-textarea label="VISI" placeholder="write your visi" wire:model="visi" />
                            <x-textarea label="MISI" placeholder="write your misi" wire:model="misi" />

                            <div>
                                <x-input label="Foto Ketua" type="file" placeholder="your name"
                                    wire:model="fotoKetua" />
                                @if ($fotoKetua)
                                    Photo Preview:
                                    @if (is_string($fotoKetua))
                                        <img class="max-w-xs" src="{{ asset('storage/photos/' . $fotoKetua) }}">
                                    @else
                                        <img class="max-w-xs" src="{{ $fotoKetua->temporaryUrl() }}">
                                    @endif
                                @endif
                            </div>
                            <div>
                                <x-input label="Foto Wakil" type="file" placeholder="your name"
                                    wire:model="fotoWakil" />
                                @if ($fotoWakil)
                                    Photo Preview:
                                    @if (is_string($fotoWakil))
                                        <img class="max-w-xs" src="{{ asset('storage/photos/' . $fotoWakil) }}">
                                    @else
                                        <img class="max-w-xs" src="{{ $fotoWakil->temporaryUrl() }}">
                                    @endif
                                @endif
                            </div>
                            <div>
                                <x-input label="Foto Utama" type="file" placeholder="your name"
                                    wire:model="foto" />
                                @if ($foto)
                                    Photo Preview:
                                    @if (is_string($foto))
                                        <img class="max-w-xs" src="{{ asset('storage/photos/' . $foto) }}">
                                    @else
                                        <img class="max-w-xs" src="{{ $foto->temporaryUrl() }}">
                                    @endif
                                @endif
                            </div>

                        </div>

                        <x-slot name="footer">
                            <div class="flex justify-end gap-x-4">
                                <x-button flat label="Cancel" x-on:click="close" />
                                <x-button primary label="Save" wire:click="saveUpdateKandidat('{{ $kandidatId }}')" />
                            </div>
                        </x-slot>
                    </x-modal.card>

                </div>


            </div>
        </div>
    </div>

</div>
