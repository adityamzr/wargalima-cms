<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only(['username', 'password']);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                notify()->success('Selamat Datang di Wargalima CMS!');
                return redirect('/dashboard');
            }

            return back()->with('error', 'Invalid credentials.');
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());

            return back()->with('error', 'Something went wrong. Please try again later.');
        }
        
    }

    public function logout() {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }
}
