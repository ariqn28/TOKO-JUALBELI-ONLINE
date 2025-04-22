<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOLX</title>

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap CSS (jika diperlukan tambahan selain dari Tailwind/Vite) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light font-sans">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="{{ url('/') }}">GOLX</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto text-white">
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('categories.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('categories.index') }}">Kategori</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('products.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
                    </li>

                    @auth
                        <li class="nav-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('profile.edit') }}">Profil</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link" style="padding: 0;">Logout</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('register') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="container my-5">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
