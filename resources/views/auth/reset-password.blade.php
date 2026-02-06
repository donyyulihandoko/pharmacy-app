<x-guest-layout>
    <x-slot name="title">Atur Ulang Password | PharmaCare</x-slot>

    <div class="mb-8 text-center lg:text-left">
        <div class="inline-flex items-center justify-center w-14 h-14 mb-4 rounded-full bg-blue-50 text-blue-600">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Atur Ulang Password</h2>
        <p class="text-gray-500 mt-2 text-sm">Silakan buat password baru yang kuat untuk keamanan akun farmasi Anda.</p>
    </div>

    <form action="{{ route('password.store') }}" method="POST" class="space-y-5">
        @csrf
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div>
            <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">Email Anda</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path></svg>
                </div>
                <input type="email" id="email" name="email" class="bg-gray-100 border border-gray-200 text-gray-500 text-sm rounded-xl block w-full pl-10 p-3.5 cursor-not-allowed" value="{{ $request->email }}" readonly>
            </div>
        </div>

        <div>
            <label for="password" class="block mb-2 text-sm font-semibold text-gray-700">Password Baru</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 block w-full pl-10 p-3.5 transition-all outline-none" placeholder="••••••••" required>
                @error('password')
                    <span class="text-red-600"></span>
                @enderror
            </div>
        </div>

        <div>
            <label for="password_confirmation" class="block mb-2 text-sm font-semibold text-gray-700">Konfirmasi Password Baru</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 block w-full pl-10 p-3.5 transition-all outline-none" placeholder="••••••••" required>
            </div>
        </div>

        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-xl text-sm px-5 py-4 transition-all shadow-lg shadow-blue-200">
            SIMPAN PASSWORD BARU
        </button>
    </form>
</x-guest-layout>