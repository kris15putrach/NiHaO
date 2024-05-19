<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unggah;

class UnggahController extends Controller
{
    public function unggah(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000', // max 5MB
            'pesan' => 'nullable|string',
        ]);

        $gambarPath = $request->file('gambar')->store('gambar', 'public');

        Unggah::create([
            'nama' => $request->nama,
            'gambar' => $gambarPath,
            'pesan' => $request->pesan,
        ]);

        return redirect('/komu')->with('success', 'Data berhasil diunggah.');
    }
}



