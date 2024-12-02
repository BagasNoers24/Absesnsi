<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi dengan Kamera</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        /* Custom styles can be added here */
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-1/4 p-4">
            <div class="flex items-center mb-6">
                <img alt="Telkom Indonesia Logo" class="mr-2" height="50" src="https://storage.googleapis.com/a1aa/image/OTBfIoRGKzTel0eyVg6kQSW7JETEkoZTryDS3jfReolgPJVdC.jpg" width="50" />
                <span class="text-xl font-bold">Telkom Indonesia</span>
            </div>
            <nav>
                <ul>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="{{ route('dashboard') }}">
                            <i class="fas fa-database mr-2"></i> DASHBOARD
                        </a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="{{ route('jobdesk_records.store') }}">
                            <i class="fas fa-database mr-2"></i> REPORT DATA
                        </a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="{{ route('admin.report') }}">
                            <i class="fas fa-database mr-2"></i> MASTER DATA
                        </a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="{{ route('admin.absensi') }}">
                            <i class="fas fa-database mr-2"></i> DATA ABSENSI
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="absolute bottom-4 left-4">
                <button class="bg-red-600 p-2 rounded-full">
                    <a href="{{ route('dashboard') }}" class="fas fa-arrow-left text-white"></a>
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-bold mb-4">Laporan Absensi</h1>
            <div class="bg-white rounded-lg shadow-md p-4">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="py-3 px-4 border-b text-center">Nama</th>
                            <th class="py-3 px-4 border-b text-center">Nik</th>
                            <th class="py-3 px-4 border-b text-center">Jam</th>
                            <th class="py-3 px-4 border-b text-center">Gambar Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensis as $absensi)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-4 border-b text-center">{{ $absensi->nama }}</td>
                            <td class="py-3 px-4 border-b text-center">{{ $absensi->nik }}</td>
                            <td class="py-3 px-4 border-b text-center">
                                <span 
                                    class="px-2 py-1 rounded 
                                    @if(\Carbon\Carbon::parse($absensi->jamabsen)->format('H:i') <= '08:00') 
                                        bg-green-500 text-white 
                                    @else 
                                        bg-orange-500 text-white 
                                    @endif">
                                    {{ $absensi->jamabsen }}
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b text-center">
                                @if($absensi->photo_path)
                                    <img src="{{ asset('storage/' . $absensi->photo_path) }}" 
                                         alt="Foto Absensi" 
                                         class="h-16 w-16 object-cover rounded-full cursor-pointer" 
                                         onclick="openModal('{{ asset('storage/' . $absensi->photo_path) }}')">
                                @else
                                    <span class="text-red-500">Foto tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Modal untuk menampilkan gambar besar -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
            <div class="relative bg-white p-4 rounded-lg">
                <button onclick="closeModal()" class="absolute top-2 right-2 bg-red-600 text-white font-bold px-4 py-2 rounded-full hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    &times; Close
                </button>
                <img id="modalImage" src="" alt="Foto Absensi" class="w-full h-auto max-w-lg mx-auto">
            </div>
        </div>
    </div>

    <script>
        function openModal(imageUrl) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageUrl;
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
        }
    </script>
</body>
</html>
