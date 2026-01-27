<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // 1. Menampilkan Halaman Login
    // Sesuai route: Route::get('/login', [..., 'showLogin'])
    // Menampilkan Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // PROSES LOGIN (BACKEND REAL)
    public function authenticate(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek ke Database
        if (Auth::attempt($credentials)) {
            // Jika berhasil:
            $request->session()->regenerate(); // Regenerate session ID (keamanan)

            // Redirect ke dashboard
            return redirect()->route('dashboard.index')
                ->with('success', 'Login Berhasil! Selamat datang Admin.');
        }

        // 3. Jika Gagal Login
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // PROSES LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah logout.');
    }
}
