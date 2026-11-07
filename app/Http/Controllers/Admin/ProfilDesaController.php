<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa; // PASTIKAN \ BUKAN ->
use Illuminate\Http\Request; // PASTIKAN \ BUKAN ->
use Illuminate\Support\Facades\Storage; // PASTIKAN \ BUKAN ->

class ProfilDesaController extends Controller
{
    public function index() {
        $profilDesas = ProfilDesa::latest()->paginate(1);
        return view('admin.profil-desa.index', compact('profilDesas'))->with('i', (request()->input('page', 1) - 1) * 1);
    }
    public function create() { return view('admin.profil-desa.create'); }
    public function store(Request $request) {
        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'sejarah' => 'required|string',
            'visi_misi' => 'required|string',
            'gambar_desa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input = $request->all();
        if ($request->hasFile('gambar_desa')) {
            $imageName = time().'.'.$request->gambar_desa->extension();
            $request->gambar_desa->storeAs('profil-desa', $imageName);
            $input['gambar_desa'] = $imageName;
        }
        ProfilDesa::create($input);
        return redirect()->route('admin.profil-desa.index')->with('success', 'Profil desa berhasil ditambahkan.');
    }
    public function show(ProfilDesa $profilDesa) { return view('admin.profil-desa.show', compact('profilDesa')); }
    public function edit(ProfilDesa $profilDesa) { return view('admin.profil-desa.edit', compact('profilDesa')); }
    public function update(Request $request, ProfilDesa $profilDesa) {
        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'sejarah' => 'required|string',
            'visi_misi' => 'required|string',
            'gambar_desa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input = $request->all();
        if ($request->hasFile('gambar_desa')) {
            if ($profilDesa->gambar_desa && Storage::exists('profil-desa/' . $profilDesa->gambar_desa)) {
                Storage::delete('profil-desa/' . $profilDesa->gambar_desa);
            }
            $imageName = time().'.'.$request->gambar_desa->extension();
            $request->gambar_desa->storeAs('profil-desa', $imageName);
            $input['gambar_desa'] = $imageName;
        } else { $input['gambar_desa'] = $profilDesa->gambar_desa; } // Pertahankan gambar lama
        $profilDesa->update($input);
        return redirect()->route('admin.profil-desa.index')->with('success', 'Profil desa berhasil diperbarui.');
    }
    public function destroy(ProfilDesa $profilDesa) {
        if ($profilDesa->gambar_desa && Storage::exists('profil-desa/' . $profilDesa->gambar_desa)) {
            Storage::delete('profil-desa/' . $profilDesa->gambar_desa);
        }
        $profilDesa->delete();
        return redirect()->route('admin.profil-desa.index')->with('success', 'Profil desa berhasil dihapus.');
    }
}
