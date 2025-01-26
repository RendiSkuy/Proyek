<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Login We-Cycle
    </title>
    <meta content="" name="keywords" />
    <meta content="" name="description" />
    {{-- Typography --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,700;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    {{-- Template Stylesheet --}}
    <link href="{{ asset('we-cycle-app/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('we-cycle-app/bootstrap/css/by-silmy/login.css') }}" rel="stylesheet" />
    <!-- Font awesome Icon CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
    <main class="loginscreen">
        <div class="bulatgradasi">
        </div>
        <div class="boxlogin">
            @if(session()->has('success'))
            <div class="alert alert-success m-2" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if(session()->has('loginError'))
            <div class="alert alert-danger m-2" role="alert">
                {{ session('loginError') }}
            </div>
            @endif

            <form action="{{ route('store') }}" method="POST">
                @csrf
                <div class="input-icons">
                    <i class="fa fa-envelope icon"></i>
                    <input class="input-field @error('email') is-invalid @enderror" 
                        type="email" 
                        name="email" 
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-icons">
                    <i class="fa fa-key icon"></i>
                    <input class="input-field @error('password') is-invalid @enderror" 
                        type="password" 
                        name="password" 
                        placeholder="Password"
                        required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="tombol">
                    <button type="submit" class="btn1">MASUK</button>
                </div>
            </form>

            <p>Belum punya akun? <a href="{{ route('indexRegister') }}">Daftar</a></p>
        </div>
    </main>

    <script src="{{ asset('we-cycle-app/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>