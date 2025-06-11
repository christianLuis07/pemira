@extends('layouts.app')

@section('content')

@push('styles')
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
/>
@endpush

<div class="">
    <div class="relative">
        <div class="bg-[url('../../public/assets/images/bg-home.png')] bg-cover bg-opacity-20 flex justify-center bg-center">
            <div class="pt-28 pb-32 md:pt-40 md:pb-72 max-w-xl">
                <h2 class="text-4xl font-bold mb-2 text-blue-800 text-center">
                    Our Best Leader From Our Choice
                </h2>
                <h4 class="text-1xl mb-10 text-blue-800 text-center">
                    Setiap suara adalah langkah kecil menuju perubahan besar. Jangan biarkan kesempatan ini terlewat. Pilihlah, berpartisipasilah, dan wujudkan perubahan bersama!
                </h4>
                <div class="flex justify-center mb-10">
                    <a href="{{ auth()->user() ? (auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('pemilih.dashboard')) : route('login') }}"
                        class="text-white flex items-center bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ auth()->user() ? 'Dashboard' : 'Masuk' }}
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" class="fill-white w-6 h-6 ml-2"
                            viewBox="0 0 24 24" id="arrow-right">
                            <path
                                d="M17.92,11.62a1,1,0,0,0-.21-.33l-5-5a1,1,0,0,0-1.42,1.42L14.59,11H7a1,1,0,0,0,0,2h7.59l-3.3,3.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l5-5a1,1,0,0,0,.21-.33A1,1,0,0,0,17.92,11.62Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

        </div>


        <div class="absolute bottom-0 w-full h-auto hidden md:block">
            <svg class="fill-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill-opacity="1"
                    d="M0,320L120,288C240,256,480,192,720,192C960,192,1200,256,1320,288L1440,320L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                </path>
            </svg>
        </div>

        {{-- <div class=" flex justify-center">
            <div class="absolute z-20 bottom-0">
                <img src="./assets/images/events-bg-img-pnc-ok.png" class="w-60" alt="" srcset="">
            </div>
        </div> --}}

    </div>

    <div class="bg-blue-500 px-2 pt-4">
        <div class=" flex justify-center">
            <div class="h-auto px-8  py-4 border-yellow-200 border-2 rounded-xl w-full lg:w-fit">
                <div class="flex gap-x-8">
                    <img src="{{ asset('assets/images/logo-pnc.png') }}" class="h-20" alt="" srcset="">
                    <img src="{{ asset('assets/images/logo-pemira.png') }}" class="h-20" alt="" srcset="">
                </div>
                {{-- <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                      </div>
                      <div class="swiper-slide">
                      </div>
                    </div>
                  </div> --}}
                </div>
        </div>
        <p class="mt-5 text-center font-semibold text-lg text-white">~ By Protic ~</p>
    </div>
        
        <div class="bg-blue-500 pt-16 lg:py-16">
            <div class="mx-auto w-full max-w-screen-xl px-4">
            <div class="mx-0 md:mx-20">
                <img src="{{ asset('assets/images/paslon.png') }}" class="w-full" alt="" srcset="">
            </div>
            <div class="grid grid-rows-1 gap-y-4 my-12 justify-center">
                <div class="max-w-3xl">
                    {{-- <div> --}}
                        <p class="text-white font-bold text-2xl mb-4 text-center">
                            Our Best Leader From Our Choice
                        </p>
                        <p class="text-white text-center ">
                            Setiap suara adalah langkah kecil menuju perubahan besar. Jangan biarkan kesempatan ini terlewat. Pilihlah, berpartisipasilah, dan wujudkan perubahan bersama!                        </p>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="relative overflow-hidden">
        <img src="./assets/images/bg-2.png" class="w-full h-full absolute -z-10 top-0 " alt="" srcset="">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 ">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 py-20">
                <div class=" flex justify-center">
                    <div class="border p-6 rounded-lg bg-gray-300 text-blue-800 w-fit">
                        <img src="{{ asset('assets/images/uu-pemira.png') }}" alt="">    
                    </div>
                </div>

                <div class="flex justify-start items-center">
                    <div class="max-w-sm">
                        <p class="font-bold text-2xl text-blue-800 mb-4">Tahukah kamu?</p>
                        <p class="text-blue-800">
                            PEMIRA ini sudah diatur di dalam Undang-Undang PEMIRA, Ayoo!! scan barcode tersebut untuk lebih mengetahui tentang Peraturan Pelaksanaan PEMIRA PNC 2025
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="relative overflow-hidden">
        <img src="./assets/images/bg-pemira.png" class="w-full h-full absolute -z-10 top-0 " alt="" srcset="">
        <div class="flex flex-col lg:flex-row">
            <div class="w-full lg:w-4/12 bg-blue-500 p-20">
                <div class=" flex items-center justify-center h-full">
                    <div class="flex justify-center flex-col">
                        <img src="./assets/images/logo-pemira.png" class="w-44" alt="">
                        <a href="{{ auth()->user() ? (auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('pemilih.dashboard')) : route('login') }}"
                            class="center-button text-center bg-blue font-semibold text-white border-2 p-5 rounded-xl py-2 px-10 shadow-lg uppercase tracking-wider mt-20">
                            {{ auth()->user() ? 'Dashboard' : 'Masuk' }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-8/12 px-4 lg:pl-20 py-10 lg:py-20">
                <div class="">
                    <p class="font-bold text-3xl text-blue-800 mb-4">PEMIRA</p>
                    <p class="text-blue-800 text-1xl mb-1 font-bold">Apa sih Pemira itu?</p>
                    <p class="text-blue-800 text-1xl mb-10">
                        Pemira adalah sebuah mekanisme yang dijalankan satu kali dalam satu periode 
                        kepengurusan dalam rangka memilih Ketua dan Wakil Ketua BPM dan BEM yang diatur dalam UU PEMIRA yang 
                        diketahui dan dilaksanakan oleh seluruh ORMAWA PNC.
                    </p>

                    <p class="text-blue-800 text-1xl mb-1 font-bold">Kapan sih Pemira itu dilaksanakan?</p>
                    <p class="text-blue-800 text-1xl mb-10">
                        Pemira ini dilaksanakan setiap setahun sekali lhoo <br>
                        Tentunya Pemira Politeknik Negeri Cilacap ini hampir sama dengan pesta demokrasi pada umumnya. <br>
                        Akan banyak tuntutan yang telah dikemas dalam kontrak politik berdasarkan atas aspirasi 
                        mahasiswa di Politeknik Negeri Cilacap kita ini
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="bg-blue-500">
        <div class="flex flex-col lg:flex-row">
            <div class="w-full lg:w-4/12 bg-white p-4 lg:p-20">
                <div class="flex items-center justify-center h-full">
                    <div class="flex justify-center flex-col">
                        <h2 class="text-3xl font-bold text-blue-800 text-center mb-6">Kandidat BEM</h2>
                        <img src="./assets/images/paslon-1.png" class="w-80" alt="">

                    </div>
                </div>
            </div>

            <div class="w-full lg:w-8/12 px-4 lg:pl-20 py-10 lg:py-20">
                <div class="">
                    <p class="font-bold text-3xl text-yellow-200 mb-2">Paslon 1</p>
                    <p class="font-semibold text-2xl text-white mb-8">Aulia Al Ghifari & Gilang Saputra</p>
                    <p class="text-1xl text-white">Visi</p>
                    <p class="text-blue-800 text-1xl mb-2">
                        <ol class="list-decimal ml-5">
                            <li class="text-1xl text-white">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                Tempora officia accusantium quos et, repellat deleniti.</li>
                            <li class="text-1xl text-white">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, cum?</li>
                            <li class="text-1xl text-white">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Harum at est molestias. Doloribus?</li>
                        </ol>
                    </p>
                    <p class="text-1xl text-white mt-8">Misi</p>
                    <p class="text-blue-800 text-1xl mb-2">
                        <ol class="list-decimal ml-5">
                            <li class="text-1xl text-white">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                Tempora officia accusantium quos et, repellat deleniti.</li>
                            <li class="text-1xl text-white">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, cum?</li>
                            <li class="text-1xl text-white">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Harum at est molestias. Doloribus?</li>
                        </ol>
                    </p>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="bg-blue-500 ">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 pt-14">
                <div class="flex items-center">
                    <div>
                        <p class="text-yellow-200 font-bold text-3xl mb-2">CONTACT US</p>
                        <p class="text-white font-bold text-2xl mb-4">PEMIRA PNC</p>
                        <p class="text-white text-1xl mb-2">
                            Butuh bantuan? silahkan hubungi kami melalui kontak yang sudah tertera di bawah ini
                        </p>
                        <div class="w-full flex justify-center lg:justify-start">
                            <a href="{{ route('contact') }}"
                                class="center-button bg-blue font-semibold border-yellow-200 text-white border-2 p-5 rounded-xl py-2 px-10 shadow-lg uppercase tracking-wider mt-10">
                                MESSAGE
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <img src="./assets/images/vector-contactus.png" class="w-96" alt="" srcset="">
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 4,
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      spaceBetween: 10,
    //   pagination: {
    //     el: ".swiper-pagination",
    //     clickable: true,
    //   },
    });
  </script>
@endpush

@endsection
