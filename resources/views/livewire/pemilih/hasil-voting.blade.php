<div>
    @push('styles')
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    @endpush
    <div class="px-6 py-2 border rounded-lg shadow mb-5 w-fit">
        <div class="flex items-center gap-2">
            <div class="w-3 h-3 bg-red-600 rounded-full animate__animated animate__flash animate__infinite	infinite animate__slow"></div>
            <p class="font-bold">Live Count</p>
        </div>
    </div>
    <div>
        <ul class="grid grid-cols-2 text-sm font-medium text-center text-gray-500 border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <li class="cursor-pointer" wire:click="switch('chartPoll')">
                <p aria-current="page" class="inline-block font-semibold p-4 rounded-t-lg dark:hover:text-gray-300 border w-full @if ($tabs == 'chartPoll') border-b-0 text-blue-600 @else bg-gray-100 hover:text-gray-600 hover:bg-gray-50 @endif">Chart</p>
            </li>
            <li class="cursor-pointer" wire:click="switch('tablePoll')">
                <p class="inline-block font-semibold p-4 rounded-t-lg dark:hover:text-gray-300 border w-full @if ($tabs == 'tablePoll') border-b-0 text-blue-600 @else bg-gray-100 hover:text-gray-600 hover:bg-gray-50 @endif" >Table</p>
            </li>
        </ul>
    </div>

@if ($tabs == 'chartPoll')
<livewire:admin.hasil-voting.chart-poll />
@elseif ($tabs == 'tablePoll')
<livewire:admin.hasil-voting.table-poll />
@endif

</div>
