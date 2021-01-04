<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $user =  User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->push('id', $user->id);
                $request->session()->push('name', $user->name);
                return redirect('/');
            }
        }
        return redirect('/login')->with(['type' => 'danger', 'message' => 'Email atau password salah']);
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function prosesRegister(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'unique:users,email'],
            'name' => ['required', 'string', 'max:256'],
            'password' => ['required']
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'last_seen' => date('Y-m-d h:i:s')
        ]);
        return redirect('/login')->with(['type' => 'success', 'message' => 'Berhasil mendaftar']);
    }

}
