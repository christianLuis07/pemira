<div>
    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
        <a href="#"
            class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-blue-400 mb-2">
            <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 14">
                <path
                    d="M11 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm8.585 1.189a.994.994 0 0 0-.9-.138l-2.965.983a1 1 0 0 0-.685.949v8a1 1 0 0 0 .675.946l2.965 1.02a1.013 1.013 0 0 0 1.032-.242A1 1 0 0 0 20 12V2a1 1 0 0 0-.415-.811Z" />
            </svg>
            Tutorial
        </a>
        <h1 class="text-gray-900 dark:text-white text-xl md:text-2xl font-extrabold mb-2">Cara menggunakan website pemira
        </h1>
        <p class="text-md font-normal text-gray-500 dark:text-gray-400 mb-6">Selamat datang di platform voting
            Pemira kami! Berikut adalah panduan langkah demi langkah tentang cara menggunakan website
            kami untuk berpartisipasi dalam pemilihan raya</p>
        <x-button wire:click="openModalTutorial"
            class="inline-flex justify-center items-center py-2.5 px-5 text-base font-medium text-center text-white rounded-lg bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
            Show
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10 5v14l11-7z" />
            </svg>
        </x-button>

        <x-modal.card title="Tutorial Pemira" blur wire:model.defer="tutorialModal">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div
                    class="col-span-1 sm:col-span-2 cursor-pointer bg-gray-100 rounded-xl shadow-md h-72 flex items-center justify-center">
                    <div class="flex flex-col items-center justify-center">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/k0aQJO89i_I"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </x-modal.card>
    </div>
</div>
