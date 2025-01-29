<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024"> <!-- Paksa tampilan desktop -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Bank Hijau Antapani
    </title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & FontAwesome -->
    <link href="{{ asset('we-cycle-app/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            min-width: 1024px;
            overflow-x: auto;
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, #1E90FF, #2ECC71);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
            color: #1E90FF;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
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
            padding: 12px 12px 12px 40px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border 0.3s ease-in-out;
        }

        .input-group input:focus {
            border-color: #1E90FF;
            box-shadow: 0px 0px 8px rgba(30, 144, 255, 0.3);
        }

        .btn-login {
            background: #1E90FF;
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
            background: #1565C0;
        }

        .login-container p {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .login-container p a {
            color: #2ECC71;
            text-decoration: none;
            font-weight: bold;
        }

        .login-container p a:hover {
            text-decoration: underline;
        }

        .alert {
            font-size: 0.9rem;
            padding: 10px;
        }
    </style>
</head>

<body>
    <main>
        <div class="login-container">
            <h2>Login</h2>

            @if(session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session()->has('loginError'))
                <div class="alert alert-danger">{{ session('loginError') }}</div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <i class="fa fa-envelope"></i>
                    <input class="@error('email') is-invalid @enderror" 
                        type="email" 
                        name="email" 
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="input-group">
                    <i class="fa fa-lock"></i>
                    <input class="@error('password') is-invalid @enderror" 
                        type="password" 
                        name="password" 
                        placeholder="Password"
                        required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <button type="submit" class="btn-login">MASUK</button>
            </form>
            

            
        </div>
    </main>

    <script src="{{ asset('we-cycle-app/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
