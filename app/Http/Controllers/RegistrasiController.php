<?php

// app/Http/Controllers/RegistrasiController.php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class RegistrasiController extends Controller
{
    public function daftar(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:akuns',
            'nomor' => 'required|string|max:20',
            'username' => 'required|unique:akuns',
            'password' => 'required|min:6',
            'konfirmasi_password' => 'required|same:password',
            'role' => 'required|in:Pembudidaya,Komunitas',
        ]);

        $akun = Akun::create([
            'email' => $request->email,
            'nomor' => $request ->nomor,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);


        return redirect()->back()->with('success', 'Akun berhasil didaftarkan!');
    }
}
