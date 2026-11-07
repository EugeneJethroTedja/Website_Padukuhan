@extends('admin.layouts.admin_app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">Daftar Wisata Alam</h2> <a class="btn btn-success" href="{{ route('admin.wisata-alam.create') }}" style="background: #5297ff">
                <i class="fas fa-plus-circle me-2"></i> Tambah Wisata Alam Baru
            </a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p class="mb-0">{{ $message }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-lg border-0 rounded-4 custom-card">
    <div class="card-header text-white py-3 rounded-top-4 custom-card-header d-flex justify-content-between align-items-center" style="background: #002575">
        <h4 class="mb-0">Data Wisata Alam</h4>
        {{-- Form Pencarian --}}
        <div class="col-md-4">
            <form action="{{ route('admin.wisata-alam.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari judul wisata..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.wisata-alam.index') }}" class="btn btn-secondary ms-2">
                        <i class="fas fa-redo"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col" width="280px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wisataAlams as $wisataAlam)
                    <tr>
                        <td class="text-center">{{ ++$i }}</td>
                        <td>
                            @if($wisataAlam->gambar)
                                <img src="{{ asset('storage/wisata-alam/' . $wisataAlam->gambar) }}" alt="{{ $wisataAlam->judul }}" class="img-thumbnail table-img">
                            @else
                                <img src="https://via.placeholder.com/70x50?text=No+Image" alt="No Image" class="img-thumbnail table-img">
                            @endif
                        </td>
                        <td>{{ $wisataAlam->judul }}</td>
                        <td>{{ Str::limit($wisataAlam->deskripsi, 100) }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.wisata-alam.destroy', $wisataAlam->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                                <a class="btn btn-info btn-sm mb-1" href="{{ route('admin.wisata-alam.show', $wisataAlam->id) }}">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a class="btn btn-primary btn-sm mb-1" href="{{ route('admin.wisata-alam.edit', $wisataAlam->id) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="fas fa-box-open fa-2x d-block mb-2 text-muted"></i>
                            <p class="lead text-muted">Tidak ada data wisata alam yang ditemukan.</p>
                            <a class="btn btn-primary mt-3" href="{{ route('admin.wisata-alam.create') }}">Tambah Wisata Alam Pertama</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $wisataAlams->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection