<x-guest-layout>
    <x-slot name="title">Login | PharmaCare</x-slot>

    <div class="mb-10 text-center lg:text-left">
        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-xl bg-blue-50 lg:hidden">
            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H9z"></path></svg>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Login Pharmacy</h2>
        <p class="text-gray-500 mt-2">Masukkan kredensial Anda untuk akses dashboard.</p>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">Email Address</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </div>
                <input type="email" id="email" value="{{ old('email') }}"  name="email" class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 block w-full pl-10 p-3.5 transition-all outline-none" placeholder="apoteker@pharma.com" required>
                @error('email')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                <a href="{{ route('password.request') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700">Lupa Password?</a>
            </div>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 block w-full pl-10 p-3.5 transition-all outline-none" placeholder="••••••••" required >
                 @error('password')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- <div class="flex items-center">
            <input id="remember" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 transition-all cursor-pointer">
            <label for="remember" class="ml-2 text-sm text-gray-600 cursor-pointer select-none">Biarkan saya tetap masuk</label>
        </div> --}}

        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-xl text-sm px-5 py-4 transition-all transform active:scale-[0.98] shadow-lg shadow-blue-200">
           Login
        </button>

        <div class="relative flex py-3 items-center">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="flex-shrink mx-4 text-gray-400 text-xs uppercase tracking-widest font-semibold">Bantuan</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <p class="text-center text-sm text-gray-500">
            Kendala login? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Belum Punya Akun?</a>
        </p>
    </form>
</x-guest-layout>