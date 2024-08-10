<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register', [
            'pageTitle' => 'Registrasi',
            'active' => '',
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => ['required'],
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['user_role'] = 'user';

        User::create($validatedData);

        return redirect('/login')->with('success', 'Akun berhasil dibuat, silahkan Log in!');
    }
}
