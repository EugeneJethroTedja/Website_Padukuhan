<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KesenianDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kesenian',
        'deskripsi',
        'gambar',
    ];
}