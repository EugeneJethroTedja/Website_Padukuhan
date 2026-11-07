<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UmkmDesa; // PASTIKAN \ BUKAN ->
use Illuminate\Http\Request; // PASTIKAN \ BUKAN ->
use Illuminate\Support\Facades\Storage; // PASTIKAN \ BUKAN ->

class UmkmDesaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil input 'search' dari request

        // Query dasar
        $query = UmkmDesa::latest();

        // Jika ada input pencarian, terapkan filter
        if ($search) {
            $query->where('nama_produk', 'LIKE', '%' . $search . '%')
                ->orWhere('nama_umkm', 'LIKE', '%' . $search . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $search . '%'); // Menambahkan pencarian di deskripsi juga
        }

        // Ambil data dengan paginasi
        $umkmDesas = $query->paginate(10); // Sesuaikan jumlah item per halaman jika diperlukan

        // Untuk penomoran di tabel (jika menggunakan ++$i di blade)
        $i = ($umkmDesas->currentPage() - 1) * $umkmDesas->perPage();

        return view('admin.umkm-desa.index', compact('umkmDesas', 'i', 'search'));
    }

    public function create() { return view('admin.umkm-desa.create'); }
    public function store(Request $request) {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'nama_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input = $request->all();
        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('/umkm-desa', $imageName);
            $input['gambar'] = $imageName;
        }
        UmkmDesa::create($input);
        return redirect()->route('admin.umkm-desa.index')->with('success', 'UMKM desa berhasil ditambahkan.');
    }
    public function show(UmkmDesa $umkmDesa) { return view('admin.umkm-desa.show', compact('umkmDesa')); }
    public function edit(UmkmDesa $umkmDesa) { return view('admin.umkm-desa.edit', compact('umkmDesa')); }
    public function update(Request $request, UmkmDesa $umkmDesa) {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'nama_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input = $request->all();
        if ($request->hasFile('gambar')) {
            if ($umkmDesa->gambar && Storage::exists('/umkm-desa' . $umkmDesa->gambar)) {
                Storage::delete('/umkm-desa' . $umkmDesa->gambar);
            }
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('/umkm-desa', $imageName);
            $input['gambar'] = $imageName;
        } else { $input['gambar'] = $umkmDesa->gambar; } // Pertahankan gambar lama
        $umkmDesa->update($input);
        return redirect()->route('admin.umkm-desa.index')->with('success', 'UMKM desa berhasil diperbarui.');
    }
    public function destroy(UmkmDesa $umkmDesa) {
        if ($umkmDesa->gambar && Storage::exists('umkm-desa' . $umkmDesa->gambar)) {
            Storage::delete('umkm-desa' . $umkmDesa->gambar);
        }
        $umkmDesa->delete();
        return redirect()->route('admin.umkm-desa.index')->with('success', 'UMKM desa berhasil dihapus.');
    }
}
