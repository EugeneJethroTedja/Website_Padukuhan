<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkm_desas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('nama_umkm');
            $table->text('deskripsi');
            $table->string('kontak')->nullable(); // No telepon/media sosial
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm_desas');
    }
};