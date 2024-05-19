<?php

// app/Http/Controllers/LoginController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Menyimpan username ke dalam session
            $request->session()->put('username', $request->username);
            $request->session()->put('last_activity', time());

            // Redirect ke halaman beranda pembudidaya
            return redirect()->intended('/beranda_pembudidaya');
        }

        return redirect()->back()->withErrors(['msg' => 'Username atau password salah']);
    }
}
