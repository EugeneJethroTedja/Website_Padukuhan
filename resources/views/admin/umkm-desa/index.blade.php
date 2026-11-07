@extends('admin.layouts.admin_app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark display-5 fw-bold">Daftar UMKM Padukuhan</h2>
            <a class="btn btn-outline-light btn-lg px-4" href="{{ route('admin.umkm-desa.create') }}" style="background: #5297ff">
                <i class="fas fa-plus-circle me-2"></i> Tambah UMKM Baru
            </a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show custom-alert-success" role="alert">
        <h5 class="alert-heading"><i class="fas fa-check-circle me-2"></i> Berhasil!</h5>
        <p class="mb-0">{{ $message }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-lg border-0 rounded-4 custom-card">
    <div class="card-header text-white py-3 rounded-top-4 custom-card-header d-flex justify-content-between align-items-center" style="background: #002575">
        <h4 class="mb-0 fs-4 text-center">Data UMKM Padukuhan</h4>
        {{-- Form Pencarian --}}
        <div class="col-md-4">
            <form action="{{ route('admin.umkm-desa.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2 custom-form-control" placeholder="Cari nama produk/UMKM..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary custom-btn-primary">
                    <i class="fas fa-search"></i>
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.umkm-desa.index') }}" class="btn btn-secondary custom-btn-secondary ms-2">
                        <i class="fas fa-redo"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle custom-table">
                <thead class="table-primary custom-table-thead">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Nama UMKM</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Kontak</th>
                        <th scope="col" width="280px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($umkmDesas as $umkmDesa)
                    <tr>
                        <td class="text-center">{{ ++$i }}</td>
                        <td>
                            @if($umkmDesa->gambar)
                                <img src="{{ asset('storage/umkm-desa/' . $umkmDesa->gambar) }}" alt="{{ $umkmDesa->nama_produk }}" class="img-thumbnail table-img custom-table-img">
                            @else
                                <img src="https://placehold.co/70x50/cccccc/333333?text=No+Image" alt="No Image" class="img-thumbnail table-img custom-table-img">
                            @endif
                        </td>
                        <td>{{ $umkmDesa->nama_produk }}</td>
                        <td>{{ $umkmDesa->nama_umkm }}</td>
                        <td>{{ Str::limit($umkmDesa->deskripsi, 100) }}</td>
                        <td>{{ $umkmDesa->kontak ?? '-' }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.umkm-desa.destroy', $umkmDesa->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus UMKM ini?');">
                                <a class="btn btn-info btn-sm mb-1 custom-action-btn" href="{{ route('admin.umkm-desa.show', $umkmDesa->id) }}">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a class="btn btn-primary btn-sm mb-1 custom-action-btn" href="{{ route('admin.umkm-desa.edit', $umkmDesa->id) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mb-1 custom-action-btn">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-box-open fa-2x d-block mb-2 text-muted"></i>
                            <p class="lead text-muted">Tidak ada data UMKM padukuhan yang ditemukan.</p>
                            <a class="btn btn-primary mt-3 custom-btn-primary" href="{{ route('admin.umkm-desa.create') }}">Tambah UMKM Pertama</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $umkmDesas->links('pagination::bootstrap-5') !!}
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

    /* Custom Alert Success Styling (Tambahan) */
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

    /* Current Image Styling for Edit Page */
    .custom-current-image {
        max-width: 200px; /* Batasi lebar gambar */
        height: auto;
        border-radius: 0.75rem; /* Sudut membulat */
        box-shadow: var(--shadow-light); /* Bayangan halus */
        border: 2px solid var(--border-color); /* Border ringan */
        object-fit: cover; /* Pastikan gambar proporsional */
    }

    /* Custom Table Styling */
    .custom-table {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.75rem; /* Sudut membulat untuk tabel */
        overflow: hidden; /* Penting untuk sudut membulat */
    }

    .custom-table-thead th {
        background-color: var(--primary-accent); /* Warna header tabel */
        color: var(--text-light);
        font-weight: bold;
        padding: 1rem;
        border-bottom: 2px solid var(--primary-accent);
    }

    .custom-table tbody tr {
        background-color: var(--background-light);
        transition: background-color 0.2s ease;
    }
    .custom-table tbody tr:hover {
        background-color: var(--secondary-bg-light); /* Efek hover pada baris */
    }

    .custom-table td {
        padding: 1rem;
        border: 1px solid var(--border-color); /* Border antar sel */
    }

    .custom-table-img {
        max-width: 100px; /* Lebar gambar thumbnail di tabel */
        max-height: 70px;
        border-radius: 0.5rem;
        object-fit: cover;
        box-shadow: var(--shadow-light);
    }

    .custom-action-btn {
        margin-bottom: 0.5rem; /* Jarak antar tombol aksi */
        width: 80px; /* Lebar seragam untuk tombol aksi */
    }
    .custom-action-btn .fas {
        margin-right: 0.25rem;
    }
</style>
@endpush
