<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return view('register');

        // 
    }

    public function login(Request $request)
    {
        return view('login');
    }

    public function doRegister(Request $request)
    {
        // validasi request (inputan)
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'max:50', 'email', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        // memasukkan request (inputan) ke dalam database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // me-loginkan user wkwk
        Auth::login($user);

        // mengarahkan ke home setelah berhasil regist
        return redirect('/home');
    }

    public function doLogin(Request $request)
    {
        // validasi request (inputan)
        $credentials = $request->validate([
            'email' => ['required', 'string', 'max:50', 'email'],
            'password' => ['required', Rules\Password::defaults()]
        ]);

        // validasi apakah data request (input) sesuai dengan database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        // error jika terdapat kesahalan data pada database dengan request atau inputan data
        return back()->withErrors([
            'email' => 'Email and Password are invalid'
        ])->onlyInput('email');
    }

    // function untuk logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
