<div class="flex-auto px-0 pt-0 pb-2">
    <div class="p-0 overflow-x-auto ps">
        <!-- Tampilan tabel tahun ajar -->
        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
            <thead class="align-bottom">
                <tr>
                    <!-- Kolom header -->
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tahun Ajar</th>
                    <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataTahunAjar as $item)
                    <!-- Isi data tahun ajar dari variabel $dataTahunAjar -->
                    <tr>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <p class="text-left">{{ $item->id_tahun_ajar }}</p>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <p class="mb-0 font-semibold leading-tight text-xs">{{ $item->tahun }}</p>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex justify-center gap-2">
                                <x-button icon="pencil" primary label="" wire:click="editModal('{{ $item->id_tahun_ajar }}')" />
                                <x-button icon="trash" negative label="" wire:click="deleteConfirm('{{ $item->id_tahun_ajar }}')" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <!-- Jika data tahun ajar kosong -->
                    <tr>
                        <td colspan="3" class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex items-center justify-center h-full">Data Empty</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-6">
            {{ $dataTahunAjar->links() }}
        </div>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </div>

    <x-modal.card title="Edit Tahun Ajar" wire:model.defer="editModal" align="center">
        <div class="grid grid-cols-1 gap-4">
            <x-input label="Kode Tahun Ajar" placeholder="kode tahun ajar" wire:model="idTahunAjar" readonly/>
            <x-input label="Tahun Ajar" placeholder="tahun ajar" wire:model="tahunAjar"/>
        </div>
        
        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="updateTahunAjar('{{ $idTahunAjar }}')" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
</div>