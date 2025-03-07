<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .header-row th {
            background-color: #a5c2f5 !important;
            color: #000;
        }
        .age-data {
            text-align: left;
            font-weight: bold;
        }
        .sum-row td {
            font-weight: bold;
            background-color: #f2f2f2;
        }
    </style>
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-gray-800">SLAWI</a>
            <button id="menu-btn" class="md:hidden text-gray-700 focus:outline-none text-2xl">☰</button>
            <div id="menu" class="hidden md:flex space-x-4">
                <a href="/" class="text-gray-700 hover:text-blue-500 px-4">Home</a>
                <a href="{{ route('data.desa') }}" class="text-gray-700 hover:text-blue-500 px-4">Data Desa</a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 px-4">Login</a>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md absolute w-full left-0">
            <a href="/" class="block text-gray-700 hover:text-blue-500 p-4">Home</a>
            <a href="{{ route('data.desa') }}" class="block text-gray-700 hover:text-blue-500 p-4">Data Desa</a>
            <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-500 p-4">Login</a>
        </div>
    </nav>

    <section class="relative bg-cover bg-center h-80 flex items-center justify-center text-center px-4" style="background-image: url('https://radartegal.disway.id/upload/27ab65482a9cbaff84d0d8e372cd4129.png');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="container mx-auto relative z-10 text-white">
            <h1 class="text-4xl md:text-5xl font-bold">Sistem Informasi Geografis Pemetaan Penyakit ISPA</h1>
            <p class="mt-4 text-lg">Informasi lokasi dan penyebaran kasus ISPA di wilayah ini.</p>
        </div>
    </section>

    <section class="container mx-auto py-16 px-4">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Detail Desa</h2>
            @php
    $totalKasus = 0;
    foreach($kasus as $k) {
        $totalKasus += $k->jumlah_laki_laki + $k->jumlah_perempuan;
    }
@endphp

            <p class="text-lg"><strong>Nama Desa:</strong> {{ $location->nama_desa }}</p>
            <p class="text-lg"><strong>Jumlah Kasus ISPA:</strong> {{ $totalKasus }}</p>
            <p class="text-lg"><strong>Latitude:</strong> {{ $location->latitude }}</p>
            <p class="text-lg"><strong>Longitude:</strong> {{ $location->longitude }}</p>
            <div id="map" class="w-full h-64 mt-4 rounded-lg"></div>
        </div>

    <h2 class="text-2xl font-bold text-gray-800 mt-10 text-center">Daftar Penduduk</h2>
    <div class="overflow-x-auto mt-4">
        <table>
           <thead>
    <tr class="header-row">
        <th rowspan="2">NO</th>
        <th rowspan="2">UMUR</th>
        @php
            $penyakitList = $kasus->pluck('nama_penyakit')->unique();
        @endphp
        @foreach($penyakitList as $penyakit)
            <th colspan="2">{{ $penyakit }}</th>
        @endforeach
        <th rowspan="2">Jumlah</th> <!-- Tambahkan kolom Jumlah -->
    </tr>
    <tr class="header-row">
        @foreach($penyakitList as $penyakit)
            <th>L</th>
            <th>P</th>
        @endforeach
    </tr>
</thead>
<tbody>
    @if($kasus->isEmpty())
        <tr>
            <td colspan="{{ 2 + count($penyakitList) * 2 + 1 }}" style="text-align: center; font-weight: bold; color: rgb(0, 0, 0);">
                Data Tidak Ada
            </td>
        </tr>
    @else
        @php
            $umurList = $kasus->pluck('umur')->unique()->sort();
        @endphp
        @foreach($umurList as $index => $umur)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="age-data">{{ $umur }}</td>
                @php
                    $totalPerRow = 0;
                @endphp
                @foreach($penyakitList as $penyakit)
                    @php
                        $dataKasus = $kasus->firstWhere(fn($k) => $k->umur == $umur && $k->nama_penyakit == $penyakit);
                        $jumlahLakiLaki = $dataKasus ? $dataKasus->jumlah_laki_laki : 0;
                        $jumlahPerempuan = $dataKasus ? $dataKasus->jumlah_perempuan : 0;
                        $totalPerRow += $jumlahLakiLaki + $jumlahPerempuan;
                    @endphp
                    <td>{{ $jumlahLakiLaki }}</td>
                    <td>{{ $jumlahPerempuan }}</td>
                @endforeach
                <td style="font-weight: bold;">{{ $totalPerRow }}</td>
            </tr>
        @endforeach
        <tr class="sum-row">
            <td colspan="2" style="text-align: center; font-weight: bold;">JUMLAH KESELURUHAN</td>
            @php
                $totalLakiLaki = 0;
                $totalPerempuan = 0;
            @endphp
            @foreach($penyakitList as $penyakit)
                @php
                    $jumlahLakiLaki = $kasus->where('nama_penyakit', $penyakit)->sum('jumlah_laki_laki');
                    $jumlahPerempuan = $kasus->where('nama_penyakit', $penyakit)->sum('jumlah_perempuan');
                    $totalLakiLaki += $jumlahLakiLaki;
                    $totalPerempuan += $jumlahPerempuan;
                @endphp
                <td>{{ $jumlahLakiLaki }}</td>
                <td>{{ $jumlahPerempuan }}</td>
            @endforeach
            <td style="background-color: #a5c2f5; font-weight: bold; color: rgb(0, 0, 0);">
                {{ $totalLakiLaki + $totalPerempuan }}
            </td>
        </tr>
    @endif
</tbody>


        </table>
    </div>
</section>

    </section>

    <footer class="bg-blue-500 text-white py-6 text-center">
        <p class="text-sm">© 2025 SLAWI. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        document.addEventListener("DOMContentLoaded", function () {
            var latitude = {{ $location->latitude }};
            var longitude = {{ $location->longitude }};
            var markerColor = "{{ $location->marker_color }}";

            var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var customIcon = L.icon({
                iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${markerColor}.png`,
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            L.marker([latitude, longitude], { icon: customIcon }).addTo(map)
                .bindPopup("{{ $location->nama_desa }}")
                .openPopup();
        });
    </script>
</body>
</html>
