<?php

namespace App\Http\Controllers;

use App\Models\PemetaanIspa;
use Illuminate\Http\Request;


use App\Models\Penduduk as ModelsPenduduk;
use App\Models\KasusISPA;
use Illuminate\Support\Facades\DB;

class PemetaanIspaController extends Controller
{
    public function index(Request $request)
    {
        $query = PemetaanIspa::query();

        if ($request->has('search')) {
            $query->where('nama_desa', 'like', '%' . $request->search . '%');
        }

        $locations = $query->paginate(10);
        return view('pages.app.list-data', [
            'type_menu' => 'data',
            'locations' => $locations
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_desa' => 'required',
            'jumlah_terkena' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'marker_color' => 'required',
            'address' => 'nullable'
        ]);

        PemetaanIspa::create($validatedData);
        return redirect()->route('list.data')->with('success', 'Data berhasil disimpan');
    }

    public function getLocations()
    {
        $locations = PemetaanIspa::all()->map(function ($location) {
            $totalKasus = KasusIspa::where('pemetaan_ispa_id', $location->id)
                ->sum(DB::raw('jumlah_laki_laki + jumlah_perempuan'));


            $location->total_kasus = $totalKasus;
            return $location;
        });

        return response()->json($locations);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_desa' => 'required',
            'jumlah_terkena' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'marker_color' => 'required',
            'address' => 'nullable'
        ]);

        $pemetaan = PemetaanIspa::findOrFail($id);
        $pemetaan->update($validatedData);

        return redirect()->route('list.data')->with('success', 'Data berhasil diperbarui');
    }

    public function edit($id)
    {
        $location = PemetaanIspa::findOrFail($id);
        return view('pages.app.edit-data', [
            'type_menu' => 'data',
            'location' => $location
        ]);
    }

    public function showDataDesa()
    {
        $locations = PemetaanIspa::all();
        $totalKasus = $locations->sum('jumlah_terkena');

        return view('pages.app.data-desa', compact('locations', 'totalKasus'));
    }

    public function showDetail($id)
    {
        $location = PemetaanIspa::findOrFail($id);
        $penduduks = ModelsPenduduk::where('pemetaan_ispa_id', $id)->get();
        $kasus = KasusIspa::where('pemetaan_ispa_id', $id)->get(); // Ambil penduduk berdasarkan desa

        return view('pages.app.detail-desa', compact('location', 'penduduks', 'kasus'));
    }



    public function destroy($id)
    {
        try {
            $pemetaan = PemetaanIspa::findOrFail($id);
            $pemetaan->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            }

            return redirect()->route('list.data')
                ->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus data'
                ], 500);
            }

            return redirect()->route('list.data')
                ->with('error', 'Gagal menghapus data');
        }
    }
}
