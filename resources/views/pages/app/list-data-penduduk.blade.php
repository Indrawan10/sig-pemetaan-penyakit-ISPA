@extends('layouts.app')

@section('title', 'List Data Penduduk')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
    <h1>List Data Penduduk</h1>
    <div class="d-flex">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.admin') }}">Dashboard</a></div>
        <div class="breadcrumb-item">List Data Penduduk</div>
    </div>
</div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>List Data Penduduk</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari nama penduduk..."
                                                name="search" value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Desa</th>
                                                <th>Nama</th>
                                                <th>Umur</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Alamat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($penduduks as $index => $penduduk)
                                                <tr>
                                                    <td>{{ $index + $penduduks->firstItem() }}</td>
                                                    <td>{{ $penduduk->pemetaanIspa->nama_desa ?? 'Tidak Diketahui' }}</td>
                                                      <td>{{ $penduduk->nama }}</td>
                                                    <td>{{ $penduduk->umur }}</td>
                                                    <td>{{ $penduduk->jenis_kelamin }}</td>
                                                    <td>{{ $penduduk->alamat }}</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm btn-edit"
                                                            data-id="{{ $penduduk->id }}"
                                                            data-pemetaan_ispa_id="{{ $penduduk->pemetaan_ispa_id }}"
                                                            data-nama="{{ $penduduk->nama }}"
                                                            data-umur="{{ $penduduk->umur }}"
                                                            data-jenis_kelamin="{{ $penduduk->jenis_kelamin }}"
                                                            data-alamat="{{ $penduduk->alamat }}">
                                                            Edit
                                                        </button>

                                                        <button class="btn btn-danger btn-sm btn-delete"
                                                            data-id="{{ $penduduk->id }}">
                                                            Hapus
                                                        </button>

                                                        </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No data available</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $penduduks->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <!-- Modal for Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Penduduk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">

                        <div class="form-group">
                            <label>Nama Desa</label>
                            <select class="form-control" id="edit_pemetaan_ispa_id" name="pemetaan_ispa_id" required>
                                @foreach ($desa as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama_desa }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama">
                        </div>

                        <div class="form-group">
                            <label>Umur</label>
                            <input type="number" class="form-control" id="edit_umur" name="umur">
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" id="edit_jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" id="edit_alamat" name="alamat">
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

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Button edit
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            var pemetaan_ispa_id = $(this).data('pemetaan_ispa_id');
            var nama = $(this).data('nama');
            var umur = $(this).data('umur');
            var jenis_kelamin = $(this).data('jenis_kelamin');
            var alamat = $(this).data('alamat');

            var modal = $('#editModal');
            modal.find('#edit_id').val(id);
            modal.find('#edit_pemetaan_ispa_id').val(pemetaan_ispa_id);
            modal.find('#edit_nama').val(nama);
            modal.find('#edit_umur').val(umur);
            modal.find('#edit_jenis_kelamin').val(jenis_kelamin);
            modal.find('#edit_alamat').val(alamat);

            $('#editForm').attr('action', '/penduduk/update/' + id);
            modal.modal('show');
        });
        // Button delete
        $(document).on('click', '.btn-delete', function() {
            var id = $(this).data('id'); // Ambil ID dari tombol
            var url = "{{ route('penduduk.delete', '') }}/" + id; // Buat URL untuk delete

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Terhapus!',
                                'Data penduduk berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText); // Debugging Error
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endpush
