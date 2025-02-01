<?php

namespace App\Http\Controllers\UserApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Nasabah;

class NasabahLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan view ini ada di resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba login menggunakan guard 'nasabah'
        if (Auth::guard('nasabah')->attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . Auth::guard('nasabah')->user()->nama);
        }

        return back()->with('loginError', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::guard('nasabah')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
