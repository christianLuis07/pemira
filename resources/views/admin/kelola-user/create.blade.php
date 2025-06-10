@extends('layouts.dashboard')

@section('content')

    <div class="flex-none w-full max-w-full px-3">
        <div
            class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <form action="{{ route('admin.kelola-user.create') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="nim"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">nim</label>
                    <input type="text" id="nim" name="nim" value="{{ old('nim') }}"
                        class="bg-transparent border @error('nim') border-red-500 @else border-gray-300 @enderror text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white"
                        placeholder="21xxxxxx">
                    @error('nim')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <label for="nim" class="block mb-2 text-sm text-gray-500 dark:text-gray-300">* nim
                        mahasiswa</label>
                </div>
                <div class="mb-6">
                    <label for="email-adress-icon"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>

                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                        </div>
                        <input type="text" id="email-adress-icon" name="email" value="{{ old('email') }}"
                            class="bg-transparent border @error('email') border-red-500 @else border-gray-300 @enderror text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 pl-10 dark:text-white"
                            placeholder="example@gmail.com">
                    </div>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                    <input type="password" id="password" name="password"
                        class="bg-transparent border @error('password') border-red-500 @else border-gray-300 @enderror text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" type="checkbox"
                            class="w-5 h-5 bg-transparent rounded border border-gray-300 focus:ring-0 checked:bg-dark-900">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                    </div>
                </div>
                <button type="submit"
                    class="text-white bg-gradient-to-br from-pink-500 to-voilet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 text-center inline-flex items-center shadow-md shadow-gray-300 dark:shadow-gray-900 hover:scale-[1.02] transition-transform">
                    Submit
                </button>
            </form>

        </div>
    </div>
@endsection
