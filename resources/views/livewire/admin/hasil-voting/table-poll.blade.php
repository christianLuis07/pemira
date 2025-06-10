<div wire:poll.5s="counter" class="w-full max-w-full px-3 mt-6  md:flex-none">
    @forelse ($dataOrganisasi as $item)
        <div
            class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex justify-between">
                    <h6 class="w-fit">Tabel Hasil Voting {{ $item->name }}</h6>
                </div>
            </div>
            <!-- Isi Tabel -->
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto ps">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Ketua & Wakil
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Foto Kandidat
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Visi & Misi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jumlah Suara
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->kandidat as $sortByOrganisasi)
                                <tr
                                    class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                    <td class="px-6 py-4">
                                        {{ $sortByOrganisasi->ketua }} & {{ $sortByOrganisasi->wakil }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <img class="w-60 rounded-xl"
                                            src="{{ asset('storage/photos/' . $sortByOrganisasi->foto) }}" alt="">
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $sortByOrganisasi->visi }} <br /> {{ $sortByOrganisasi->misi }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $sortByOrganisasi->perolehan_suara_count }} /
                                        {{ $item->perolehanSuaraTotal }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Custom Scrollbar -->
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="flex justify-center items-center">
            <div class="max-w-xs">
                <!-- Empty State -->
                <img src="{{ asset('assets/img/illustrations/empty-state.svg') }}" alt=""
                    class="block rounded-md m-auto">
                <p class="text-center p-5">Tidak ada data pemilihan sekarang!</p>
            </div>
        </div>
    @endforelse
</div>
