<?php

namespace App\Http\Controllers;

use App\Models\WisataAlam; // PASTIKAN \ BUKAN ->
use App\Models\Kegiatan;   // PASTIKAN \ BUKAN ->
use App\Models\ProfilDesa; // PASTIKAN \ BUKAN ->
use App\Models\UmkmDesa;   // PASTIKAN \ BUKAN ->
use App\Models\KesenianDesa; // PASTIKAN \ BUKAN ->
use Illuminate\Http\Request; // PASTIKAN \ BUKAN ->

class UmumController extends Controller
{
    public function index()
    {
        $wisataAlams = WisataAlam::latest()->get();
        $kegiatans = Kegiatan::latest()->get();
        $umkmDesas = UmkmDesa::latest()->get();
        $kesenianDesas = KesenianDesa::latest()->get();
        
        $profilDesa = ProfilDesa::latest()->first();

        return view('welcome', compact(
            'wisataAlams',
            'kegiatans',
            'profilDesa',
            'umkmDesas',
            'kesenianDesas'
        ));
    }

    public function daftarWisataAlam()
    {
        $wisataAlams = WisataAlam::latest()->paginate(9);
        return view('umum.wisata_alam.index', compact('wisataAlams'));
    }
    public function detailWisataAlam(WisataAlam $wisataAlam)
    {
        return view('umum.wisata_alam.show', compact('wisataAlam'));
    }

    public function daftarKegiatan()
    {
        $kegiatans = Kegiatan::latest()->paginate(9);
        return view('umum.kegiatan.index', compact('kegiatans'));
    }
    public function detailKegiatan(Kegiatan $kegiatan)
    {
        return view('umum.kegiatan.show', compact('kegiatan'));
    }

    public function daftarProfilDesa()
    {
        $profilDesa = ProfilDesa::latest()->first();
        return view('umum.profil_desa.show', compact('profilDesa'));
    }
    public function detailProfilDesa(ProfilDesa $profilDesa)
    {
        return view('umum.profil_desa.show', compact('profilDesa'));
    }

    public function daftarUmkmDesa()
    {
        $umkmDesas = UmkmDesa::latest()->paginate(9);
        return view('umum.umkm_desa.index', compact('umkmDesas'));
    }
    public function detailUmkmDesa(UmkmDesa $umkmDesa)
    {
        return view('umum.umkm_desa.show', compact('umkmDesa'));
    }

    public function daftarKesenianDesa()
    {
        $kesenianDesas = KesenianDesa::latest()->paginate(9);
        return view('umum.kesenian_desa.index', compact('kesenianDesas'));
    }
    public function detailKesenianDesa(KesenianDesa $kesenianDesa)
    {
        return view('umum.kesenian_desa.show', compact('kesenianDesa'));
    }
}
