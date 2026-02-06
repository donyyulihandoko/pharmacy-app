<x-guest-layout>
    <x-slot name="title">Daftar Akun | PharmaCare</x-slot>

    <div class="mb-8 text-center lg:text-left">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Daftar Akun Baru</h2>
        <p class="text-gray-500 mt-2">Lengkapi data untuk bergabung dalam sistem PharmaCare.</p>
    </div>

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block mb-1.5 text-sm font-semibold text-gray-700">Nama Lengkap</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 block w-full pl-10 p-3 transition-all outline-none" placeholder="Masukkan nama lengkap" required>
                 @error('name')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label for="email" class="block mb-1.5 text-sm font-semibold text-gray-700">Email Address</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </div>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 block w-full pl-10 p-3 transition-all outline-none" placeholder="apoteker@pharma.com" value="{{ old('email') }}"  required>
                 @error('email')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="password" class="block mb-1.5 text-sm font-semibold text-gray-700">Password</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 block w-full pl-10 p-3 transition-all outline-none" placeholder="••••••••" required>
                     @error('password')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block mb-1.5 text-sm font-semibold text-gray-700">Konfirmasi</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 block w-full pl-10 p-3 transition-all outline-none" placeholder="••••••••" required>
                        @error('password_confirmation')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- <div class="flex items-start py-2">
            <div class="flex items-center h-5">
                <input id="terms" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 transition-all cursor-pointer" required>
            </div>
            <div class="ml-3 text-sm">
                <label for="terms" class="text-gray-600">Saya setuju dengan <a href="#" class="text-blue-600 font-bold hover:underline">Syarat & Ketentuan</a> yang berlaku.</label>
            </div>
        </div> --}}

        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-xl text-sm px-5 py-4 transition-all transform active:scale-[0.98] shadow-lg shadow-blue-200">
            DAFTAR SEKARANG
        </button>

        <div class="relative flex py-2 items-center">
            <div class="flex-grow border-t border-gray-200"></div>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <p class="text-center text-sm text-gray-500">
            Sudah punya akun? <a href="/login" class="text-blue-600 font-bold hover:underline">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>