<div>
    <div class="mb-8 flex flex-col md:flex-row gap-6 items-center justify-between">
        <div class="relative w-full max-w-xl">
            <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-teal-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" wire:model.live="search" class="block w-full pl-14 pr-6 py-4 bg-white border-2 border-teal-50 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 shadow-lg shadow-gray-100 transition-all outline-none text-gray-700 font-bold placeholder-gray-400" placeholder="Cari produk impian...">
        </div>
        
    </div>

    <div class="bg-white border-2 border-teal-50 rounded-[2.5rem] overflow-hidden shadow-2xl shadow-gray-200/50">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-teal-50/50 text-teal-700 text-[11px] uppercase tracking-[0.2em] border-b-2 border-teal-50">
                        <th class="px-8 py-6 text-center w-20">No</th>
                        <th class="px-8 py-6">Produk</th>
                        <th class="px-8 py-6">Kategori</th>
                        <th class="px-8 py-6">Harga</th>
                        <th class="px-8 py-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-teal-50 text-sm">
                    @forelse($products as $product)
                    <tr class="group hover:bg-teal-50/30 transition-all">
                        <td class="px-8 py-6 text-center">
                            <span class="text-teal-400 font-black font-mono">#{{ str_pad(($products->currentPage() - 1) * $products->perPage() + $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-lg shadow-teal-100 group-hover:scale-105 transition-all transform border-2 border-white flex-shrink-0">
                                    @if($product->image)
                                        <img 
                                            src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" 
                                            class="w-full h-full object-cover" 
                                            alt="{{ $product->name }}">
                                    @else
                                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300 italic text-[10px]">
                                            No Photo
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-black text-gray-800 text-lg tracking-tight group-hover:text-teal-600 transition-colors line-clamp-1">{{ $product->name }}</span>
                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5 line-clamp-1 italic">{{ Str::limit($product->about, 40) }}</span>
                                </div>
                            </div>
                        </td>

                        <td class="px-8 py-6">
                            <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-xl font-black text-xs uppercase tracking-wider border border-blue-100">
                                {{ $product->category->name }}
                            </span>
                        </td>

                        <td class="px-8 py-6">
                            <div class="flex flex-col">
                                <span class="text-gray-900 font-black text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-[10px] text-teal-500 font-bold tracking-tighter uppercase">Fixed Price</span>
                            </div>
                        </td>

                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-3 text-center">
                                <a href="{{ route('admin.products.edit', $product) }}" class="w-11 h-11 flex items-center justify-center text-teal-600 bg-teal-50 hover:bg-teal-500 hover:text-white rounded-xl transition-all shadow-sm" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <button type="button" data-id="{{ $product->id }}" class="delete-btn w-11 h-11 flex items-center justify-center text-rose-500 bg-rose-50 hover:bg-rose-500 hover:text-white rounded-xl transition-all shadow-sm" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" id="delete-form-{{ $product->id }}" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-teal-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-teal-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <p class="text-gray-400 font-bold italic">Belum ada produk yang terdaftar...</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-8 py-6 bg-teal-50/50 border-t-2 border-teal-50">
            {{ $products->links() }}
        </div>
    </div>
</div>

