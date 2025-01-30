@extends('layout.main')

@section('content')
<header class="navbar navbar-light bg-white shadow-sm" style="max-width: 428px; width: 100%;">
    {{-- Nav Header --}}
    <div class="container px-4 border-bottom">
        <div class="row">
            <div class="col py-3 d-flex align-items-center text-start">
                {{-- Tombol Kembali --}}
                <a href="{{ url('dashboard') }}" class="text-decoration-none">
                    <i class="bi bi-arrow-left me-3" style="font-size: 1.5rem; color: #1E90FF;"></i>
                </a>
                
                {{-- Judul Halaman --}}
                <h6 class="fw-bold m-0" style="letter-spacing: 1px; color: #2ECC71;">
                    @yield('transaction-title')
                </h6>
            </div>
        </div>
    </div>
</header>

@yield('transaction-content')
@endsection

@yield('scripts')
