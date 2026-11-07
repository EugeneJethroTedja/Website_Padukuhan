<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'nama_umkm',
        'deskripsi',
        'kontak',
        'gambar',
    ];
}