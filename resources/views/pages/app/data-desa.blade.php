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

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-gray-800">BACOT</a>

            <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
                ☰
            </button>

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

    <!-- Main Content -->
    <main class="flex-1">
        <!-- Hero Section with Image and Overlay -->

        <section class="relative bg-cover bg-center h-80 flex items-center justify-center text-center px-4" style="background-image: url('https://radartegal.disway.id/upload/27ab65482a9cbaff84d0d8e372cd4129.png');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="container mx-auto relative z-10 text-white">
            <h1 class="text-4xl md:text-5xl font-bold">Sistem Informasi Geografis Pemetaan Penyakit ISPA</h1>
            <p class="mt-4 text-lg">Informasi dan data desa di wilayah Slawi</p>
        </div>
    </section>

        <!-- Data Desa -->
        <section class="text-gray-800 pt-10 pb-20 text-center px-4">
            <div class="container mx-auto py-4">
                <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">Data Desa di Kecamatan Slawi</h1>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-xs md:text-sm leading-normal">
                                <th class="py-3 px-6 text-center">No</th>
                                <th class="py-3 px-6 text-center">Nama Desa</th>
                                <th class="py-3 px-6 text-center">Jumlah Kasus ISPA</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-xs md:text-sm font-light">
                            @if ($locations->isEmpty())
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-500">
                                        Data desa belum tersedia.
                                    </td>
                                </tr>
                            @else
                                @foreach ($locations as $index => $location)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-center">{{ $index + 1 }}</td>
                                    <td class="py-3 px-6 text-center">{{ $location->nama_desa }}</td>
                                    <td class="py-3 px-6 text-center">{{ $location->jumlah_terkena }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <a href="{{ route('data.desa.detail', $location->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-6 text-center">
        <p class="text-sm">© 2023 BACOT. All rights reserved.</p>
    </footer>

    <script>
        // Navbar Mobile Toggle
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>
