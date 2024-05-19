<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function destroy($id)
    {
        Comment::destroy($id);
        return redirect('/kelolakomu')->with('success', 'Comment deleted successfully.');
    }
}
