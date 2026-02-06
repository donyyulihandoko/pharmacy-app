<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - PharmaCare' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased font-sans">
    
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
                            <li><a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#" class="flex items-center p-3 text-blue-600 bg-blue-50 rounded-xl group transition-all">
                        <svg class="w-5 h-5 transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-gray-100 group transition-all">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600 transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                        <span class="ms-3">Stok Obat</span>
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

    <div class="p-4 md:ml-64 min-h-screen pt-20">
        <div class="p-4">
            {{ $slot }}
        </div>
    </div>

</body>
</html>