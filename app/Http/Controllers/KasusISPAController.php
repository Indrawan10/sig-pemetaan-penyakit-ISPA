<?php

namespace App\Http\Controllers;

use App\Models\KasusISPA;
use App\Models\PemetaanISPA;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class KasusISPAController extends Controller
{
    public function index()
    {
        $kasus = KasusISPA::with('desa')->get();
        $penyakitList = Penyakit::all();
        return view('pages.app.list-data-kasus-ispa', compact('kasus', 'penyakitList'));
    }

    public function create()
    {
        $desa = PemetaanISPA::all();
        $penyakitList = Penyakit::all();
        return view('pages.app.tambah-data-kasus-ispa', compact('desa', 'penyakitList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemetaan_ispa_id' => 'required',
            'nama_penyakit' => 'required',
            'umur' => 'required',
            'jumlah_laki_laki' => 'required|numeric',
            'jumlah_perempuan' => 'required|numeric',
        ]);

        // Cek apakah data sudah ada
        $existingData = KasusIspa::where('pemetaan_ispa_id', $request->pemetaan_ispa_id)
            ->where('nama_penyakit', $request->nama_penyakit)
            ->where('umur', $request->umur)
            ->exists();

        if ($existingData) {
            return redirect()->back()->withInput()->withErrors([
                'duplicate' => 'Data kasus ISPA dengan Nama desa, Nama penyakit, dan umur yang sama sudah ada!',
            ]);
        }

        // Simpan data baru jika tidak duplikat
        KasusIspa::create([
            'pemetaan_ispa_id' => $request->pemetaan_ispa_id,
            'nama_penyakit' => $request->nama_penyakit,
            'umur' => $request->umur,
            'jumlah_laki_laki' => $request->jumlah_laki_laki,
            'jumlah_perempuan' => $request->jumlah_perempuan,
        ]);

        return redirect()->route('kasus-ispa.index')->with('success', 'Data berhasil ditambahkan!');
    }





    public function edit($id)
    {
        $kasus = KasusISPA::findOrFail($id);
        $desa = PemetaanISPA::all();
        $penyakitList = Penyakit::all();
        return view('kasus_ispa.edit', compact('kasus', 'desa', 'penyakitList'));
    }

    public function update(Request $request, $id)
    {
        $kasus = KasusIspa::findOrFail($id);

        // Cek apakah data serupa sudah ada
        $existingKasus = KasusIspa::where('pemetaan_ispa_id', $kasus->pemetaan_ispa_id)
            ->where('nama_penyakit', $request->nama_penyakit)
            ->where('umur', $request->umur)
            ->where('id', '!=', $id) // Kecualikan data saat ini
            ->first();

        if ($existingKasus) {
            return redirect()->back()->with('error', 'Data dengan detail yang sama sudah ada.');
        }

        $kasus->update([
            'nama_penyakit' => $request->nama_penyakit,
            'umur' => $request->umur,
            'jumlah_laki_laki' => $request->jumlah_laki_laki,
            'jumlah_perempuan' => $request->jumlah_perempuan
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }
    public function destroy($id)
    {
        $kasus = KasusISPA::findOrFail($id);
        $kasus->delete();

        return redirect()->route('kasus-ispa.index')->with('success', 'Data berhasil dihapus.');
    }
}
