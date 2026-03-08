<x-app-layout>
    <x-slot name="title">Tambah Produk Baru | PharmaCare</x-slot>

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4 px-4">
        <div>
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">Tambah Produk</h1>
            <p class="text-teal-600/60 font-medium mt-1">Masukkan detail obat atau produk kesehatan baru ke dalam katalog.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-rose-500 transition-colors group">
            <div class="p-2 rounded-full group-hover:bg-rose-50 transition-colors mr-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            Batalkan
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="w-full px-4 pb-20">
        @csrf
        <div class="bg-white border border-teal-100 rounded-[3.5rem] shadow-2xl shadow-teal-100/50 overflow-hidden">
            <div class="p-10 md:p-16">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-16 gap-y-10">
                    
                    <div class="space-y-10">
                        <div>
                            <label for="name" class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">Nama Produk</label>
                            <input type="text" name="name" id="name" onkeyup="generateSlug()" 
                                class="w-full bg-teal-50/30 border-2 border-teal-50 text-gray-900 text-lg rounded-3xl focus:ring-8 focus:ring-teal-500/5 focus:border-teal-500 block p-5 transition-all outline-none font-bold placeholder:font-medium placeholder:text-teal-200 shadow-inner" 
                                placeholder="Contoh: Paracetamol 500mg" required>
                            @error('name') <span class="text-rose-600 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="price" class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">Harga (Rp)</label>
                                <input type="number" name="price" id="price" 
                                    class="w-full bg-teal-50/30 border-2 border-teal-50 text-gray-900 text-lg rounded-3xl focus:ring-8 focus:ring-teal-500/5 focus:border-teal-500 block p-5 transition-all outline-none font-bold placeholder:text-teal-200 shadow-inner" 
                                    placeholder="0" required>
                                @error('price') <span class="text-rose-600 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
                            </div>
                            
    
                            <div class="relative group">
                                <label for="category_id" class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">
                                    Kategori Produk ({{ $categories->count() }})
                                </label>
                                
                                <div class="relative">
                                    <select name="category_id" id="category_id" 
                                        class="w-full bg-teal-50/30 border-2 border-teal-50 text-gray-900 text-base rounded-3xl focus:ring-8 focus:ring-teal-500/5 focus:border-teal-500 block p-5 transition-all outline-none font-bold appearance-none cursor-pointer shadow-inner">
                                        
                                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Pilih Kategori</option>

                                        {{-- Kita bagi kategori menjadi beberapa grup per 10 item --}}
                                        @foreach($categories->chunk(10) as $index => $chunk)
                                            <optgroup label="Kelompok {{ $index + 1 }}">
                                                @foreach($chunk as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>

                                    {{-- Icon Panah Custom --}}
                                    {{-- <div class="absolute inset-y-0 right-0 flex items-center pr-6 pointer-events-none text-teal-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div> --}}
                                </div>
                                @error('category_id') <span class="text-rose-600 text-[10px] font-bold uppercase tracking-wider mt-2 ml-1 block">{{ $message }}</span> @enderror
                            </div>
                            {{-- <div>
                                <label for="category_id" class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">Kategori</label>
                                <select name="category_id" id="category_id" 
                                    class="w-full bg-teal-50/30 border-2 border-teal-50 text-gray-900 text-base rounded-3xl focus:ring-8 focus:ring-teal-500/5 focus:border-teal-500 block p-5 transition-all outline-none font-bold appearance-none cursor-pointer shadow-inner">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>

                        <div>
                            <label for="about" class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">Tentang Produk</label>
                            <textarea name="about" id="about" rows="5" 
                                class="w-full bg-teal-50/30 border-2 border-teal-50 text-gray-900 text-base rounded-[2.5rem] focus:ring-8 focus:ring-teal-500/5 focus:border-teal-500 block p-8 transition-all outline-none font-medium placeholder:text-teal-200 shadow-inner" 
                                placeholder="Jelaskan kegunaan, dosis, atau deskripsi produk..."></textarea>
                            @error('about') <span class="text-rose-600 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="space-y-10">
                        <div>
                            <label for="slug" class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">Product Slug</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-5 pointer-events-none text-teal-400 font-mono text-xs">
                                    shop/
                                </div>
                                <input type="text" name="slug" id="slug" 
                                    class="w-full bg-gray-100 border-2 border-transparent text-gray-500 text-sm rounded-3xl block ps-16 p-5 font-mono outline-none cursor-not-allowed transition-all shadow-inner" 
                                    placeholder="auto-generated-slug" readonly>
                            </div>
                        </div>

                        <div>
                            <label for="image" class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">Foto Produk</label>
                            <label for="image" class="relative flex flex-col items-center justify-center w-full h-[320px] border-2 border-teal-100 border-dashed rounded-[3rem] cursor-pointer bg-teal-50/20 hover:bg-teal-500/5 hover:border-teal-400 transition-all group overflow-hidden shadow-sm">
                                <div id="dropzone-content" class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <div class="w-16 h-16 mb-4 bg-white rounded-2xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform group-hover:shadow-teal-200">
                                        <svg class="w-8 h-8 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="text-xs text-teal-600 font-black uppercase tracking-widest">Klik untuk Upload Gambar</p>
                                    <p class="text-[10px] text-gray-400 mt-2 italic font-medium">Rekomendasi: Ratio 1:1 (Square)</p>
                                </div>
                                <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
                                <input id="image" name="image" type="file" class="hidden" onchange="previewImage(this)" accept="image/*" />
                            </label>
                            @error('image') <span class="text-rose-600 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-16 pt-10 border-t-2 border-teal-50/50 flex flex-col md:flex-row items-center justify-end gap-8">
                    <button type="submit" class="w-full md:w-auto bg-teal-600 text-white px-20 py-6 rounded-[2rem] text-base font-black hover:bg-teal-700 shadow-[0_20px_50px_rgba(13,148,136,0.3)] hover:-translate-y-1 transition-all active:scale-95 uppercase tracking-[0.2em]">
                        Simpan Produk
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function generateSlug() {
            const name = document.getElementById('name').value;
            const slug = name.toLowerCase()
                            .trim()
                            .replace(/[^\w ]+/g, '')
                            .replace(/ +/g, '-');
            document.getElementById('slug').value = slug;
        }

        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const content = document.getElementById('dropzone-content');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    content.classList.add('opacity-0');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


        new TomSelect("#category_id",{
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>
</x-app-layout>