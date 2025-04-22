<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>GOLX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        header nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 1.1rem;
            color: #333;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <h1>Toko Jual Beli</h1>
    <nav>
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('categories.index') }}">Kategori</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" style="background:none; border:none; color:white; cursor:pointer;">Logout</button>
        </form>
    </nav>
</header>

<div class="container">
    <h2>Selamat Datang di Dashboard</h2>
    <p>Halo, {{ Auth::user()->name }}! Kamu berhasil login.</p>
</div>

</body>
</html>
