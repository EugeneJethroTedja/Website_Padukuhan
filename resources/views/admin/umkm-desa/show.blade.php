@extends('admin.layouts.admin_app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center mb-4 p-4 rounded-3" style="background:#002575">
            <h2 class="text-white display-5 fw-bold">Detail UMKM</h2>
            <a class="btn btn-outline-light btn-lg px-4" href="{{ route('admin.umkm-desa.index') }}">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="card shadow-lg border-0 rounded-4 custom-card">
    <div class="card-header text-white py-3 rounded-top-4 custom-card-header" style="background: #002575">
        <h4 class="mb-0 fs-4 text-center">Informasi Detail UMKM</h4>
    </div>
    <div class="card-body p-5">
        <div class="row g-5 align-items-start">
            <div class="col-md-5">
                @if($umkmDesa->gambar)
                    <div class="image-detail-container mb-3 mb-md-0">
                        <img src="{{ asset('storage/umkm-desa/' . $umkmDesa->gambar) }}" alt="{{ $umkmDesa->nama_produk }}" class="img-fluid custom-detail-image-large">
                    </div>
                @else
                    <div class="text-center p-4 border rounded-3 bg-light text-muted" style="min-height: 300px; display: flex; align-items: center; justify-content: center;">
                        <p>Tidak ada gambar.</p>
                    </div>
                @endif
            </div>
            <div class="col-md-7">
                <div class="detail-section mb-4">
                    <label class="form-label mb-2 fw-semibold fs-5 text-primary-accent">Nama Produk:</label>
                    <p class="detail-text-display fs-4 fw-bold">{{ $umkmDesa->nama_produk }}</p>
                </div>

                <div class="detail-section mb-4">
                    <label class="form-label mb-2 fw-semibold fs-5 text-primary-accent">Nama UMKM:</label>
                    <p class="detail-text-display">{{ $umkmDesa->nama_umkm }}</p>
                </div>

                <div class="detail-section mb-4">
                    <label class="form-label mb-2 fw-semibold fs-5 text-primary-accent">Deskripsi Produk:</label>
                    <p class="detail-text-display">{{ $umkmDesa->deskripsi }}</p>
                </div>

                <div class="detail-section mb-4">
                    <label class="form-label mb-2 fw-semibold fs-5 text-primary-accent">Kontak:</label>
                    <p class="detail-text-display">{{ $umkmDesa->kontak ?? '-' }}</p>
                </div>

                <div class="detail-section">
                    <label class="form-label mb-2 fw-semibold fs-5 text-primary-accent">Tanggal Dibuat:</label>
                    <p class="detail-text-display small">{{ $umkmDesa->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div class="detail-section">
                    <label class="form-label mb-2 fw-semibold fs-5 text-primary-accent">Terakhir Diperbarui:</label>
                    <p class="detail-text-display small">{{ $umkmDesa->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Variabel Warna (Pastikan ini sesuai dengan admin_app.blade.php Anda) */
    :root {
        --primary-accent: #5C6F8D; /* Blue-Grey Dark - "Biru susu tua" yang elegan untuk aksen utama */
        --secondary-accent: #8FA8C7; /* Blue-Grey Light - Untuk aksen sekunder/hover */
        --heading-dark: #212529; /* Very dark almost black for main headings */
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
        background-color: var(--background-dark); /* Latar belakang body gelap */
        color: var(--text-light); /* Default text color diubah menjadi terang */
    }

    h2 {
        font-family: 'Playfair Display', serif;
    }

    /* Override Bootstrap primary button to match theme */
    .btn-primary {
        background-color: var(--primary-accent);
        border-color: var(--primary-accent);
        color: var(--text-light);
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: var(--secondary-accent);
        border-color: var(--secondary-accent);
        transform: translateY(-2px); /* Efek hover kecil */
        box-shadow: var(--shadow-light);
    }

    /* Tombol Kembali Outline */
    .btn-outline-light {
        color: var(--text-light);
        border-color: var(--text-light);
    }
    .btn-outline-light:hover {
        background-color: var(--text-light);
        color: var(--primary-accent);
        border-color: var(--text-light);
    }

    /* Custom Card Styling */
    .custom-card {
        border-radius: 1rem; /* Sudut lebih membulat */
        background-color: var(--background-light); /* Latar belakang kartu terang */
        box-shadow: var(--shadow-medium); /* Bayangan lebih kuat */
    }
    .custom-card-header {
        background-color: var(--primary-accent) !important; /* Warna header kartu */
        border-bottom: none;
        border-radius: 1rem 1rem 0 0 !important; /* Membulatkan hanya bagian atas */
    }

    /* Custom Form Control Styling (for general text display in details) */
    .form-label {
        font-weight: 600; /* Lebih tebal untuk label */
        color: var(--heading-dark); /* Warna teks heading untuk label */
    }

    /* Styling for the displayed text content */
    .detail-text-display {
        background-color: var(--secondary-bg-light);
        border: 1px solid var(--border-color);
        color: var(--text-dark); /* Warna teks tetap gelap karena latar belakangnya terang */
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 1.05rem;
        word-wrap: break-word; /* Untuk teks panjang */
        white-space: pre-wrap; /* Mempertahankan spasi dan baris baru */
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.05); /* Bayangan dalam untuk efek input */
    }

    /* Custom Image Styling for Detail Page - LARGE */
    .custom-detail-image-large {
        width: 100%; /* Lebar penuh dalam kolomnya */
        max-height: 450px; /* Tinggi maksimal yang lebih besar */
        object-fit: cover; /* Pastikan gambar proporsional dan mengisi ruang */
        border-radius: 0.75rem; /* Sudut membulat */
        box-shadow: var(--shadow-strong); /* Bayangan lebih kuat untuk gambar utama */
        border: 4px solid var(--secondary-accent); /* Border dengan warna aksen */
        transition: transform 0.3s ease; /* Efek transisi untuk hover */
    }
    .custom-detail-image-large:hover {
        transform: scale(1.02); /* Sedikit zoom saat hover */
    }

    /* Container for image to maintain aspect ratio/better control if needed */
    .image-detail-container {
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden; /* Sembunyikan overflow jika gambar terlalu besar untuk kontainer */
    }

    /* Specific styles for detail sections */
    .detail-section label.text-primary-accent {
        color: var(--primary-accent) !important; /* Warna aksen untuk label bagian detail, tetap pada warna aksen ini karena di atas latar belakang terang */
        font-size: 1.15rem; /* Ukuran font sedikit lebih besar untuk label */
    }
</style>
@endpush
