<div class="flex-auto px-0 pt-0 pb-2">
    <div class="p-0 overflow-x-auto ps">
        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
            <!-- Bagian Header Tabel -->
            <thead class="align-bottom">
                <tr>
                    <th
                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        No</th>
                    <th
                        class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        Nama Kelas</th>
                    <th
                        class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Looping data kelas untuk ditampilkan di dalam tabel -->
                @forelse ($dataKelas as $item)
                    <tr wire:key="item-{{ $item->id_kelas }}">
                        <td
                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <p class="text-left">{{ $loop->iteration }}</p>
                        </td>
                        <td
                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <p class="mb-0 font-semibold leading-tight text-xs">{{ $item->nama_kelas }}</p>
                        </td>
                        <td
                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex justify-center gap-2">
                                <x-button icon="pencil" primary label="" wire:click="editModal('{{ $item->id_kelas }}')" />
                                <x-button icon="trash" negative label="" wire:click="deleteConfirm('{{ $item->id_kelas }}')" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <!-- Jika tidak ada data kelas, tampilkan pesan 'Data Empty' dalam satu baris -->
                    <tr>
                        <td colspan="3"
                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex items-center justify-center h-full">Data Empty</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-6">
            {{ $dataKelas->links() }}
        </div>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </div>

    <x-modal.card title="Edit Kelas" wire:model.defer="editModal" align="center">
        <div class="grid grid-cols-1 gap-4">
            <x-input label="Kode Kelas" placeholder="kode prodi" wire:model="idKelas" readonly/>
            <x-select
                label="Pilih Prodi"
                placeholder="pilih satu prodi"
                :options="$dataProdi"
                option-label="nama_prodi"
                option-value="id_prodi"
                wire:model.defer="prodi"
            />
            <x-input label="Nama Kelas" placeholder="Nama Kelas" wire:model="namaKelas"/>
        </div>
        
        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="updateKelas('{{ $idKelas }}')" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
</div>