      <!-- Navbar -->
      <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-4 lg:mx-6 transition-all duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
        <div class="flex items-center justify-between w-full px-0 lg:px-4 py-1 mx-auto flex-wrap-inherit">
          <nav>
            <!-- breadcrumb -->
            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
              <li class="leading-normal text-sm">
                <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
              </li>
              <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">{{ ucfirst( Str::replace(['admin.', 'pemilih.', '-'], ' ', Route::currentRouteName()) ) }}</li>
            </ol>
            <h6 class="mb-0 font-bold capitalize">{{ ucfirst( Str::replace(['admin.', 'pemilih.', '-'], ' ', Route::currentRouteName()) ) }}</h6>
          </nav>

          <div class="flex items-center justify-end mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">

            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
              <li class="flex items-center pl-4 xl:hidden">
                <a href="javascript:;" class="block p-0 transition-all ease-nav-brand text-sm text-slate-500" sidenav-trigger>
                  <div class="w-4.5 overflow-hidden">
                    <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                    <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                    <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                  </div>
                </a>
              </li>
              <li class="relative flex items-center px-2">
                <p class="hidden transform-dropdown-show"></p>

                <x-dropdown>
                  <x-slot name="trigger">
                    <div class="flex items-center">
                      <div>
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->detail_pengguna->nama_pemilih }}" class="inline-flex items-center justify-center mr-0 md:mr-4 text-white text-sm h-9 w-9 max-w-none rounded-full" />
                        <span class="hidden sm:inline">{{ auth()->user()->detail_pengguna->nama_pemilih }}</span>
                      </div>
                      <div class="m-0 md:ml-4">
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                      </div>
                    </div>
                  </x-slot>

                  <x-dropdown.item icon="user" label="Profile" />
                  <x-dropdown.item icon="logout" label="Logout" onclick="location.href='{{ route('logout') }}'" />
              </x-dropdown>

              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- end Navbar -->
