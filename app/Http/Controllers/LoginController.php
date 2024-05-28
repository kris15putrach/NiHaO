<?php

// app/Http/Controllers/LoginController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

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
            $akun = Akun::where('nomor', $nomor)->first();

            if ($akun) {
                return redirect()->route('reset')->with('akun', $akun);
            } else {
                // If no matching user is found, show a specific message
                return "User with this phone number not found";
            }
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

    public function resetPassword(Request $request)
    {
        // Validate the new password and its confirmation
        $request->validate([
            'newPassword' => 'required|string|min:8|confirmed',
        ], [
            'newPassword.required' => 'Password baru wajib diisi.',
            'newPassword.min' => 'Password baru harus terdiri dari minimal 8 karakter.',
            'newPassword.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Retrieve the phone number from the session
        $nomor = $request->session()->get('nomor');

        // Find the corresponding user in the 'akuns' table using the phone number
        $akun = Akun::where('nomor', $nomor)->first();

        if ($akun) {
            // Update the user's password after hashing it
            $akun->password = bcrypt($request->input('newPassword'));
            $akun->save();

            // Clear the phone number from the session
            $request->session()->forget('nomor');

            // Flash a success message to the session
            session()->flash('status', 'Password berhasil direset. Silakan login dengan password baru Anda.');

            // Redirect the user to the login page with a success message
            return redirect()->route('login');
        } else {
            // Flash an error message to the session
            session()->flash('error', 'Pengguna dengan nomor telepon ini tidak ditemukan.');

            // If no matching user is found, show an error message
            return redirect()->back();
        }
    }




    public function lupa()
    {
        return view('lupapassword');
    }
}



