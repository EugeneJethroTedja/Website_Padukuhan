@extends('admin.layouts.admin_app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center mb-4 p-4 rounded-3" style="background:#002575">
            <h2 class="text-white display-5 fw-bold">Tambah Kesenian Baru</h2>
            <a class="btn btn-outline-light btn-lg px-4" href="{{ route('admin.kesenian-desa.index') }}">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show custom-alert-danger" role="alert">
        <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i> Whoops!</h5>
        <p>Ada beberapa masalah dengan input Anda:</p>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-lg border-0 rounded-4 custom-card">
    <div class="card-header text-white py-3 rounded-top-4 custom-card-header" style="background: #002575">
        <h4 class="mb-0 fs-4 text-center">Form Tambah Kesenian</h4>
    </div>
    <div class="card-body p-5">
        <form action="{{ route('admin.kesenian-desa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nama_kesenian" class="form-label mb-2 fw-semibold">Nama Kesenian:</label>
                        <div class="input-group input-group-lg custom-input-group">
                            <span class="input-group-text custom-input-group-text"><i class="fas fa-palette"></i></span>
                            <input type="text" name="nama_kesenian" id="nama_kesenian" class="form-control custom-form-control @error('nama_kesenian') is-invalid @enderror" placeholder="Contoh: Tari Reog, Gamelan" value="{{ old('nama_kesenian') }}">
                            @error('nama_kesenian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="deskripsi" class="form-label mb-2 fw-semibold">Deskripsi Lengkap:</label>
                        <div class="input-group input-group-lg custom-input-group">
                            <span class="input-group-text align-items-start custom-input-group-text"><i class="fas fa-align-left mt-2"></i></span>
                            <textarea class="form-control custom-form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" style="height:180px" name="deskripsi" placeholder="Jelaskan detail mengenai kesenian ini, termasuk sejarah dan ciri khas.">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="gambar" class="form-label mb-2 fw-semibold">Upload Gambar:</label>
                        <input type="file" name="gambar" id="gambar" class="form-control custom-form-control-file @error('gambar') is-invalid @enderror">
                        <small class="form-text text-muted mt-2">Ukuran maksimal: 2MB. Format yang didukung: JPG, PNG, GIF, SVG.</small>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 text-center mt-5">
                    <button type="submit" class="btn btn-primary btn-lg custom-btn-primary shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i> Tambahkan Kesenian
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
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
        background-color: var(--background-dark); /* Latar belakang body gelap */
        color: var(--text-dark); /* Default text color */
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

    /* Custom Form Control Styling */
    .custom-form-control {
        background-color: var(--secondary-bg-light);
        border: 1px solid var(--border-color);
        color: var(--text-dark);
        border-radius: 0.5rem;
        padding: 0.8rem 1.2rem; /* Padding lebih besar */
        font-size: 1.05rem; /* Ukuran font sedikit lebih besar */
    }
    .custom-form-control:focus {
        background-color: var(--secondary-bg-dark);
        border-color: var(--primary-accent);
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
    }
    .custom-form-control::placeholder {
        color: var(--text-muted);
        opacity: 0.7; /* Sedikit transparan */
    }

    /* Custom Input Group Styling */
    .custom-input-group .input-group-text {
        background-color: var(--primary-accent);
        border: 1px solid var(--primary-accent);
        color: var(--text-light);
        border-radius: 0.5rem 0 0 0.5rem;
        padding: 0.8rem 1.2rem;
    }
    .custom-input-group.input-group-lg .custom-input-group-text {
        padding: 0.8rem 1.2rem; /* Padding untuk ukuran besar */
    }
    .custom-input-group .form-control {
        border-left: none; /* Hilangkan border ganda */
    }

    /* File Input Styling */
    .custom-form-control-file {
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        background-color: var(--secondary-bg-light);
        color: var(--text-dark);
    }
    .custom-form-control-file:focus {
        border-color: var(--primary-accent);
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
    }

    /* Custom Alert Danger Styling */
    .custom-alert-danger {
        background-color: var(--danger-color);
        color: var(--text-light);
        border-color: var(--danger-color);
        border-radius: 0.75rem;
        box-shadow: var(--shadow-light);
        padding: 1.5rem; /* Padding lebih besar */
        font-size: 1.1rem;
    }
    .custom-alert-danger .btn-close {
        color: var(--text-light);
        filter: invert(1);
    }
    .custom-alert-danger .alert-heading {
        color: var(--text-light);
        font-size: 1.5rem;
    }
    .custom-alert-danger ul {
        margin-top: 0.75rem;
    }
</style>
@endpush
