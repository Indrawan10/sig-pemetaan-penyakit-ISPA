@extends('layouts.app')

@section('title', 'Data Kasus ISPA')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Kasus ISPA</h1>

        </div>

        <div class="section-body">
            <div class="card p-4">
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Desa</th>
                            <th>Penyakit</th>
                            <th>Umur</th>
                            <th>Laki-laki</th>
                            <th>Perempuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kasus as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->desa->nama_desa }}</td>
                            <td>{{ $k->nama_penyakit }}</td>
                            <td>{{ $k->umur }}</td>
                            <td>{{ $k->jumlah_laki_laki }}</td>
                            <td>{{ $k->jumlah_perempuan }}</td>
                            <td>
                                <a href="{{ route('kasus-ispa.edit', $k->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('kasus-ispa.destroy', $k->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Hapus data?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
