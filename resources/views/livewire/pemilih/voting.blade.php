<div>
    <div class="grid grid-cols-1 gap-y-10">
        @forelse ($dataOrganisasi as $item)
        <div class="">
            <div class="flex justify-center mb-8">
                <p class="text-xl font-bold px-20 py-3 text-blue-600 border-2 rounded-xl text-center border-blue-600">Kandidat {{ $item->name }}</p>
            </div>
            <div class="flex flex-row flex-wrap justify-center">
                @forelse ($item->kandidat as $key => $kandidat)
                <div class="p-1 lg:p-3 w-6/12 lg:w-4/12 ">
                    <div class="block max-w-sm p-3 lg:p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                        <div>
                            <p class="text-center font-semibold text-sm lg:text-lg">Paslon {{ $key += 1 }}</p>
                        </div>
                        <div class="py-4">
                            <img class="w-full rounded-md lg:rounded-xl" src="{{ asset('storage/photos/'.$kandidat->foto) }}" alt="">
                        </div>
                        <div>
                            @if (count($item->perolehanSuara->where('user_id', auth()->user()->id)) > 0)
                            <button disabled type="button"  class="text-white w-full bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">
                                Terima Kasih sudah memilih
                            </button>
                            @else
                            <button wire:click="openModal('{{ $kandidat->id }}', '{{ $item->id }}')" type="button"  class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md lg:rounded-lg text-sm px-2 lg:px-5 py-2.5 mr-2 mb-2 ">
                                Vote Sekarang
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="w-4/12 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <p class="text-center">Belum ada pemilihan</p>
                </div>
                @endforelse
            </div>
        </div>
        @empty
        <div>
            <p class="text-center">Belum ada pemilihan</p>
        </div>
        @endforelse
    </div>

    <x-modal.card title="{{ $ketua }} & {{ $wakil }}" wire:model.defer="openModal" align="center">
        {{-- <div class="mb-6">
            <p class="text-center font-bold text-xl">{{ $ketua }} & {{ $wakil }}</p>
        </div> --}}
        <div class="flex gap-4">
            <div class="w-4/12">
                <img class="w-full rounded-md" src="{{ asset('storage/photos/'.$foto) }}" alt="">
            </div>
            <div class="w-8/12 flex flex-col gap-y-3">
                <div>
                    <p class="font-semibold mb-0.5">KETUA</p>
                    <p>{{ $ketua }}</p>
                    <p class="text-xs">{{ $prodiKetua }}</p>
                </div>
                <div>
                    <p class="font-semibold mb-0.5">WAKIL</p>
                    <p>{{ $wakil }} </p>
                    <p class="text-xs">{{ $prodiWakil }}</p>
                </div>
            </div>
        </div>
        <div>
            <div class="mb-0.5">
                <p class="font-semibold ">Periode</p>
                <p>{{ $periode }}</p>
            </div>
            <div class="mb-0.5">
                <p class="font-semibold ">Visi</p>
                {{ $visi }}
            </div>
            <div class="mb-0.5">
                <p class="font-semibold ">Misi</p>
                {{ $misi }}
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex justify-center">
                <x-button primary label="PILIH" class="px-14" wire:click="vote" />
            </div>
        </x-slot>
    </x-modal.card>
</div>