<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $olah = Akun::all();
        return view('kelolaakun', compact('olah'));
    }

    public function destroy($id)
    {
        $olah = Akun::find($id);
        if ($olah) {
            $olah->delete();
            return response()->json(['success' => 'Akun deleted successfully']);
        }
        return response()->json(['error' => 'Akun not found'], 404);
    }
}
