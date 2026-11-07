@extends('admin.layouts.admin_app')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h2 class="fw-bold display-5" style="color: black">Profil Padukuhan</h2>
        @if(\App\Models\ProfilDesa::count() == 0)
            <a class="btn btn-outline-light btn-lg px-4 custom-hover-effect" href="{{ route('admin.profil-desa.create') }}">
                <i class="fas fa-plus-circle me-2"></i> Tambah Profil Desa Baru
            </a>
        @endif
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show custom-alert-success" role="alert">
        <h5 class="alert-heading"><i class="fas fa-check-circle me-2"></i> Berhasil!</h5>
        <p class="mb-0">{{ $message }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@forelse ($profilDesas as $profilDesa)
<div class="card shadow-lg border-0 rounded-4 custom-card mb-5">
    {{-- Hero Section --}}
    <div class="profile-hero-image-container">
        @if($profilDesa->gambar_desa)
            <img src="{{ asset('images/balai5.jpg') }}" alt="Foto Desa" 
                class="img-fluid profile-hero-image" 
                style="height: 300px; object-fit: cover; width: 100%;">
        @else
            <div class="profile-hero-placeholder d-flex flex-column justify-content-center align-items-center">
                <i class="fas fa-image fa-4x mb-3"></i>
                <span>Profil Desa</span>
            </div>
        @endif

        <div class="profile-hero-overlay">
            <h1 class="profile-hero-title">{{ $profilDesa->nama_desa }}</h1>
        </div>
    </div>

    {{-- Konten Detail --}}
    <div class="card-body px-md-5 px-3 py-4">

        {{-- Nama Desa --}}
        <div class="mb-5">
            <h4 class="section-title text-center">Informasi Umum</h4>
            <div class="detail-block-lg mb-4">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-city me-3 icon-md"></i>
                    <h5 class="mb-0">Nama Padukuhan:</h5>
                </div>
                <p class="detail-text-display-lg">{{ $profilDesa->nama_desa }}</p>
            </div>
        </div>

        {{-- Sejarah --}}
        <div class="mb-5">
            <h4 class="section-title text-center">Sejarah Padukuhan</h4>
            <div class="detail-block">
                <p class="detail-text-display">{{ $profilDesa->sejarah }}</p>
            </div>
        </div>

        {{-- Visi Misi --}}
        <div class="mb-5">
            <h4 class="section-title text-center">Visi & Misi</h4>
            <div class="detail-block">
                <p class="detail-text-display">{{ $profilDesa->visi_misi }}</p>
            </div>
        </div>

        {{-- Lokasi --}}
        <div class="mb-5">
            <h4 class="section-title text-center">Lokasi</h4>
            <div class="detail-block">
                <p class="detail-text-display">
                    Kerjo, Ngestirejo, Kec. Tanjungsari, Kabupaten Gunungkidul, DIY 55881
                </p>
            </div>
        </div>

        {{-- Galeri Foto --}}
        <div class="mb-5">
            <h4 class="section-title text-center">Galeri Foto</h4>
            <div class="row g-3 justify-content-center">
                @foreach (['balai5.jpg', 'warga3.jpg', 'warga6.jpg', 'warga2.jpg'] as $img)
                    <div class="col-6 col-md-4 col-lg-3">
                        <img src="{{ asset("images/$img") }}" alt="Galeri" class="img-fluid gallery-thumb">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Tanggal --}}
        <div class="row mt-5 pt-4 border-top">
            <div class="col-md-6 detail-block-sm mb-3">
                <label><i class="fas fa-clock me-2"></i> Dibuat:</label>
                <p class="detail-text-display-sm">{{ $profilDesa->created_at->format('d F Y, H:i') }}</p>
            </div>
            <div class="col-md-6 detail-block-sm mb-3">
                <label><i class="fas fa-history me-2"></i> Diperbarui:</label>
                <p class="detail-text-display-sm">{{ $profilDesa->updated_at->format('d F Y, H:i') }}</p>
            </div>
        </div>

        {{-- Tombol Edit --}}
        <div class="text-center mt-4">
            <a href="{{ route('admin.profil-desa.edit', $profilDesa->id) }}" class="btn btn-primary btn-lg">
                <i class="fas fa-edit me-2"></i> Edit Profil
            </a>
        </div>
    </div>
</div>
@empty
    <div class="text-center py-5 custom-card shadow-lg border-0 rounded-4">
        <i class="fas fa-box-open fa-3x mb-3 text-muted-dark"></i>
        <p class="lead text-muted-dark">Belum ada profil padukuhan yang dibuat.</p>
        <a class="btn btn-primary mt-3 custom-btn-primary custom-hover-effect" href="{{ route('admin.profil-desa.create') }}">
            <i class="fas fa-plus-circle me-2"></i> Tambah Profil Padukuhan Pertama
        </a>
    </div>
@endforelse
@endsection


@push('styles')
<style>
    /* Variabel Warna (Pastikan ini sesuai dengan admin_app.blade.php Anda) */
    :root {
        --primary-accent: #5C6F8D; /* Blue-Grey Dark - "Biru susu tua" yang elegan untuk aksen utama */
        --secondary-accent: #8FA8C7; /* Blue-Grey Light - Untuk aksen sekunder/hover */
        --heading-dark: #212529; /* Warna gelap untuk heading */
        --text-dark: #343a40; /* Warna teks gelap */
        --text-muted: #6c757d; /* Warna teks muted */
        --text-light: #f8f9fa; /* Warna teks terang */
        --background-dark: #2c3e50; /* Latar belakang gelap */
        --background-light: #ecf0f1; /* Latar belakang terang */
        --secondary-bg-light: #f0f2f5; /* Latar belakang input ringan */
        --secondary-bg-dark: #e0e3e8; /* Latar belakang input sedikit lebih gelap saat fokus */
        --border-color: #ced4da; /* Warna border standar */
        --danger-color: #dc3545; /* Warna bahaya */
        --success-color: #28a745; /* Warna sukses */
        --info-color: #17a2b8; /* Warna info */
        --primary-rgb: 92, 111, 141; /* RGB dari primary-accent */
        --danger-rgb: 220, 53, 69; /* RGB dari danger-color */
        --shadow-light: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Bayangan terang */
        --shadow-medium: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.2); /* Bayangan sedang */
        --shadow-strong: 0 1rem 2rem rgba(0, 0, 0, 0.25); /* Bayangan kuat */
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background-color: var(--background-dark);
        color: var(--text-light); /* Teks utama di body menjadi terang */
    }

    h2 {
        font-family: 'Playfair Display', serif;
        color: var(--text-light);
    }

    /* Custom Card Styling */
    .custom-card {
        border-radius: 1rem;
        background-color: var(--background-light);
        box-shadow: var(--shadow-medium);
        overflow: hidden; /* Penting untuk gambar hero agar sudut membulat */
    }

    /* Card Header for Data Profil Desa */
    .custom-card-header {
        background-color: var(--primary-accent) !important;
        border-bottom: none;
        border-radius: 1rem 1rem 0 0 !important;
        color: var(--text-light);
    }
    .custom-card-header h4 {
        font-family: 'Playfair Display', serif;
        font-weight: bold;
    }

    /* Profile Hero Image Section */
    .profile-hero-image-container {
        position: relative;
        width: 100%;
        height: 450px; /* Tinggi yang lebih besar untuk efek hero */
        overflow: hidden;
        border-bottom: 5px solid var(--primary-accent); /* Border tebal di bawah hero */
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--background-dark); /* Fallback background */
    }

    .profile-hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Memastikan gambar mengisi area tanpa terdistorsi */
        filter: brightness(0.7); /* Sedikit gelap agar teks lebih menonjol */
        transition: transform 0.5s ease;
    }

    .profile-hero-image-container:hover .profile-hero-image {
        transform: scale(1.05); /* Efek zoom in saat hover */
    }

    .profile-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 50%); /* Gradient gelap di bawah */
        display: flex;
        align-items: flex-end; /* Posisikan teks di bagian bawah */
        justify-content: center;
        padding-bottom: 2.5rem; /* Padding lebih besar untuk judul */
        text-align: center;
    }

    .profile-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 4rem; /* Font sangat besar untuk judul */
        color: var(--text-light);
        text-shadow: 0px 5px 8px rgba(0, 0, 0, 0.6); /* Bayangan teks yang lebih kuat */
        width: 90%;
        line-height: 1.1;
        letter-spacing: 0.05em; /* Sedikit spasi antar huruf */
    }

    .profile-hero-placeholder {
        background: linear-gradient(45deg, var(--primary-accent), var(--secondary-accent));
        height: 100%;
        width: 100%;
        flex-direction: column;
        color: var(--text-light);
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        text-shadow: 0px 2px 4px rgba(0,0,0,0.3);
    }
    .profile-hero-placeholder i {
        color: rgba(var(--text-light-rgb), 0.7); /* Menggunakan alpha untuk ikon */
    }

    /* Section Titles */
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem; /* Ukuran font sedikit lebih besar */
        font-weight: 700;
        color: var(--primary-accent);
        position: relative;
        padding-bottom: 0.8rem; /* Padding bawah lebih besar */
        margin-bottom: 3rem !important; /* Spasi lebih besar */
    }
    .section-title::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 100px; /* Garis bawah yang lebih panjang */
        height: 5px; /* Lebih tebal */
        background-color: var(--secondary-accent);
        border-radius: 3px;
    }

    /* Detail Blocks */
    .detail-block {
        background-color: var(--secondary-bg-light);
        border-left: 6px solid var(--secondary-accent); /* Border lebih tebal */
        border-radius: 0.75rem;
        padding: 1.8rem 2.2rem; /* Padding lebih nyaman */
        box-shadow: var(--shadow-light);
        transition: all 0.3s ease;
    }
    .detail-block:hover {
        transform: translateY(-7px); /* Efek hover yang lebih kentara */
        box-shadow: var(--shadow-medium);
        border-color: var(--primary-accent); /* Warna border berubah saat hover */
    }
    .detail-block h5 {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.25rem; /* Ukuran label sedikit lebih besar */
        color: var(--text-muted); /* Tetap muted */
        font-weight: 600;
    }
    .detail-block .icon-md {
        font-size: 2rem; /* Ukuran ikon lebih besar */
        color: var(--primary-accent);
    }
    .text-muted-dark {
        color: var(--text-dark) !important; /* Warna teks muted yang lebih gelap, untuk kontras di latar terang */
    }

    /* Larger Detail Text Display (Nama Desa) */
    .detail-text-display-lg {
        background-color: var(--background-light); /* Latar belakang terang */
        border: 2px dashed var(--secondary-accent); /* Border dashed untuk tampilan unik */
        color: var(--heading-dark); /* Teks lebih gelap untuk kontras */
        border-radius: 0.75rem;
        padding: 1.5rem 2.5rem; /* Padding lebih besar */
        font-size: 2.5rem; /* Font lebih besar */
        word-wrap: break-word;
        white-space: pre-wrap;
        box-shadow: inset 0 2px 7px rgba(0,0,0,0.1);
        text-align: center; /* Teks di tengah */
        font-family: 'Playfair Display', serif; /* Font lebih elegan */
        line-height: 1.3;
        letter-spacing: 0.02em;
    }

    /* Regular Detail Text Display */
    .detail-text-display {
        background-color: var(--background-light);
        border: 1px solid var(--border-color);
        color: var(--text-dark); /* Teks gelap di latar terang */
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 1.05rem;
        word-wrap: break-word;
        white-space: pre-wrap;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
    }
    .detail-text-display-sm { /* For timestamps */
        background-color: var(--background-light);
        border: 1px solid var(--border-color);
        color: var(--text-dark); /* Teks gelap di latar terang */
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        word-wrap: break-word;
        white-space: pre-wrap;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
    }

    /* Smaller Detail Text Display (Timestamps) */
    .detail-block-sm {
        background-color: var(--secondary-bg-light);
        border-left: 4px solid var(--info-color); /* Warna info untuk timestamps */
        border-radius: 0.6rem; /* Sedikit lebih bulat */
        padding: 1.2rem 1.8rem; /* Padding lebih nyaman */
        box-shadow: var(--shadow-light);
        transition: all 0.3s ease;
    }
    .detail-block-sm:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-medium);
        border-color: var(--primary-accent);
    }
    .detail-block-sm label {
        color: var(--primary-accent) !important; /* Warna label info, diubah ke primary-accent */
        font-size: 1.05rem;
        font-weight: 700;
    }
    .detail-block-sm .fas {
        font-size: 1.3rem;
        color: var(--primary-accent); /* Warna ikon diselaraskan */
    }

    /* Gallery Section */
    .gallery-thumb {
        border: 2px solid var(--border-color);
        border-radius: 0.75rem;
        object-fit: cover;
        width: 100%;
        height: 120px; /* Tinggi tetap untuk thumbnail agar lebih menonjol */
        transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }
    .gallery-thumb:hover {
        transform: scale(1.05);
        border-color: var(--primary-accent);
        box-shadow: var(--shadow-medium);
    }

    /* Custom Buttons (Ensuring hover effects) */
    .btn-primary {
        background-color: var(--primary-accent);
        border-color: var(--primary-accent);
        color: var(--text-light);
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: var(--secondary-accent);
        border-color: var(--secondary-accent);
        transform: translateY(-2px);
        box-shadow: var(--shadow-light);
    }

    .btn-outline-light {
        color: var(--text-light);
        border-color: var(--text-light);
        transition: all 0.3s ease;
    }
    .btn-outline-light:hover {
        background-color: var(--text-light);
        color: var(--primary-accent);
        border-color: var(--text-light);
        transform: translateY(-2px);
        box-shadow: var(--shadow-light);
    }

    /* Generic hover effect for other interactive elements */
    .custom-hover-effect:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-light);
    }

    /* Custom Alert Styling */
    .custom-alert-success {
        background-color: var(--success-color);
        color: var(--text-light);
        border-color: var(--success-color);
        border-radius: 0.75rem;
        box-shadow: var(--shadow-light);
        padding: 1.5rem;
        font-size: 1.1rem;
    }
    .custom-alert-success .btn-close {
        color: var(--text-light);
        filter: invert(1);
    }
    .custom-alert-success .alert-heading {
        color: var(--text-light);
        font-size: 1.5rem;
    }

    /* Placeholder for no data */
    .text-center.py-5.custom-card {
        padding-top: 5rem !important;
        padding-bottom: 5rem !important;
        background-color: var(--background-light);
        color: var(--text-dark); /* Mengubah warna teks agar terlihat di latar terang */
    }
    .text-center.py-5.custom-card .fas {
        color: var(--text-muted) !important; /* Warna ikon diselaraskan */
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) { /* Medium devices (tablets) */
        .profile-hero-image-container {
            height: 350px;
        }
        .profile-hero-title {
            font-size: 3rem;
        }
        .section-title {
            font-size: 2rem;
            margin-bottom: 2.5rem !important;
        }
        .detail-text-display-lg {
            font-size: 1.8rem;
            padding: 1.2rem 2rem;
        }
        .detail-block {
            padding: 1.5rem 1.8rem;
        }
        .detail-block h5 {
            font-size: 1.15rem;
        }
        .detail-block .icon-md {
            font-size: 1.7rem;
        }
        .gallery-thumb {
            height: 100px;
        }
    }

    @media (max-width: 767.98px) { /* Small devices (phones) */
        .profile-hero-image-container {
            height: 250px;
        }
        .profile-hero-title {
            font-size: 2rem;
            padding-bottom: 1.5rem;
        }
        .section-title {
            font-size: 1.6rem;
            margin-bottom: 2rem !important;
        }
        .section-title::after {
            width: 70px;
            height: 3px;
        }
        .detail-text-display-lg {
            font-size: 1.3rem;
            padding: 1rem 1.5rem;
        }
        .detail-block {
            padding: 1.2rem 1.5rem;
        }
        .detail-block h5 {
            font-size: 1rem;
        }
        .detail-block .icon-md {
            font-size: 1.5rem;
        }
        .gallery-thumb {
            height: 80px;
        }
        .btn-lg {
            font-size: 1rem;
            padding: 0.8rem 1.5rem;
        }
    }
</style>
@endpush
