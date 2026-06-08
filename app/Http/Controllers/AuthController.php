<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Jika sudah login, langsung ke leaderboard
        if (session('is_admin')) {
            return redirect()->route('leaderboard');
        }
        
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Autentikasi hardcoded sederhana (tanpa database)
        // Username: admin, Password: admin123
        if ($request->username === 'admin' && $request->password === 'admin123') {
            session(['is_admin' => true]);
            $request->session()->regenerate(); // Mencegah Session Fixation
            
            return redirect()->route('leaderboard');
        }

        // Pesan error generik
        return back()->withErrors([
            'login' => 'Kredensial yang diberikan tidak sesuai.',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
