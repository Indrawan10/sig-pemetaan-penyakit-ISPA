<?php

namespace App\Http\Controllers;

use App\Models\PemetaanIspa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $desas = PemetaanIspa::select('nama_desa')
            ->withCount('penduduk as jumlah_penduduk')
            ->get();

        return view('pages.app.dashboard-sig', compact('desas'));
    }

    public function pieChartData()
    {
        try {
            $desas = PemetaanIspa::select('id', 'nama_desa')
                ->withCount('penduduk') // Menghitung jumlah penduduk
                ->get()
                ->map(function ($desa) {
                    // Menghitung total kasus ISPA berdasarkan pemetaan_ispa_id
                    $totalKasusDesa = \App\Models\KasusIspa::where('pemetaan_ispa_id', $desa->id)
                        ->sum(DB::raw('jumlah_laki_laki + jumlah_perempuan'));

                    return [
                        'nama_desa' => $desa->nama_desa,
                        'total_penduduk' => $desa->penduduk_count, // Pastikan penduduk_count sesuai
                        'total_kasus_ispa' => $totalKasusDesa
                    ];
                });

            return response()->json($desas);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
