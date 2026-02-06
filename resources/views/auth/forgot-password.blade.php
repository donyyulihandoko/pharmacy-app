<x-guest-layout>
    <x-slot name="title">Lupa Password | PharmaCare</x-slot>

    <div class="mb-8 text-center lg:text-left">
        <div class="inline-flex items-center justify-center w-14 h-14 mb-4 rounded-full bg-blue-50 text-blue-600">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Lupa Password?</h2>
        <p class="text-gray-500 mt-2 text-sm">Jangan khawatir! Masukkan email Anda dan kami akan mengirimkan instruksi untuk mengatur ulang password.</p>
    </div>

    <div class="hidden p-4 mb-6 text-sm text-green-800 rounded-xl bg-green-50 border border-green-100" role="alert">
        <span class="font-bold">Sukses!</span> Link reset password telah dikirim ke email Anda.
    </div>
 <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">Email Terdaftar</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </div>
                <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 block w-full pl-10 p-3.5 transition-all outline-none" placeholder="apoteker@pharma.com" required>
                @error('email')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            
        </div>

        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-xl text-sm px-5 py-4 transition-all shadow-lg shadow-blue-200">
            KIRIM LINK RESET
        </button>

        <div class="text-center">
            <a href="{{ route('login') }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:underline">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>