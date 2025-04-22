<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOLX</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        header h1 {
            margin: 0;
            font-size: 1.5rem;
        }

        nav a, nav form button {
            color: #fff;
            margin-left: 15px;
            text-decoration: none;
            font-weight: bold;
            background: none;
            border: none;
            cursor: pointer;
        }

        .container {
            max-width: 1024px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 20px;
        }

        .category-card {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            transition: 0.2s;
            text-decoration: none;
            color: #333;
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .category-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .category-card h4 {
            margin: 0;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

<header>
    <h1>Toko Jual Beli</h1>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('products.index') }}">Produk</a>
        <a href="{{ route('categories.index') }}">Kategori</a>

        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>
</header>

<div class="container">
    <h2>Kategori Produk</h2>

    @if ($categories->count())
        <div class="category-grid">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category->id) }}" class="category-card">
                    <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/default-category.png') }}" alt="{{ $category->name }}">
                    <h4>{{ $category->name }}</h4>
                </a>
            @endforeach
        </div>
    @else
        <p style="text-align: center;">Belum ada kategori tersedia.</p>
    @endif
</div>

</body>
</html>
