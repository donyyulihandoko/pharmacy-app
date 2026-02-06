<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PharmaCare' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <main class="bg-white">
        <div class="flex flex-col lg:flex-row min-h-screen">
            <div class="hidden lg:flex lg:w-1/2 bg-blue-600 items-center justify-center p-12 relative overflow-hidden">
                <svg class="absolute bottom-0 left-0 mb-8 ml-8 text-blue-500 opacity-20 w-64 h-64" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H9z"></path></svg>
                <div class="relative z-10 text-center">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20">
                        <h2 class="text-4xl font-bold text-white mb-4">PharmaCare System</h2>
                        <p class="text-blue-100 text-lg">Manajemen stok obat dan resep jadi lebih praktis, akurat, dan aman.</p>
                    </div>
                </div>
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-blue-500 rounded-full opacity-50"></div>
            </div>

            <div class="flex-1 flex items-center justify-center p-8 sm:p-12 lg:p-16">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>
</body>
</html>