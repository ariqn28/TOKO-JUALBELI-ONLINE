<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - Toko Jual Beli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .register-container {
            max-width: 400px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            background-color: #007bff;
            border: none;
            padding: 10px;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Daftar Akun</h2>

    @if ($errors->any())
        <div>
            <ul class="error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">Nama Lengkap</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <button type="submit">Daftar</button>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </form>
</div>

</body>
</html>
