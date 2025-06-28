<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page E-Commers</title>
    <script src="http://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">E-Commers</h1>
            <nav>
    <a href="{{ route('frontend') }}" class="text-gray-600 hover:text-gray-800 px-4">Home</a>
    @if (url'/login)
    @auth
        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800 px-4">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800 px-4">Login</a>
        <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800 px-4">Register</a>
    @endif
    @endauth
    @endif
            </nav>
        </div>
        <section class="bg-blue-500 text-white py-20 text-center">
            <!-- Hero Section -->
<section>
    <h2 class="text-4xl font-bold mb-4">Temukan Produk Terbaik untuk Anda</h2>
    <p class="text-lg mb-6">Diskon hingga 50%! Beli sekarang sebelum kehabisan.</p>
    <a href="#produk" class="bg-white text-blue-500 px-6 py-2 rounded-full font-semibold">Lihat Produk</a>
</section>

<!-- Daftar Produk -->
<section id="produk" class="container mx-auto py-12">
    <h2 class="text-3xl font-bold text-center mb-8">Produk Unggulan</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6">
        @foreach ($produks as $produk)
        <!-- Produk 1 -->
        <div class="bg-white p-6 shadow-md rounded-lg text-center">
            <img src="{{ $produk->gambar }}" alt="Produk" class="mb-4 w-full h-48 object-cover rounded">
            
            <h3 class="text-lg font-semibold">{{ $produk->nama }}</h3>
            <p class="text-gray-600">Rp. {{ number_format($produk->harga) }}</p>
            <br>
            <a href="{{ route('login') }}" class="bg-blue-500 text-white px-5 py-2 mt-4 rounded">Beli Sekarang</a>
        </div>
        @endforeach
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white text-center py-4 mt-8">
    <p>© 2025 E-Commerce | Semua Hak Dilindungi</p>
</footer>

    
</body>
</html>