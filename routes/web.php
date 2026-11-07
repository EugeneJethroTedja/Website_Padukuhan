<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmumController; // Import UmumController
use App\Http\Controllers\Admin\WisataAlamController; // Import semua controller admin
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\ProfilDesaController; // Mengoreksi sintaks namespace (dari -> menjadi \)
use App\Http\Controllers\Admin\UmkmDesaController; // Mengoreksi sintaks namespace (dari -> menjadi \)
use App\Http\Controllers\Admin\KesenianDesaController; // Mengoreksi sintaks namespace (dari -> menjadi \)

// --- Rute Bagian Umum ---
Route::get('/', [UmumController::class, 'index'])->name('home');

// Rute untuk Wisata Alam (Bagian Umum)
Route::get('/wisata-alam', [UmumController::class, 'daftarWisataAlam'])->name('wisata_alam.index.umum');
Route::get('/wisata-alam/{wisataAlam}', [UmumController::class, 'detailWisataAlam'])->name('wisata_alam.show.umum');

// Rute untuk Kegiatan (Bagian Umum)
Route::get('/kegiatan', [UmumController::class, 'daftarKegiatan'])->name('kegiatan.index.umum');
Route::get('/kegiatan/{kegiatan}', [UmumController::class, 'detailKegiatan'])->name('kegiatan.show.umum');

// Rute untuk Profil Desa (Bagian Umum)
Route::get('/profil-desa', [UmumController::class, 'daftarProfilDesa'])->name('profil_desa.index.umum');
Route::get('/profil-desa/{profilDesa}', [UmumController::class, 'detailProfilDesa'])->name('profil_desa.show.umum');


// Rute untuk UMKM Desa (Bagian Umum)
Route::get('/umkm-desa', [UmumController::class, 'daftarUmkmDesa'])->name('umkm_desa.index.umum');
Route::get('/umkm-desa/{umkmDesa}', [UmumController::class, 'detailUmkmDesa'])->name('umkm_desa.show.umum');

// Rute untuk Kesenian Desa (Bagian Umum)
Route::get('/kesenian-desa', [UmumController::class, 'daftarKesenianDesa'])->name('kesenian_desa.index.umum');
Route::get('/kesenian-desa/{kesenianDesa}', [UmumController::class, 'detailKesenianDesa'])->name('kesenian_desa.show.umum');


// --- Rute Bagian Admin ---
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Rute Resource untuk Wisata Alam (CRUD)
    Route::resource('wisata-alam', WisataAlamController::class);

    // Rute Resource untuk Kegiatan (CRUD)
    Route::resource('kegiatan', KegiatanController::class);

    // Rute Resource untuk Profil Desa (CRUD)
    Route::resource('profil-desa', ProfilDesaController::class);

    // Rute Resource untuk UMKM Desa (CRUD)
    Route::resource('umkm-desa', UmkmDesaController::class);

    // Rute Resource untuk Kesenian Desa (CRUD)
    Route::resource('kesenian-desa', KesenianDesaController::class);
});
