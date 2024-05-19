<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'username',
        'comment',
        'updated_at', // Pastikan nama kolom sesuai dengan yang ada di database
        'created_at',
    ];
}

