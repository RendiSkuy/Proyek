<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Bank Hijau Antapani</title>
    <link rel="icon" href="{{ asset('images/original.png') }}" type="image/x-icon">
    
    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        /* Warna & Tema */
        :root {
            --primary-green: #2ECC71;
            --secondary-green: #27AE60;
            --primary-blue: #1E90FF;
            --secondary-blue: #1565C0;
            --background-light: #F5F5F5;
        }

        body {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-green));
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container img {
            width: 80px;
            margin-bottom: 15px;
        }

        .login-container h2 {
            font-weight: bold;
            color: var(--primary-blue);
            margin-bottom: 15px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .input-group input {
            width: 100%;
            padding: 12px 12px 12px 45px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border 0.3s ease-in-out;
        }

        .input-group input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0px 0px 8px rgba(30, 144, 255, 0.3);
        }

        .btn-login {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 1rem;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s ease-in-out;
        }

        .btn-login:hover {
            background: var(--secondary-blue);
        }

        .alert {
            font-size: 0.9rem;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .register-link, .forgot-password {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 15px;
        }

        .register-link a, .forgot-password a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover, .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="{{ asset('images/original.png') }}" alt="Bank Hijau Antapani Logo">
        <h2>Login Nasabah</h2>

        @if(session('loginError'))
            <div class="alert alert-danger">{{ session('loginError') }}</div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="input-group">
                <i class="fa fa-envelope"></i>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="input-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>
</body>
</html>
