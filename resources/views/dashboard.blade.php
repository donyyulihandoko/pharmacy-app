<x-app-layout>
    <x-slot name="title">Dashboard Utama | PharmaCare</x-slot>

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Halo, Apoteker Budi! 👋</h1>
            <p class="text-gray-500 mt-1">Berikut adalah ringkasan apotek Anda hari ini, <span class="font-semibold text-blue-600">{{ date('d M Y') }}</span>.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-50 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Unduh Laporan
            </button>
            <button class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">
                + Transaksi Baru
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="relative overflow-hidden bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-green-50 rounded-2xl text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">+12.5%</span>
            </div>
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pendapatan Hari Ini</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1">Rp 4.250.000</h3>
        </div>

        <div class="relative overflow-hidden bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-red-50 rounded-2xl text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <span class="text-xs font-bold text-red-500 bg-red-100 px-2 py-1 rounded-lg">Penting!</span>
            </div>
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Stok Hampir Habis</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1 text-red-600">12 Item</h3>
        </div>

        <div class="relative overflow-hidden bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-50 rounded-2xl text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Penjualan</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1">85 Transaksi</h3>
        </div>

        <div class="relative overflow-hidden bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-purple-50 rounded-2xl text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Kategori Obat</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1">14 Kategori</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white border border-gray-100 rounded-3xl p-8 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900">Penjualan Terakhir</h3>
                <a href="#" class="text-blue-600 text-sm font-bold hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-gray-50">
                            <th class="pb-4 font-semibold">Produk</th>
                            <th class="pb-4 font-semibold">Waktu</th>
                            <th class="pb-4 font-semibold">Harga</th>
                            <th class="pb-4 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <tr class="group">
                            <td class="py-4 font-bold text-gray-800">Paracetamol 500mg</td>
                            <td class="py-4 text-sm text-gray-500">10:45 AM</td>
                            <td class="py-4 text-sm font-semibold text-gray-900">Rp 15.000</td>
                            <td class="py-4"><span class="bg-green-100 text-green-600 text-[10px] font-black px-2 py-1 rounded-full uppercase">Sukses</span></td>
                        </tr>
                        <tr class="group">
                            <td class="py-4 font-bold text-gray-800">Amoxicillin Syrap</td>
                            <td class="py-4 text-sm text-gray-500">09:12 AM</td>
                            <td class="py-4 text-sm font-semibold text-gray-900">Rp 45.000</td>
                            <td class="py-4"><span class="bg-green-100 text-green-600 text-[10px] font-black px-2 py-1 rounded-full uppercase">Sukses</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-3xl p-6 text-white shadow-xl shadow-blue-200">
                <h3 class="text-lg font-bold mb-2">Butuh Bantuan?</h3>
                <p class="text-blue-100 text-sm mb-4 leading-relaxed">Cek panduan penggunaan sistem PharmaCare atau hubungi support teknis.</p>
                <button class="w-full bg-white text-blue-600 py-3 rounded-2xl font-bold text-sm hover:bg-blue-50 transition">Buka Panduan</button>
            </div>
            
            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                <h3 class="text-gray-900 font-bold mb-4">Shortcut Cepat</h3>
                <div class="grid grid-cols-2 gap-4">
                    <button class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-2xl hover:bg-blue-50 hover:text-blue-600 transition group">
                        <svg class="w-6 h-6 mb-2 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span class="text-xs font-bold">Obat Baru</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-2xl hover:bg-blue-50 hover:text-blue-600 transition group">
                        <svg class="w-6 h-6 mb-2 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span class="text-xs font-bold">Laporan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>