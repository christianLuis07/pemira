<div class="flex-none w-full max-w-full px-3">
    {{-- Menampilkan success alert jika ada pesan 'success' dalam session --}}
    <div class="flex justify-between">
        <div class="flex items-center mb-5 gap-3">
            <x-button dark icon="plus" label="Buat User" wire:click="addUserModal" />
            <x-button icon="upload" wire:click="importExel" positive label="Import" />
            <x-button icon="download" wire:click="exportExcel" positive label="Export" />
        </div>
        <div class="flex items-center mb-5 gap-3">
            <x-button icon="trash" wire:click="deleteAllUserConfirm" negative label="Hapus Semua User" />
        </div>
    </div>


    <div
        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex justify-between">
                <h6 class="w-fit">Tabel User</h6>
                <div class="w-6/12">
                    <div class="flex gap-3">
                        <div class="w-8/12">
                            <x-input wire:model="search" right-icon="search" label="" placeholder="Cari"
                                class="" />
                        </div>
                        <div class="w-4/12">
                            <x-select label="" placeholder="Pilih Role" :options="$roles" wire:model="role" />
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
                                NIM & Nama Pemilih</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Email</th>
                            <th
                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Prodi</th>
                            <th
                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Tahun Ajar</th>
                            <th
                                class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUser as $item)
                            <tr>
                                <td
                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $item->nim }}</h6>
                                            <p class="mb-0 leading-tight text-xs text-slate-600">
                                                {{ $item->detail_pengguna->nama_pemilih ?? 'Nama belum diinputkan' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $item->email }}</p>
                                </td>
                                <td
                                    class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                    <span
                                        class="font-semibold leading-tight text-xs text-slate-400">{{ $item->detail_pengguna->prodi->nama_prodi ?? 'User belum menambahkan prodi' }}</span>
                                </td>
                                <td
                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span
                                        class="font-semibold leading-tight text-xs text-slate-400">{{ $item->detail_pengguna->tahun_ajar->tahun ?? 'User belum menambah tahun ajar' }}</span>
                                </td>
                                <td
                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    {{-- <a href="javascript:;" wire:click="editUserModal('{{ $item->id }}')" class="font-semibold leading-tight text-xs text-slate-400">
                                        Edit
                                    </a> --}}
                                    <x-button icon="pencil" primary label=""
                                        wire:click="editUserModal('{{ $item->id }}')" />
                                    <x-button icon="mail" emerald label=""
                                        wire:click="sendEmail('{{ $item->id }}')" />
                                    <x-button icon="trash" negative label=""
                                        wire:click="deleteConfirm('{{ $item->id }}')" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-6">
                    {{ $dataUser->links() }}
                </div>

                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div>
        </div>
    </div>

    <x-modal.card title="Tambah User" wire:model.defer="addUserModal" align="center">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input label="nim" placeholder="nim/NIM" wire:model="nim" />
            <x-input label="Email" placeholder="Email" wire:model="email" />

            {{-- <div class="col-span-1 sm:col-span-2">
                <x-inputs.password label="Password" placeholder="password" wire:model="password" />
            </div> --}}
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="saveAddUser" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>


    <x-modal.card title="Edit User" wire:model.defer="editUserModal" align="center">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input label="Nama" placeholder="Nama Pemilih" wire:model="name" />

            <x-input label="nim" placeholder="nim/NIM" wire:model="editnim" />
            <x-input label="Email" placeholder="Email" wire:model="editEmail" />

            <x-inputs.password label="Password" placeholder="password" wire:model="editPassword" />

            <x-select label="Pilih Prodi" placeholder="Pilih Prodi" :options="$dataProdi" option-label="nama_prodi"
                option-value="id_prodi" wire:model="idProdi" />
            <x-select label="Pilih Kelas" placeholder="Pilih Kelas" :options="$dataKelas" option-label="nama_kelas"
                option-value="id_kelas" wire:model="idKelas" />

            <x-select label="Pilih Tahun Ajar" placeholder="Pilih Tahun Ajar" :options="$dataTahunAjar" option-label="tahun"
                option-value="id_tahun_ajar" wire:model="idTahunAjar" />

            <div class="col-span-1 sm:col-span-2">
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="saveUpdateUser('{{ $userId }}')" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>

    <x-modal.card title="Delete User" blur wire:model.defer="deleteUserModal" align="center">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input label="nim" placeholder="nim/NIM" wire:model="editnim" />
            <x-input label="Email" placeholder="Email" wire:model="editEmail" />
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button negative label="Delete" wire:click="deleteUser('{{ $userId }}')" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>

    <x-modal.card title="Import User" wire:model.defer="importExel" align="center">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div class="col-span-1 sm:col-span-2">
                <x-input type="file" label="Pilih File Exel" placeholder="" wire:model="fileExelUpload" hint="upload file extension .xlsx"/>
            </div>

        </div>
        <div wire:loading wire:target="uploadExel">
            <div class="flex gap-2 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin w-6 h-6" data-name="Layer 1" viewBox="0 0 24 24" id="spinner-alt"><path d="M6.804 15a1 1 0 0 0-1.366-.366l-1.732 1a1 1 0 0 0 1 1.732l1.732-1A1 1 0 0 0 6.804 15ZM3.706 8.366l1.732 1a1 1 0 1 0 1-1.732l-1.732-1a1 1 0 0 0-1 1.732ZM6 12a1 1 0 0 0-1-1H3a1 1 0 0 0 0 2h2a1 1 0 0 0 1-1Zm11.196-3a1 1 0 0 0 1.366.366l1.732-1a1 1 0 1 0-1-1.732l-1.732 1A1 1 0 0 0 17.196 9ZM15 6.804a1 1 0 0 0 1.366-.366l1-1.732a1 1 0 1 0-1.732-1l-1 1.732A1 1 0 0 0 15 6.804Zm5.294 8.83-1.732-1a1 1 0 1 0-1 1.732l1.732 1a1 1 0 0 0 1-1.732Zm-3.928 1.928a1 1 0 1 0-1.732 1l1 1.732a1 1 0 1 0 1.732-1ZM21 11h-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2Zm-9 7a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2a1 1 0 0 0-1-1Zm-3-.804a1 1 0 0 0-1.366.366l-1 1.732a1 1 0 0 0 1.732 1l1-1.732A1 1 0 0 0 9 17.196ZM12 2a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0V3a1 1 0 0 0-1-1Z"></path></svg>
                <p>Tunggu dulu lagi di upload, jangan di close gaess...</p>
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Import" wire:click="uploadExel" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>

</div>
