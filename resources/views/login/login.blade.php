<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h1 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 0.75rem;
            background: #3490dc;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background: #2779bd;
        }

        .register-link {
            margin-top: 1rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .alert {
            background: #f8d7da;
            color: #721c24;
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>Login</h1>

    @if (session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    <form action="#" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn">Login</button>
    </form>

    <div class="register-link">
        @if (!App\Models\Pegawai::whereJsonContains('wewenang', \App\WewenangEnum::Admin->value)->exists())
            <a href="#">Belum punya akun? Daftar Admin di sini</a>
        @else
            <span>Admin sudah ada. Hubungi Admin untuk pendaftaran.</span>
        @endif
    </div>
</div>

</body>
</html>
