  <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 shadow-sm">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path></svg>
                    </button>
                    <a href="#" class="flex ms-2 md:me-24">
                        <svg class="w-8 h-8 me-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H9z"></path></svg>
                        <span class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap text-blue-600">PharmaCare</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div class="text-right me-3 hidden sm:block">
                            <p class="text-sm font-semibold text-gray-900 leading-none">Apoteker Budi</p>
                            <p class="text-xs text-gray-500 mt-1">Administrator</p>
                        </div>
                        <button type="button" class="flex text-sm bg-blue-600 rounded-full focus:ring-4 focus:ring-blue-100" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-xs">AB</div>
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user">
                        <ul class="py-1" role="none">
                            <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit">Keluar</button>
                                </form>
                                {{-- <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</a> --}}
                            </li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
