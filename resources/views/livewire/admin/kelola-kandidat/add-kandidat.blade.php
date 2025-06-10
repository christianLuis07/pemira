<div>
    <x-button dark icon="plus" label="Tambah Kandidat" wire:click="addKandidat" class="mb-5"/>
    
    <x-modal.card title="Tambah Kandidat" wire:model.defer="addKandidat" max-width="4xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-4 mb-6">
            <x-select
                label="Pilih Organisasi"
                placeholder="pilih orgasisasi"
                :options="$dataOrganisasi"
                option-label="name"
                option-value="id"
                wire:model.defer="organisasi"
            />
    
            <x-input label="Periode" placeholder="periode jabatan" wire:model="periode"/>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">

            <div class="grid grid-cols-1 gap-4">
                <x-input label="Nama Ketua" placeholder="nama ketua" wire:model="namaKetua" />

                <x-select
                    label="Kelas Ketua"
                    placeholder="pilih kelas ketua"
                    :options="$dataKelas"
                    option-label="nama_kelas"
                    option-value="id_kelas"
                    wire:model.defer="kelasKetua"
                />
                <x-select
                    label="Prodi Ketua"
                    placeholder="pilih prodi ketua"
                    :options="$dataProdi"
                    option-label="nama_prodi"
                    option-value="id_prodi"
                    wire:model.defer="prodiKetua"
                />
                
            </div>
            <div class="grid grid-cols-1 gap-4">
                <x-input label="Nama Wakil" placeholder="nama wakil" wire:model="namaWakil"/>

                <x-select
                    label="Kelas Wakil"
                    placeholder="pilih kelas wakil"
                    :options="$dataKelas"
                    option-label="nama_kelas"
                    option-value="id_kelas"
                    wire:model.defer="kelasWakil"
                />
                <x-select
                    label="Prodi Wakil"
                    placeholder="pilih prodi wakil"
                    :options="$dataProdi"
                    option-label="nama_prodi"
                    option-value="id_prodi"
                    wire:model.defer="prodiWakil"
                />

            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-4 mt-6">
            <x-textarea label="VISI" placeholder="write your visi" wire:model="visi"/>
            <x-textarea label="MISI" placeholder="write your misi" wire:model="misi"/>

            <div>
                <x-input label="Foto Ketua" type="file" placeholder="your name" wire:model="fotoKetua" />
                @if ($fotoKetua)
                    Photo Preview:
                    <img class="max-w-xs" src="{{ $fotoKetua->temporaryUrl() }}">
                @endif
            </div>
            <div>
                <x-input label="Foto Wakil" type="file" placeholder="your name" wire:model="fotoWakil" />
                @if ($fotoWakil)
                    Photo Preview:
                    <img class="max-w-xs" src="{{ $fotoWakil->temporaryUrl() }}">
                @endif
            </div>
            <div>
                <x-input label="Foto Utama" type="file" placeholder="your name" wire:model="foto" />
                @if ($foto)
                    Photo Preview:
                    <img class="max-w-xs" src="{{ $foto->temporaryUrl() }}">
                @endif
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />
                <x-button primary label="Save" wire:click="save" />
            </div>
        </x-slot>
    </x-modal.card>
    
</div>
