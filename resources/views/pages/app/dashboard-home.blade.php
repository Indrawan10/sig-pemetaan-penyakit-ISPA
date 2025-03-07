<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Blade</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-gray-800">SLAWI</a>

            <!-- Menu Toggle Button -->
            <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
                ☰
            </button>

            <!-- Menu -->
            <div id="menu" class="hidden md:flex space-x-4">
                <a href="/" class="text-gray-700 hover:text-blue-500 px-4">Home</a>
                <a href="{{ route('data.desa') }}" class="text-gray-700 hover:text-blue-500 px-4">Data Desa</a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 px-4">Login</a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white p-4">
            <a href="/" class="block text-gray-700 hover:text-blue-500 py-2">Home</a>
            <a href="{{ route('data.desa') }}" class="block text-gray-700 hover:text-blue-500 py-2">Data Desa</a>
            <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-500 py-2">Login</a>
        </div>
    </nav>

    <!-- Banner -->
  <section class="relative bg-cover bg-center bg-no-repeat bg-fixed h-screen text-white flex items-center justify-center text-center px-4" style="background-image: url('https://radartegal.disway.id/upload/27ab65482a9cbaff84d0d8e372cd4129.png');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="container mx-auto relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold">Kota Slawi</h1>
        <p class="mt-4 text-lg max-w-2xl mx-auto">
            Sistem Informasi ini merupakan aplikasi pemetaan geografis tempat kasus penyakit ISPA di wilayah Slawi. Aplikasi ini memuat informasi dan lokasi persebaran kasus penyakit ISPA.
        </p>
    </div>
</section>



    <!-- Pemetaan -->
    <section id="map" class="py-20 px-4">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800">Pemetaan Kasus ISPA</h2>
            <div id="mapid" class="h-64 md:h-96 mt-8 rounded-lg shadow-md"></div>
        </div>
    </section>

       <section id="tentang-ispa" class="py-20 px-4 bg-white">
    <div class="container mx-auto flex flex-col md:flex-row items-center">
        <!-- Gambar ISPA -->
        <div class="md:w-1/3 w-full flex justify-center">
            <img src="https://kabarmuarateweh.id/wp-content/uploads/2024/05/screenshot-1715262510990.png" alt="Gambar ISPA" class="rounded-lg shadow-md">
        </div>

        <!-- Penjelasan ISPA -->
        <div class="md:w-2/3 w-full md:pl-8 mt-6 md:mt-0">
            <h2 class="text-3xl font-bold text-gray-800">Apa Itu ISPA?</h2>
            <p class="mt-4 text-gray-600">
                Infeksi Saluran Pernapasan Akut (ISPA) adalah infeksi yang terjadi pada saluran pernapasan
                yang dapat memengaruhi hidung, tenggorokan, dan paru-paru. ISPA bisa disebabkan oleh virus,
                bakteri, atau faktor lingkungan seperti polusi udara. Penyakit ini dapat menular dengan mudah
                melalui udara atau kontak langsung dengan penderita.
            </p>
        </div>
    </div>
</section>



<!-- Tips Pencegahan ISPA -->
<section class="py-20 bg-gray-100 text-center">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-gray-800">Cara Mencegah ISPA</h2>
        <p class="mt-4 text-gray-600">Beberapa langkah untuk menghindari infeksi saluran pernapasan akut.</p>
        <div class="flex flex-wrap justify-center mt-6">

            <div class="w-full md:w-1/3 p-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="https://cdn-icons-png.flaticon.com/512/4826/4826030.png" alt="Cuci Tangan" class="w-16 mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-green-500">Cuci Tangan</h3>
                    <p class="text-gray-700">Rajin mencuci tangan dengan sabun untuk mencegah penyebaran virus.</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="/img/masker.png" alt="Gunakan Masker" class="w-16 mx-auto mb-4">

                    <h3 class="text-lg font-semibold text-green-500">Gunakan Masker</h3>

                    <p class="text-gray-700">Hindari paparan polusi udara dengan menggunakan masker.</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="/img/diet.png" alt="Jaga Pola Makan" class="w-16 mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-green-500">Jaga Pola Makan</h3>
                    <p class="text-gray-700">Konsumsi makanan bergizi untuk meningkatkan daya tahan tubuh.</p>
                </div>
            </div>
        </div>
    </div>
</section>



    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-6 text-center">
        <p class="text-sm">© 2025 SLAWI. All rights reserved.</p>
    </footer>

    <!-- Leaflet Map -->
    <script>
        var mymap = L.map('mapid').setView([-6.9848164, 109.0898518], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(mymap);

        $.ajax({
            url: '{{ route('get.locations') }}',
            method: 'GET',
            success: function (response) {
                response.forEach(function (location) {
                    var markerColor = location.marker_color || 'red';
                    var markerIcon = L.icon({
                        iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${markerColor}.png`,
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    });

                    var marker = L.marker([location.latitude, location.longitude], { icon: markerIcon }).addTo(mymap);

                    var popupContent = `
    <div class="p-4">
        <h3 class="font-bold text-lg mb-2">${location.nama_desa}</h3>
        <div class="text-gray-700">
            <p class="mb-1">Jumlah Kasus: ${location.total_kasus}</p>
            ${location.address ? `<p class="text-sm">${location.address}</p>` : ''}
        </div>
    </div>
`;
marker.bindPopup(popupContent);
                });
            },
            error: function (error) {
                console.error('Error fetching locations:', error);
            }
        });

        // Navbar Mobile Toggle
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>
