<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unggah;
use App\Models\Comment;

class KomunitasController extends Controller
{
    public function index()
    {
        $posts = Unggah::all(); // Mengambil semua data dari tabel unggah
        return view('komunitas', compact('posts'));

    }

    public function storeComment(Request $request)
{
    $request->validate([
        'post_id' => 'required',
        'comment' => 'required',
    ]);

    $comment = new Comment();
    $comment->post_id = $request->post_id;
    $comment->username = session('username'); // Mengambil username dari session
    $comment->comment = $request->comment;
    $comment->save();

    return redirect()->back()->with('success', 'Komentar berhasil disimpan');
}
}

