<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Masuk Akun - Toko Jual Beli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .login-container {
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

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
        }

        .register-link a:hover {
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

<div class="login-container">
    <h2>Masuk Akun</h2>

    @if (session('status'))
        <div class="error" style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div>
            <ul class="error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Masuk</button>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </form>
</div>

</body>
</html>
