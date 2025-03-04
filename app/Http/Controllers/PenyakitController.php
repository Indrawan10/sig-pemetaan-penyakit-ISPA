<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakits = Penyakit::all();
        return view('penyakit.index', compact('penyakits'));
    }

    public function create()
    {
        return view('penyakit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:penyakits,nama|max:255'
        ]);

        Penyakit::create(['nama' => $request->nama]);

        return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil ditambahkan!');
    }

    public function edit(Penyakit $penyakit)
    {
        return view('penyakit.edit', compact('penyakit'));
    }

    public function update(Request $request, Penyakit $penyakit)
    {
        $request->validate([
            'nama' => 'required|unique:penyakits,nama,' . $penyakit->id . '|max:255'
        ]);

        $penyakit->update(['nama' => $request->nama]);

        return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil diperbarui!');
    }

    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();
        return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil dihapus!');
    }
}
