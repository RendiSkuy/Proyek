<?php

namespace App\Http\Controllers\UserApp;

use App\Models\Poin;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return view('user-app.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $nasabah = Nasabah::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make('defaultpassword'),
                    'status' => 'active',
                ]
            );

            Poin::firstOrCreate(['nasabah_id' => $nasabah->id], ['jumlah' => 0]);

            return redirect()->route('dashboard');
        }

        return back()->with('loginError', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Menampilkan halaman dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $nasabah = Nasabah::where('user_id', $user->id)->first();
        $poin = Poin::where('nasabah_id', $nasabah->id)->first();

        return view('user-app.dashboard', compact('user', 'nasabah', 'poin'));
    }
}
