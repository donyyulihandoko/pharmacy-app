<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 text-sm">
    <title>PharmaCare - Solusi Digital Farmasi Modern</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white antialiased">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H9z"></path></svg>
                    <span class="ml-2 text-2xl font-extrabold text-gray-900 tracking-tight">Pharma<span class="text-blue-600">Care</span></span>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900 transition">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">Daftar Sekarang</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-16 pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 text-center lg:text-left z-10">
                <span class="inline-block py-1 px-3 mb-4 text-xs font-bold bg-blue-50 text-blue-600 rounded-full uppercase tracking-widest">Digital Health Solution</span>
                <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                    Kelola Apotek Jadi Lebih <span class="text-blue-600">Mudah & Akurat.</span>
                </h1>
                <p class="text-lg text-gray-500 mb-8 max-w-xl mx-auto lg:mx-0">
                    Sistem manajemen farmasi terintegrasi untuk kontrol stok obat, transaksi penjualan, hingga laporan keuangan dalam satu platform.
                </p>
                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-blue-700 transition shadow-xl shadow-blue-200 text-center">Mulai Kelola Sekarang</a>
                    <a href="#features" class="bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 transition text-center">Lihat Fitur</a>
                </div>
            </div>
            <div class="lg:w-1/2 mt-16 lg:mt-0 relative">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
                <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-green-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
                <div class="relative bg-white p-4 rounded-3xl shadow-2xl border border-gray-100">
                    <img src="https://img.freepik.com/free-vector/pharmacist-concept-illustration_114360-3022.jpg" alt="Pharmacy System" class="rounded-2xl">
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Fitur Utama PharmaCare</h2>
            <p class="text-gray-500 mb-16 max-w-2xl mx-auto">Dirancang khusus untuk memenuhi kebutuhan operasional apoteker dan pemilik apotek.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition duration-300">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Manajemen Stok</h3>
                    <p class="text-gray-500 leading-relaxed italic">Pantau stok obat secara real-time dengan notifikasi otomatis saat stok menipis atau kadaluarsa.</p>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition duration-300">
                    <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Kasir Pintar</h3>
                    <p class="text-gray-500 leading-relaxed italic">Proses transaksi penjualan obat jadi lebih cepat dan tercatat otomatis ke sistem keuangan.</p>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition duration-300">
                    <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Laporan Akurat</h3>
                    <p class="text-gray-500 leading-relaxed italic">Dapatkan laporan laba rugi, penjualan harian, dan grafik tren obat paling laku secara instan.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white py-12 border-t border-gray-100 text-center">
        <p class="text-gray-400 text-sm italic">&copy; 2026 PharmaCare System. Built for Healthier Future.</p>
    </footer>

</body>
</html>