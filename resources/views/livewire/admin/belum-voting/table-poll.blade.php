<div>
    @if ($tabOrganisasi != null)
        <div
            class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px">
                @foreach ($organisasi as $value)
                    <li class="mr-2" wire:click="select('{{ $value->id }}')">
                        <p
                            class="cursor-pointer font-semibold inline-block p-4 border-b-2 rounded-t-lg @if ($value->id == $tabOrganisasi) border-blue-600 text-blue-600 active @else border-transparent hover:text-gray-600 hover:border-gray-300 @endif">
                            {{ $value->name }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        <p class="text-center mt-6 mb-3 font-bold text-gray-800">Data Mahasiswa Belum Voting {{ $organisasiName }}</p>
        <div class="flex justify-between">
            <div class="flex items-center mb-5 gap-3">
                <x-button icon="download" wire:click="exportExcel" positive label="Export" />
            </div>
        </div>

        <!-- Filter Start-->
        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <x-select label="Filter Kelas" placeholder="Semua Kelas" :options="$kelasList" option-label="nama_kelas"
                        option-value="id_kelas" wire:model="selectedKelas" />
                </div>

                <div>
                    <x-select label="Filter Prodi" placeholder="Semua Prodi" :options="$prodiList" option-label="nama_prodi"
                        option-value="id_prodi" wire:model="selectedProdi" />
                </div>

                <div>
                    <x-select label="Filter Tahun Ajar" placeholder="Semua Tahun" :options="$tahunAjarList" option-label="tahun"
                        option-value="id_tahun_ajar" wire:model="selectedTahunAjar" />
                </div>

                <div>
                    <x-select label="Per Halaman" placeholder="Pilih Jumlah" :options="[
                        ['id' => 10, 'name' => '10'],
                        ['id' => 15, 'name' => '15'],
                        ['id' => 25, 'name' => '25'],
                        ['id' => 50, 'name' => '50'],
                    ]" option-label="name"
                        option-value="id" wire:model="perPage" />
                </div>

                <div class="flex items-end">
                    <button wire:click="resetFilters"
                        class="w-full bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>
        <!-- Filter End-->

        <!-- Tabel Start -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prodi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun
                            Ajar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($mahasiswaBelumVoting as $index => $mahasiswa)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $mahasiswa->nim ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $mahasiswa->detail_pengguna->nama_pemilih }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mahasiswa->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $mahasiswa->detail_pengguna->kelas->nama_kelas ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $mahasiswa->detail_pengguna->prodi->nama_prodi ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $mahasiswa->detail_pengguna->tahun_ajar->tahun ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                Tidak ada mahasiswa yang belum voting untuk organisasi {{ $organisasiName }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Table End -->

        <!-- Informasi Total dan Pagination -->
        <div class="mt-4 flex justify-between items-center">
            <div class="text-sm text-gray-600">
                @if ($mahasiswaBelumVoting->total() > 0)
                    Menampilkan {{ $mahasiswaBelumVoting->firstItem() }} - {{ $mahasiswaBelumVoting->lastItem() }}
                    dari {{ $mahasiswaBelumVoting->total() }} mahasiswa yang belum voting
                @else
                    Tidak ada data yang ditampilkan
                @endif
            </div>

            @if ($mahasiswaBelumVoting->hasPages())
                <div>
                    {{ $mahasiswaBelumVoting->links() }}
                </div>
            @endif
        </div>
        <!-- Informasi Total dan Pagination -->
    @else
        <p class="mt-11 text-center">Tidak ada data pemilihan sekarang!</p>
    @endif
</div>
