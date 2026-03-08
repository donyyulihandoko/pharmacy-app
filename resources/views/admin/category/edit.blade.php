<x-app-layout>
    <x-slot name="title">Edit Kategori | PharmaCare</x-slot>

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4 px-4">
        <div>
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">Edit Kategori</h1>
            <p class="text-blue-600/60 font-medium mt-1">Edit detail kategori untuk pengelompokan obat yang lebih rapi.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-red-500 transition-colors group">
            <div class="p-2 rounded-full group-hover:bg-red-50 transition-colors mr-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            Batalkan
        </a>
    </div>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="w-full px-4">
        @csrf @method('PUT')
        <div class="bg-white border border-blue-100 rounded-[3.5rem] shadow-2xl shadow-blue-100/50 overflow-hidden">
            <div class="p-10 md:p-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-10">
                    
                    <div class="space-y-10">
                        <div>
                            <label for="name" class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">Nama Kategori</label>
                            <input type="text" name="name" id="name" onkeyup="generateSlug()" 
                                class="w-full bg-blue-50/30 border-2 border-blue-50 text-gray-900 text-lg rounded-3xl focus:ring-8 focus:ring-blue-500/5 focus:border-blue-500 block p-5 transition-all outline-none font-bold placeholder:font-medium placeholder:text-blue-200 shadow-inner" 
                                placeholder="Misal: Obat Sirup Anak" required value="{{ old('name', $category->name) }}">
                            @error('name')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">Deskripsi Kategori</label>
                            <textarea name="description" id="description" rows="5" 
                                class="w-full bg-blue-50/30 border-2 border-blue-50 text-gray-900 text-base rounded-[2.5rem] focus:ring-8 focus:ring-blue-500/5 focus:border-blue-500 block p-8 transition-all outline-none font-medium placeholder:text-blue-200 shadow-inner" 
                                placeholder="Berikan penjelasan singkat mengenai kategori ini...">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>

                    <div class="space-y-10">
                        <div>
                            <label for="slug" class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">Slug (URL Otomatis)</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-5 pointer-events-none text-blue-400 font-mono text-xs">
                                    pharma.care/
                                </div>
                                <input type="text" name="slug" id="slug" 
                                    class="w-full bg-gray-100 border-2 border-transparent text-gray-500 text-sm rounded-3xl block ps-28 p-5 font-mono outline-none cursor-not-allowed transition-all" 
                                    placeholder="slug-url" readonly>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <div>
                                <label for="icon" class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">Icon Visual</label>
                                @php 
                                    $hasIcon = $category->icon && Storage::disk('public')->exists($category->icon); 
                                @endphp
                                <label for="icon" class="relative flex flex-col items-center justify-center w-full h-44 border-2 border-blue-100 border-dashed rounded-[2.5rem] cursor-pointer bg-blue-50/20 hover:bg-blue-500/5 hover:border-blue-400 transition-all group overflow-hidden shadow-sm">
    
                                    <div id="dropzone-content" class="flex flex-col items-center justify-center pt-5 pb-6 {{ $hasIcon ? 'opacity-0' : '' }}">
                                        </div>

                                    <img id="image-preview" 
                                        src="{{ $hasIcon ? asset('storage/' . $category->icon) : '' }}" 
                                        class="absolute inset-0 w-full h-full object-cover rounded-[2.5rem] {{ $hasIcon ? '' : 'hidden' }}" />
                                    
                                    <input id="icon" name="icon" type="file" class="hidden" onchange="previewImage(this)" accept="image/*" />
                                </label>
                                {{-- <label for="icon" class="relative flex flex-col items-center justify-center pt-5 pb-6">
                                    <div id="dropzone-content" class="flex flex-col items-center justify-center pt-5 pb-6 {{ $hasIcon ? 'opacity-0' : '' }}">
                                        <div class="w-14 h-14 mb-4 bg-white rounded-2xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform group-hover:shadow-blue-200">
                                            <svg class="w-7 h-7 text-blue-500" ...><path ... d="M12 4v16m8-8H4"></path></svg>
                                        </div>
                                        <p class="text-xs text-blue-600 font-black uppercase tracking-widest">Upload Icon</p>
                                    </div>

                                    <img id="image-preview" 
                                        src="{{ $hasIcon ? asset('storage/' . $category->icon) : '' }}" 
                                        class="absolute inset-0 w-full h-full object-cover {{ $hasIcon ? '' : 'hidden' }}" />
                                    
                                    <input id="icon" name="icon" type="file" class="hidden" onchange="previewImage(this)" accept="image/*" />
                                </label> --}}
                            </div>

                            <div>
                                <label class="block mb-3 text-xs font-black uppercase tracking-[0.25em] text-gray-500 ml-1">Status Publikasi</label>
                                <div class="flex items-center justify-between p-6 bg-blue-50/30 border-2 border-blue-50 rounded-3xl h-[110px] sm:h-44 flex-col">
                                    <span class="text-sm font-black text-blue-900 uppercase tracking-tighter">Aktifkan</span>
                                    <label class="relative inline-flex items-center cursor-pointer mt-2">
                                    <input type="checkbox" 
                                        name="is_active" 
                                        value="1" 
                                        class="sr-only peer" 
                                        {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                        <div class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600 shadow-sm"></div>
                                        @error('is_active')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-16 pt-10 border-t-2 border-blue-50/50 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-blue-600 rounded-3xl flex items-center justify-center shadow-xl shadow-blue-200">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-gray-900 uppercase tracking-tight">Informasi</h4>
                            <p class="max-w-xs text-xs text-gray-400 font-bold leading-relaxed mt-0.5">
                                Pastikan icon yang diupload memiliki kontras yang baik dengan warna latar aplikasi.
                            </p>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full md:w-auto bg-blue-600 text-white px-16 py-6 rounded-[2rem] text-base font-black hover:bg-blue-700 shadow-[0_20px_50px_rgba(37,99,235,0.3)] hover:-translate-y-1 transition-all active:scale-95 uppercase tracking-[0.2em]">
                        Update Kategori
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    generateSlug(); // Mengisi slug secara otomatis saat buka halaman edit
});
        function generateSlug() {
            const name = document.getElementById('name').value;
            const slug = name.toLowerCase()
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
            content.classList.add('opacity-0'); // Sembunyikan icon plus saat gambar baru dipilih
        }
        reader.readAsDataURL(input.files[0]);
    }
        }
    </script>
</x-app-layout>