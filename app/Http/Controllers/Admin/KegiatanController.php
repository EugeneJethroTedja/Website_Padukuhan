<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan; // PASTIKAN \ BUKAN ->
use Illuminate\Http\Request; // PASTIKAN \ BUKAN ->
use Illuminate\Support\Facades\Storage; // PASTIKAN \ BUKAN ->

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil input 'search' dari request

        // Query dasar
        $query = Kegiatan::latest();

        // Jika ada input pencarian, terapkan filter
        if ($search) {
            $query->where('nama_kegiatan', 'LIKE', '%' . $search . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            // Anda bisa menambahkan kolom lain yang ingin dicari jika diperlukan, contoh:
            // ->orWhere('lokasi', 'LIKE', '%' . $search . '%');
        }

        // Ambil data dengan paginasi
        $kegiatans = $query->paginate(10); // Sesuaikan jumlah item per halaman jika diperlukan

        // Untuk penomoran di tabel (jika menggunakan ++$i di blade)
        $i = ($kegiatans->currentPage() - 1) * $kegiatans->perPage();

        return view('admin.kegiatan.index', compact('kegiatans', 'i', 'search'));
    }

    public function create() { return view('admin.kegiatan.create'); }
    public function store(Request $request) {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lokasi' => 'required|string|max:255',
            'waktu' => 'required|string|max:255',
        ]);
        $input = $request->all();
        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('kegiatan', $imageName);
            $input['gambar'] = $imageName;
        }
        Kegiatan::create($input);
        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }
    public function show(Kegiatan $kegiatan) { return view('admin.kegiatan.show', compact('kegiatan')); }
    public function edit(Kegiatan $kegiatan) { return view('admin.kegiatan.edit', compact('kegiatan')); }
    public function update(Request $request, Kegiatan $kegiatan) {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lokasi' => 'required|string|max:255',
            'waktu' => 'required|string|max:255',
        ]);
        $input = $request->all();
        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && Storage::exists('kegiatan/' . $kegiatan->gambar)) {
                Storage::delete('kegiatan/' . $kegiatan->gambar);
            }
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('kegiatan', $imageName);
            $input['gambar'] = $imageName;
        } else { $input['gambar'] = $kegiatan->gambar; } // Pertahankan gambar lama
        $kegiatan->update($input);
        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }
    public function destroy(Kegiatan $kegiatan) {
        if ($kegiatan->gambar && Storage::exists('kegiatan/' . $kegiatan->gambar)) {
            Storage::delete('kegiatan/' . $kegiatan->gambar);
        }
        $kegiatan->delete();
        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
