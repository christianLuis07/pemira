<div>
    <x-card title="Data Diri">
        <x-errors class="mb-4" />
    
        {{-- <div class="grid grid-cols-1 sm:grid-cols-2 gap-6"> --}}
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 w-full">
                <x-input label="Nama Lengkap" placeholder="nama lengkap" wire:model="nama" />

                <x-native-select
                    label="Pilih Prodi"
                    placeholder="pilih Prodi"
                    :options="$dataProdi"
                    option-label="nama_prodi"
                    option-value="id_prodi"
                    wire:model="prodi"
                />
                
                <x-native-select
                    label="Pilih Kelas"
                    placeholder="pilih Kelas"
                    :options="$dataKelas"
                    option-label="nama_kelas"
                    option-value="id_kelas"
                    wire:model="kelas"
                />
                <x-native-select
                    label="Pilih Tahun Ajar"
                    placeholder="pilih tahun ajar"
                    :options="$dataTahunAjar"
                    option-label="tahun"
                    option-value="id_tahun_ajar"
                    wire:model="tahunAjar"
                />
            </div>
{{--     
            <div class="col-span-1 sm:col-span-2">
                <x-inputs.password label="Password" value="" wire:model="password" />
            </div>
    
            <div class="col-span-1 sm:col-span-2">
                <x-inputs.password label="Confirm Password" value="" wire:model="password_confirmation"/>
            </div> --}}
        {{-- </div> --}}
    
        <x-slot name="footer">
            <div class="flex items-center gap-x-3 justify-center sm:justify-end">
                <x-button wire:click="save" label="Simpan" spinner="save" primary />
            </div>
        </x-slot>
    </x-card>
</div>
