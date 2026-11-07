<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KesenianDesa; // PASTIKAN \ BUKAN ->
use Illuminate\Http\Request; // PASTIKAN \ BUKAN ->
use Illuminate\Support\Facades\Storage; // PASTIKAN \ BUKAN ->

class KesenianDesaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil input 'search' dari request

        // Query dasar
        $query = KesenianDesa::latest();

        // Jika ada input pencarian, terapkan filter
        if ($search) {
            $query->where('nama_kesenian', 'LIKE', '%' . $search . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
        }

        // Ambil data dengan paginasi
        $kesenianDesas = $query->paginate(10); // Sesuaikan jumlah item per halaman jika diperlukan

        // Untuk penomoran di tabel (jika menggunakan ++$i di blade)
        $i = ($kesenianDesas->currentPage() - 1) * $kesenianDesas->perPage();

        return view('admin.kesenian-desa.index', compact('kesenianDesas', 'i', 'search'));
    }

    public function create() { return view('admin.kesenian-desa.create'); }
    public function store(Request $request) {
        $request->validate([
            'nama_kesenian' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input = $request->all();
        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('kesenian-desa', $imageName);
            $input['gambar'] = $imageName;
        }
        KesenianDesa::create($input);
        return redirect()->route('admin.kesenian-desa.index')->with('success', 'Kesenian desa berhasil ditambahkan.');
    }
    public function show(KesenianDesa $kesenianDesa) { return view('admin.kesenian-desa.show', compact('kesenianDesa')); }
    public function edit(KesenianDesa $kesenianDesa) { return view('admin.kesenian-desa.edit', compact('kesenianDesa')); }
    public function update(Request $request, KesenianDesa $kesenianDesa) {
        $request->validate([
            'nama_kesenian' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input = $request->all();
        if ($request->hasFile('gambar')) {
            if ($kesenianDesa->gambar && Storage::exists('kesenian-desa/' . $kesenianDesa->gambar)) {
                Storage::delete('kesenian-desa/' . $kesenianDesa->gambar);
            }
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('kesenian-desa', $imageName);
            $input['gambar'] = $imageName;
        } else { $input['gambar'] = $kesenianDesa->gambar; } // Pertahankan gambar lama
        $kesenianDesa->update($input);
        return redirect()->route('admin.kesenian-desa.index')->with('success', 'Kesenian desa berhasil diperbarui.');
    }
    public function destroy(KesenianDesa $kesenianDesa) {
        if ($kesenianDesa->gambar && Storage::exists('kesenian-desa/' . $kesenianDesa->gambar)) {
            Storage::delete('kesenian-desa/' . $kesenianDesa->gambar);
        }
        $kesenianDesa->delete();
        return redirect()->route('admin.kesenian-desa.index')->with('success', 'Kesenian desa berhasil dihapus.');
    }
}
