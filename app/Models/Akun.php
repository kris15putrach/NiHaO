<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $table = 'akuns';

    protected $fillable = ['email', 'username', 'password', 'role', 'nomor'];

    public $timestamps = true;
}