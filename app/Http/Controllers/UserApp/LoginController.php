<?php

namespace App\Http\Controllers\UserApp;

use App\Models\Poin;
use App\Models\Nasabah;
use App\Models\TukarPoin;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('user-app/login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            $user = Auth::user();
            $nasabah = Nasabah::where('user_id', $user->id)->first();
    
            if (!$nasabah) {
                // Create nasabah if not exists
                $nasabah = Nasabah::create([
                    'user_id' => $user->id,
                    'nama' => $user->name,
                    'status' => 'active'
                ]);
    
                // Create initial poin record
                Poin::create([
                    'nasabah_id' => $nasabah->id,
                    'jumlah' => 0
                ]);
            }
    
            return redirect()->intended('dashboard');
        }
    
        return back()->with('loginError', 'Invalid credentials.');
    }
    
    public function login()
    {
        $user = Auth::user();
        $nasabah = Nasabah::where('user_id', $user->id)->first();
        $point = Poin::where('nasabah_id', $nasabah->id)->first();
        $transactions = Transaksi::where('nasabah_id', $nasabah->id)
            ->latest()
            ->limit(3)
            ->get();
        $tukar_poin = TukarPoin::where('nasabah_id', $nasabah->id)->count();
    
        return view('user-app/dashboard', compact(
            'user',
            'point',
            'transactions',
            'tukar_poin'
        ));
    }
}
