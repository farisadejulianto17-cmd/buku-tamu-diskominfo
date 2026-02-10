<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Wajib ditambahkan

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi!',
            'password.required' => 'Password tidak boleh kosong!',
        ]);

        // 2. Cek kecocokan di tabel users
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika berhasil, lempar ke dashboard
            return redirect()->intended(route('dashboard'));
        }

        // 3. Jika gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Proses logout admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}