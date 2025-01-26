<?php

namespace App\Http\Controllers\UserApp;

use App\Models\User;
use App\Models\Poin;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('user-app/register');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|confirmed|min:6|max:255'
    ]);

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password'])
    ]);

    $nasabah = Nasabah::create([
        'user_id' => $user->id,
        'nama' => $validatedData['name'],
        'status' => 'active'
    ]);

    return redirect('/login')->with('success', 'Registration successful!');
}
}