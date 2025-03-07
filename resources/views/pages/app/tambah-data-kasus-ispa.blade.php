@extends('layouts.app')

@section('title', 'New Data Kasus ISPA')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Kasus ISPA</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('kasus-ispa.index') }}">Data Kasus ISPA</a></div>
                    <div class="breadcrumb-item">Tambah Data Kasus ISPA</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card p-4">
                    <form action="{{ route('kasus-ispa.store') }}" method="POST">
                        @csrf

                        @if ($errors->has('duplicate'))
    <div class="alert alert-danger">
        {{ $errors->first('duplicate') }}
    </div>
@endif

                        <div class="form-group">
                            <label for="pemetaan_ispa_id">Nama Desa</label>
                            <select class="form-control @error('pemetaan_ispa_id') is-invalid @enderror"
                                name="pemetaan_ispa_id" id="pemetaan_ispa_id" required>
                                <option value="" disabled selected>Pilih Nama Desa</option>
                                @foreach ($desa as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama_desa }}</option>
                                @endforeach
                            </select>
                            @error('pemetaan_ispa_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
    <label>Nama Penyakit</label>
    <select id="nama_penyakit" class="form-control @error('nama_penyakit') is-invalid @enderror" name="nama_penyakit" onchange="toggleCustomInput()">
        <option value="">-- Pilih Penyakit --</option>
        @foreach($penyakitList as $penyakit)
            <option value="{{ $penyakit->nama }}" {{ old('nama_penyakit') == $penyakit->nama ? 'selected' : '' }}>{{ $penyakit->nama }}</option>
        @endforeach
        <option value="custom">Lainnya...</option>
    </select>
    <input type="text" id="custom_penyakit" class="form-control mt-2 d-none" name="custom_penyakit" placeholder="Masukkan nama penyakit baru">

    @error('nama_penyakit')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


                        <div class="form-group">
                            <label>Umur</label>
                            <select class="form-control @error('umur') is-invalid @enderror" name="umur">
                                <option value="" disabled selected>Pilih Umur</option>
                                <option value="0-<5 Tahun" {{ old('umur') == '0-<5 Tahun' ? 'selected' : '' }}>0 - < 5 Tahun</option>
                                <option value="5-9 Tahun" {{ old('umur') == '5-9 Tahun' ? 'selected' : '' }}>5 - 9 Tahun</option>
                                <option value="9-<60 Tahun" {{ old('umur') == '9-<60 Tahun' ? 'selected' : '' }}>9 - < 60 Tahun</option>
                                <option value=">= 60 Tahun" {{ old('umur') == '>= 60 Tahun' ? 'selected' : '' }}>>= 60 Tahun</option>
                            </select>
                            @error('umur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jumlah Laki-laki Terkena Penyakit</label>
                            <input type="number" class="form-control @error('jumlah_laki_laki') is-invalid @enderror" name="jumlah_laki_laki"
                                value="{{ old('jumlah_laki_laki') }}">
                            @error('jumlah_laki_laki')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jumlah Perempuan Terkena Penyakit</label>
                            <input type="number" class="form-control @error('jumlah_perempuan') is-invalid @enderror" name="jumlah_perempuan"
                                value="{{ old('jumlah_perempuan') }}">
                            @error('jumlah_perempuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('kasus-ispa.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pastikan data sudah benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan sekarang!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });

         function toggleCustomInput() {
    var select = document.getElementById("nama_penyakit");
    var customInput = document.getElementById("custom_penyakit");

    if (select.value === "custom") {
        customInput.classList.remove("d-none");
        customInput.setAttribute("name", "custom_penyakit");
    } else {
        customInput.classList.add("d-none");
        customInput.removeAttribute("name");
    }
}

    </script>
@endpush
