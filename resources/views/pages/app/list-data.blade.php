@extends('layouts.app')

@section('title', 'List Data ISPA')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>List Data ISPA</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.admin') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">List Data</div>
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
                                <h4>List Data ISPA</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('tambah.data') }}" class="btn btn-primary">
                                        Tambah Data Baru
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari nama desa..."
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
                                                <th>Jumlah Terkena</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Marker Color</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($locations as $location)
                                                @php
                                                    $totalKasusDesa = \App\Models\KasusIspa::where(
                                                        'pemetaan_ispa_id',
                                                        $location->id,
                                                    )->sum(\DB::raw('jumlah_laki_laki + jumlah_perempuan'));
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $location->nama_desa }}</td>
                                                    <td>{{ $totalKasusDesa }}</td>
                                                    <td>{{ $location->latitude }}</td>
                                                    <td>{{ $location->longitude }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $location->marker_color }}">
                                                            {{ ucfirst($location->marker_color) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="buttons">
                                                            <a href="#" class="btn btn-icon btn-info btn-edit"
                                                                data-id="{{ $location->id }}"
                                                                data-nama_desa="{{ $location->nama_desa }}"
                                                                data-jumlah_terkena="{{ $location->jumlah_terkena }}"
                                                                data-latitude="{{ $location->latitude }}"
                                                                data-longitude="{{ $location->longitude }}"
                                                                data-marker_color="{{ $location->marker_color }}"
                                                                data-address="{{ $location->address }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('pemetaan.destroy', $location->id) }}"
                                                                method="POST" class="d-inline delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-icon btn-danger btn-delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="float-right">
                                    {{ $locations->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data ISPA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Desa</label>
                            <input type="text" class="form-control" name="nama_desa" id="edit_nama_desa">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Terkena</label>
                            <input type="number" class="form-control" name="jumlah_terkena" id="edit_jumlah_terkena"
                                readonly>
                            <small class="form-text text-muted">Jumlah total dihitung otomatis dari data laki-laki dan
                                perempuan.</small>
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" class="form-control" name="latitude" id="edit_latitude">
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" class="form-control" name="longitude" id="edit_longitude">
                        </div>
                        <div class="form-group">
                            <label for="edit_marker_color">Marker Color</label>
                            <select class="form-control" name="marker_color" id="edit_marker_color">
                                <option value="red">Red</option>
                                <option value="orange">Orange</option>
                                <option value="blue">Blue</option>
                                <option value="green">Green</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script>
        // Handler untuk tombol delete
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            var form = deleteButton.closest('form');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Disable tombol delete untuk mencegah double click
                    deleteButton.prop('disabled', true);

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data berhasil dihapus.',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            deleteButton.prop('disabled', false);
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        // Handler untuk tombol edit
        $('.btn-edit').click(function(e) {
            e.preventDefault();

            // Ambil data dari atribut
            var id = $(this).data('id');
            var nama_desa = $(this).data('nama_desa');
            var latitude = $(this).data('latitude');
            var longitude = $(this).data('longitude');
            var marker_color = $(this).data('marker_color');
            var address = $(this).data('address');

            // Set action form
            $('#editForm').attr('action', '/update-data/' + id);

            // Ambil jumlah kasus yang dihitung dari tabel
            var totalKasus = $(this).closest('tr').find('td:eq(2)').text();

            // Isi form dengan data
            $('#edit_nama_desa').val(nama_desa);
            $('#edit_jumlah_terkena').val(totalKasus);
            $('#edit_latitude').val(latitude);
            $('#edit_longitude').val(longitude);
            $('#edit_marker_color').val(marker_color);
            $('#edit_address').val(address);

            // Tampilkan modal
            $('#editModal').modal('show');
        });

        // Validasi form sebelum submit
        $('#editForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#editModal').modal('hide');
                    // Refresh halaman
                    location.reload();
                },
                error: function(xhr) {
                    // Tampilkan error
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#edit_' + key).addClass('is-invalid');
                            $('#edit_' + key).after('<div class="invalid-feedback">' + value[
                                0] + '</div>');
                        });
                    }
                }
            });
        });

        // Reset form saat modal ditutup
        $('#editModal').on('hidden.bs.modal', function() {
            $('#editForm')[0].reset();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
        });
    </script>
@endpush
