<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unggah extends Model
{
    protected $table = 'unggah';
    protected $fillable = ['nama', 'gambar', 'pesan'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
