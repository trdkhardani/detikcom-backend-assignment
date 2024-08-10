<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view('auth.login', [
            'pageTitle' => 'Login',
            'active' => 'login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth()->user()->user_role === 'admin') { // if the role is admin, redirect to /admin/dashboard
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/dashboard'); // if the role is user, redirect to /dashboard
        }

        return back()->with('loginError', 'Username atau Password salah');
    }
}
