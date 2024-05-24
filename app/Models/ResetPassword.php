<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nomor' => 'required|exists:akuns,nomor',
            'password' => 'required|min:6|confirmed',
        ];
    }
}