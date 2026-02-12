<div>
    <div class="mb-8 flex flex-col md:flex-row gap-6 items-center justify-between">
        <div class="relative w-full max-w-xl">
            <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-teal-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" name="search" wire:model.live="search" class="block w-full pl-14 pr-6 py-4 bg-white border-2 border-teal-50 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 shadow-lg shadow-gray-100 transition-all outline-none text-gray-700 font-bold placeholder-gray-400" placeholder="Cari nama kategori...">
        </div>
        
    </div>

    <div class="bg-white border-2 border-teal-50 rounded-[2.5rem] overflow-hidden shadow-2xl shadow-gray-200/50">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-teal-50/50 text-teal-700 text-[11px] uppercase tracking-[0.2em] border-b-2 border-teal-50">
                        <th class="px-8 py-6 text-center w-20">No</th>
                        <th class="px-8 py-6">Informasi Kategori</th>
                        <th class="px-8 py-6">Deskripsi</th>
                        <th class="px-8 py-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-teal-50 text-sm">
                    @forelse($categories as $index => $category)
                    <tr class="group hover:bg-teal-50/30 transition-all">
                        <td class="px-8 py-6 text-center">
                            <span class="text-teal-400 font-black font-mono">#{{ str_pad(($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-5">
                                <div class="w-14 h-14 bg-gradient-to-br from-teal-400 to-blue-500 text-white rounded-2xl flex items-center justify-center font-black text-xl shadow-lg shadow-teal-100 group-hover:scale-110 transition-all transform">
                                    {{-- image start --}}
                                    <div class="w-14 h-14 rounded-2xl overflow-hidden shadow-lg shadow-teal-100 group-hover:scale-110 transition-all transform border-2 border-white">
                                        @if($category->icon)
                                            <img src="{{ asset('storage/' . $category->icon) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-teal-400 to-blue-500 flex items-center justify-center text-white font-black">
                                                {{ substr($category->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    {{-- image end --}}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-black text-gray-800 text-lg tracking-tight group-hover:text-teal-600 transition-colors">{{ $category->name }}</span>
                                    <span class="text-xs text-blue-500 font-bold tracking-wide mt-0.5 bg-blue-50 px-2 py-0.5 rounded-md w-fit italic">/{{ $category->slug }}</span>
                                </div>
                            </div>
                        </td>

                        <td class="px-8 py-6">
                            <p class="text-gray-500 leading-relaxed font-medium max-w-xs line-clamp-2" title="{{ $category->description }}">
                                {{ $category->description ?? '—' }}
                            </p>
                        </td>

                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('categories.edit', $category) }}" class="w-11 h-11 flex items-center justify-center text-teal-600 bg-teal-50 hover:bg-teal-500 hover:text-white rounded-xl transition-all shadow-sm group/btn" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <button type="button" 
                                    data-id="{{ $category->id }}" 
                                    class="delete-btn  w-11 h-11 flex items-center justify-center text-rose-500 bg-rose-50 hover:bg-rose-500 hover:text-white rounded-xl transition-all shadow-sm" title="Hapus" >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>

                                <form action="{{ route('categories.destroy', $category) }}" method="POST" id="delete-form-{{ $category->id }}" class="hidden">
                                    @csrf 
                                    @method('DELETE')
                                </form>
                                
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 text-teal-100 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <p class="text-gray-400 font-bold italic">Data kategori tidak ditemukan...</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        <div class="px-8 py-6 bg-teal-50/50 border-t-2 border-teal-50 ">
            {{ $categories->links() }}
        </div>
        </div>
    </div>
</div>
