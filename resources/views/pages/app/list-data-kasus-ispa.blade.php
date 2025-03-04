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
                                <button class="btn btn-warning" onclick="editKasus({{ $k }})">Edit</button>
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

<!-- Modal Box -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Kasus ISPA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group">
                        <label>Nama Desa</label>
                        <input type="text" id="editNamaDesa" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Penyakit</label>
                        <select id="editNamaPenyakit" name="nama_penyakit" class="form-control" required>
                            @foreach($penyakitList as $penyakit)
                                <option value="{{ $penyakit->nama }}" {{ old('nama_penyakit') == $penyakit->nama ? 'selected' : '' }}>{{ $penyakit->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Umur</label>
                        <select id="editUmur" name="umur" class="form-control" required>
                            <option value="0-<5 Tahun" {{ old('umur') == '0-<5 Tahun' ? 'selected' : '' }}>0 - < 5 Tahun</option>
                            <option value="5-9 Tahun" {{ old('umur') == '5-9 Tahun' ? 'selected' : '' }}>5 - 9 Tahun</option>
                            <option value="9-<60 Tahun" {{ old('umur') == '9-<60 Tahun' ? 'selected' : '' }}>9 - < 60 Tahun</option>
                            <option value=">= 60 Tahun" {{ old('umur') == '>= 60 Tahun' ? 'selected' : '' }}>>= 60 Tahun</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Laki-laki</label>
                        <input type="number" id="editLakiLaki" name="jumlah_laki_laki" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Perempuan</label>
                        <input type="number" id="editPerempuan" name="jumlah_perempuan" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editKasus(kasus) {
        document.getElementById('editId').value = kasus.id;
        document.getElementById('editNamaDesa').value = kasus.desa.nama_desa;
        document.getElementById('editNamaPenyakit').value = kasus.nama_penyakit;
        document.getElementById('editUmur').value = kasus.umur;
        document.getElementById('editLakiLaki').value = kasus.jumlah_laki_laki;
        document.getElementById('editPerempuan').value = kasus.jumlah_perempuan;
        document.getElementById('editForm').action = '/kasus-ispa/' + kasus.id;
        $('#editModal').modal('show');
    }
</script>
@endsection
