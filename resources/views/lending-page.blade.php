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
            
    
</body>
</html>