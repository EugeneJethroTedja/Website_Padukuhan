<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WisataAlam; // Import model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage Facade

class WisataAlamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil input 'search' dari request

        // Query dasar
        $query = WisataAlam::latest();

        // Jika ada input pencarian, terapkan filter
        if ($search) {
            $query->where('judul', 'LIKE', '%' . $search . '%')
                  ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
                  // Anda bisa menambahkan kolom lain yang ingin dicari, contoh: ->orWhere('lokasi', 'LIKE', '%' . $search . '%');
        }

        // Ambil data dengan paginasi
        $wisataAlams = $query->paginate(10); // Sesuaikan jumlah item per halaman jika diperlukan

        // Untuk penomoran di tabel (jika menggunakan ++$i di blade)
        $i = ($wisataAlams->currentPage() - 1) * $wisataAlams->perPage();

        return view('admin.wisata-alam.index', compact('wisataAlams', 'i', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.wisata-alam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lokasi' => 'required|string|max:255',
        ]);

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('/wisata-alam', $imageName); // Simpan di storage/app//wisata-alam
            $input['gambar'] = $imageName;
        }

        WisataAlam::create($input);

        return redirect()->route('admin.wisata-alam.index')
                         ->with('success', 'Wisata alam berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WisataAlam $wisataAlam)
    {
        return view('admin.wisata-alam.show', compact('wisataAlam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WisataAlam $wisataAlam)
    {
        return view('admin.wisata-alam.edit', compact('wisataAlam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WisataAlam $wisataAlam)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lokasi' => 'required|string|max:255',
        ]);

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($wisataAlam->gambar && Storage::exists('wisata-alam/' . $wisataAlam->gambar)) {
                Storage::delete('wisata-alam/' . $wisataAlam->gambar);
            }

            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('wisata-alam', $imageName);
            $input['gambar'] = $imageName;
        } else {
            // Pertahankan gambar lama jika tidak ada upload baru
            $input['gambar'] = $wisataAlam->gambar;
        }

        $wisataAlam->update($input);

        return redirect()->route('admin.wisata-alam.index')
                         ->with('success', 'Wisata alam berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WisataAlam $wisataAlam)
    {
        // Hapus file gambar terkait dari storage
        if ($wisataAlam->gambar && Storage::exists('/wisata-alam/' . $wisataAlam->gambar)) {
            Storage::delete('/wisata-alam/' . $wisataAlam->gambar);
        }

        $wisataAlam->delete();

        return redirect()->route('admin.wisata-alam.index')
                         ->with('success', 'Wisata alam berhasil dihapus.');
    }
}