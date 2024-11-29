<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Lightbox styling */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 50;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }
        .lightbox img {
            max-width: 90%;
            max-height: 90%;
            border: 2px solid white;
        }
        .lightbox:target {
            display: flex;
        }
        .lightbox .close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Daftar Absensi</h1>

        <!-- Tampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel data absensi -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="border border-gray-300 px-4 py-2">Nama</th>
                        <th class="border border-gray-300 px-4 py-2">NIK</th>
                        <th class="border border-gray-300 px-4 py-2">Jam Absen</th>
                        <th class="border border-gray-300 px-4 py-2">Foto</th>
                        <th class="border border-gray-300 px-4 py-2">Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensis as $absensi)
                        <tr class="bg-white hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">{{ $absensi->nama }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $absensi->nik }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $absensi->jamabsen }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                @if($absensi->photo_path)
                                    <!-- Thumbnail with Lightbox -->
                                    <a href="#lightbox-{{ $absensi->id }}">
                                        <img src="{{ asset('storage/public/absensi/' . $absensi->photo_path) }}" alt="Foto Absen" class="h-16 w-16 object-cover rounded">
                                    </a>

                                    <!-- Lightbox -->
                                    <div id="lightbox-{{ $absensi->id }}" class="lightbox">
                                        <a href="#" class="close">&times;</a>
                                        <img src="{{ asset('storage/public/absensi/' . $absensi->photo_path) }}" alt="Foto Absen">
                                    </div>
                                @else
                                    <span class="text-gray-500">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <p>Lat: {{ $absensi->latitude }}</p>
                                <p>Long: {{ $absensi->longitude }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
