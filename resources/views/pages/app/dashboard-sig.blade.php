@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>


            <!-- Pie Chart Section -->
            <div class="row mt-4">
                <div class="col-lg-6 mx-auto">
                    <div class="card"> <!-- Menghapus class mb-8 -->
                        <div class="card-header">
                            <h4>Data Statistik Kasus ISPA per Desa</h4>
                        </div>
                        <div class="card-body" style="height: 450px;"> <!-- Menambahkan fixed height -->
                            @include('components.pie-chart')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
@endpush
