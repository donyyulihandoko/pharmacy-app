<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - PharmaCare' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 antialiased font-sans">
    
  
    <x-navbar/>   

    <x-sidebar/>    

    <div class="p-4 md:ml-64 min-h-screen pt-20">
        <div class="p-4">
            {{ $slot }}
        </div>
    </div>

    @include('components.alert')

<script>
    // Menggunakan Event Delegation agar tetap jalan meski data di-refresh Livewire
    document.addEventListener('click', function (e) {
        // Cek apakah yang diklik adalah tombol delete atau elemen di dalam tombol delete (seperti ikon SVG)
        const button = e.target.closest('.delete-btn');
        
        if (button) {
            e.preventDefault();
            const id = button.getAttribute('data-id');
            const form = document.getElementById('delete-form-' + id);

            if (!form) {
                console.error('Form tidak ditemukan untuk ID:', id);
                return;
            }

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data kategori ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#14b8a6', // Teal 500 (sesuai tema kamu)
                cancelButtonColor: '#f43f5e',  // Rose 500
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                borderRadius: '1.5rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
</script>
    
</body>
</html>