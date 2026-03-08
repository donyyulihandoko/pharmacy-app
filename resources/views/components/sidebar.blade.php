<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center p-3 {{ request()->routeIs('dashboard') ? ' text-blue-600 bg-blue-50' : ' text-gray-700' }} rounded-xl group transition-all">
                        <svg class="w-5 h-5 transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center p-3 {{ request()->routeIs('admin.categories.*') ? ' text-blue-600 bg-blue-50' : ' text-gray-700' }} rounded-xl hover:bg-gray-100 group transition-all">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600 transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                        <span class="ms-3">Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="flex items-center p-3 {{ request()->routeIs('admin.products.*') ? ' text-blue-600 bg-blue-50' : ' text-gray-700' }} rounded-xl hover:bg-gray-100 group transition-all">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600 transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                        <span class="ms-3">Produk</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-gray-100 group transition-all">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600 transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                        <span class="ms-3">Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-gray-100 group transition-all">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600 transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        <span class="ms-3">Manajemen User</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>