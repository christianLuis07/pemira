<div>
    @if ($tabOrganisasi != null)
    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px">
            @foreach ($organisasi as $value)
            <li class="mr-2" wire:click="select('{{ $value->id }}')">
                <p class="cursor-pointer font-semibold inline-block p-4 border-b-2 rounded-t-lg @if ($value->id == $tabOrganisasi) border-blue-600 text-blue-600 active @else border-transparent hover:text-gray-600 hover:border-gray-300 @endif">{{ $value->name }}</p>
            </li>
            @endforeach
        </ul>
    </div>

    <p class="text-center mt-6 mb-3 font-bold text-gray-800">Perolehan Suara {{ $organisasiName }}</p>

    <div wire:poll.5s="counter" class="rounded border-t-0 bg-white flex-1 mt-8" style="height: 32rem;">
        <livewire:livewire-column-chart
                    key="{{ $columnChartModel->reactiveKey() }}"
                    :column-chart-model="$columnChartModel"
                />
    </div>
    @else
    <p class="mt-11 text-center">Tidak ada data pemilihan sekarang!</p>
    @endif
</div>
