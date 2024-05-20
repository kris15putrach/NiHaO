<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

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
    public function requestOtp(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:20',
        ]);

        $nomor = $request->input('nomor');

        // Hapus OTP sebelumnya untuk nomor yang sama
        Otp::where('nomor', $nomor)->delete();

        // Generate OTP dan simpan ke database
        $otp = rand(100000, 999999);
        $waktu = time();
        Otp::create([
            'nomor' => $nomor,
            'otp' => $otp,
            'waktu' => $waktu,
        ]);

        // Simpan nomor di session
        $request->session()->put('nomor', $nomor);

        // Kirim OTP melalui API Fonnte
        $response = Http::withHeaders([
            'Authorization' => '6VsLWJ2Fxey@W3RZ+Koz',
        ])->post('https://api.fonnte.com/send', [
            'target' => $nomor,
            'message' => "Your OTP: " . $otp,
        ]);

        // Arahkan pengguna ke halaman verifikasi OTP
        return redirect()->route('showVerifyForm');
    }


    public function showVerifyForm()
    {
        return view('verifikasi_otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|integer',
        ]);

        $nomor = $request->session()->get('nomor');
        $otp = $request->input('otp');

        $otpRecord = Otp::where('nomor', $nomor)->where('otp', $otp)->first();

        if ($otpRecord && (time() - $otpRecord->waktu <= 300)) {
            $request->session()->forget('nomor');  //kalo mau buat reset pasword bagian ini dicommand aja
            // aku liat di tabel akun gaada nomor hp mungkin ntar tambahin inputan buat no hpnya
            // terus kalo udah ada no hp nya bisa dibikin buat reset password by nomor hp

            return redirect()->route('reset');
        } elseif ($otpRecord) {
            // kalo mau kasih massage bagian ini
            return "OTP expired";
        } else {
            // kalo mau kasih massage bagian ini

            return "OTP salah";
        }
    }

    public function reset()
    {
        return view('reset_password');
    }
}

