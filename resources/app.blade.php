<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'GOLX') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">
    <div class="min-h-screen flex flex-col">
        
        {{-- Navbar --}}
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">GOLX</a>
                <div class="flex gap-4 items-center">
                    @auth
                        <a href="{{ route('products.index') }}" class="text-sm text-gray-700 hover:text-blue-600">Produk Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:underline">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-blue-600">Login</a>
                        <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-blue-600">Daftar</a>
                    @endauth
                </div>
            </div>
        </nav>

        {{-- Optional Header --}}
        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        {{-- Main Content --}}
        <main class="flex-1 max-w-7xl mx-auto w-full py-6 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
