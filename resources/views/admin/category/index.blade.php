<x-app-layout>
    <x-slot name="title">Manajemen Kategori | PharmaCare</x-slot>

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4 px-2">
        <div>
            <h1 class="text-4xl font-black text-gray-800 tracking-tight">Kategori Obat</h1>
            <p class="text-teal-600 mt-2 font-bold flex items-center gap-2">
                <span class="w-2 h-2 bg-teal-400 rounded-full animate-pulse"></span>
                Manajemen inventaris farmasi real-time
            </p>
        </div>
        <a href="{{ route('categories.create') }}" class="bg-gradient-to-r from-teal-500 to-blue-600 text-white px-8 py-4 rounded-2xl text-sm font-black hover:from-teal-600 hover:to-blue-700 shadow-xl shadow-teal-200 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            TAMBAH KATEGORI
        </a>
    </div>

   <x-alert/>   
    @livewire('tables.category')

</x-app-layout>