<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>GOLX - Marketplace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color:rgb(16, 101, 227);
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navbar custom styling */
        .navbar {
            background-color: #007bff; /* Use a custom primary color if needed */
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107 !important; /* Optional: change color on hover */
        }

        /* Container and content */
        .container {
            max-width: 1200px;
            margin-top: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .product-card img {
            width: 100%;
            height: auto;
        }

        .product-card-body {
            padding: 15px;
            text-align: center;
        }

        .product-card-body h5 {
            color: #007bff;
            margin: 10px 0;
        }

        .product-card-body p {
            color: #333;
            font-size: 1rem;
            margin: 10px 0;
        }

        .product-card-body .btn {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .product-card-body .btn:hover {
            background-color: #0056b3;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-md-3 {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="http://127.0.0.1:8000">GOLX</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/categories">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/products">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/profile">Profil</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Product Content Section -->
<div class="container">
    <h2>Produk Kami</h2>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3">
                <div class="product-card">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.jpg') }}" alt="{{ $product->name }}">
                    <div class="product-card-body">
                        <h5>{{ $product->name }}</h5>
                        <p>{{ Str::limit($product->description, 100) }}</p>
                        <p>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Optional Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
