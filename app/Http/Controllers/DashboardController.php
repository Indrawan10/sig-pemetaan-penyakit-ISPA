<?php

namespace App\Http\Controllers;

use App\Models\PemetaanIspa;
use Illuminate\Http\Request;

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
            $desas = PemetaanIspa::select('nama_desa')
                ->withCount('penduduk')  // Pastikan ini menghitung jumlah penduduk
                ->get()
                ->map(function ($desa) {
                    return [
                        'nama_desa' => $desa->nama_desa,
                        'total_penduduk' => $desa->penduduk_count // Pastikan nama ini sesuai dengan data yang dibutuhkan
                    ];
                });
    
            return response()->json($desas);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}