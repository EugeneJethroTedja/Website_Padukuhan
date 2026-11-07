@extends('admin.layouts.admin_app')

@section('content')
<div class="dashboard-header" style="color: black">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang di panel administrasi Padukuhan Kerjo. Anda dapat mengelola berbagai konten di sini.</p>
</div>

<div class="row mt-4">
    {{-- Wisata Alam Card --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="dashboard-card card-wisata">
            <div class="card-icon-wrapper">
                <i class="fas fa-mountain card-main-icon"></i>
            </div>
            <div class="card-body-content">
                <h3>Wisata Alam</h3>
                <p class="total-item">{{ \App\Models\WisataAlam::count() }}</p>
                <p class="card-text-desc">Kelola daftar tempat wisata alam.</p>
            </div>
            <a href="{{ route('admin.wisata-alam.index') }}" class="btn btn-kelola">
                Kelola Sekarang <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>

    {{-- Kegiatan Card --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="dashboard-card card-kegiatan">
            <div class="card-icon-wrapper">
                <i class="fas fa-calendar-alt card-main-icon"></i>
            </div>
            <div class="card-body-content">
                <h3>Kegiatan</h3>
                <p class="total-item">{{ \App\Models\Kegiatan::count() }}</p>
                <p class="card-text-desc">Kelola jadwal dan deskripsi kegiatan padukuhan.</p>
            </div>
            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-kelola">
                Kelola Sekarang <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>

    {{-- UMKM Desa Card --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="dashboard-card card-umkm">
            <div class="card-icon-wrapper">
                <i class="fas fa-store card-main-icon"></i>
            </div>
            <div class="card-body-content">
                <h3>UMKM Kerjo</h3>
                <p class="total-item">{{ \App\Models\UmkmDesa::count() }}</p>
                <p class="card-text-desc">Kelola daftar produk UMKM lokal.</p>
            </div>
            <a href="{{ route('admin.umkm-desa.index') }}" class="btn btn-kelola">
                Kelola Sekarang <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>

    {{-- Kesenian Desa Card --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="dashboard-card card-kesenian">
            <div class="card-icon-wrapper">
                <i class="fas fa-palette card-main-icon"></i>
            </div>
            <div class="card-body-content">
                <h3>Kesenian Kerjo</h3>
                <p class="total-item">{{ \App\Models\KesenianDesa::count() }}</p>
                <p class="card-text-desc">Kelola informasi kesenian dan budaya padukuhan.</p>
            </div>
            <a href="{{ route('admin.kesenian-desa.index') }}" class="btn btn-kelola">
                Kelola Sekarang <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>

    {{-- Profil Desa Card --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="dashboard-card card-profil">
            <div class="card-icon-wrapper">
                <i class="fas fa-info-circle card-main-icon"></i>
            </div>
            <div class="card-body-content">
                <h3>Profil Kerjo</h3>
                {{-- Untuk profil desa, tidak ada "total item", jadi kita gunakan placeholder untuk menjaga tinggi --}}
                <p class="total-item-placeholder">&nbsp;</p> <p class="card-text-desc">Ubah sejarah, visi, dan misi padukuhan.</p>
            </div>
            <a href="{{ route('admin.profil-desa.index') }}" class="btn btn-kelola">
                Kelola Sekarang <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>
@endsection