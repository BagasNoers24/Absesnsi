<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobdesk Records</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Tambahkan ini jika jQuery belum dimuat -->
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-1/4 p-4">
            <div class="flex items-center mb-6">
                <img alt="Logo" class="mr-2" height="50" src="https://storage.googleapis.com/a1aa/image/OTBfIoRGKzTel0eyVg6kQSW7JETEkoZTryDS3jfReolgPJVdC.jpg" width="50" />
                <span class="text-xl font-bold">Telkom Indonesia</span>
            </div>
            <nav>
                <ul>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="dashboard">
                            <i class="fas fa-tachometer-alt mr-2"></i> DASHBOARD
                        </a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="{{ route('jobdesk_records.index') }}">
                            <i class="fas fa-tachometer-alt mr-2"></i> REPORT
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="absolute bottom-4 left-4">
                <button class="bg-red-600 p-2 rounded-full">
                    <a href="{{ route('absensi.index') }}" class="fas fa-arrow-left text-white"></a>
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Jobdesk Records</h1>
                <!-- Button Logout -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('jobdesk_records.store') }}" method="POST" class="mt-4">
                @csrf
                <div class="flex space-x-4">
                    <!-- Left Column -->
                    <div class="w-1/2">
                        <div class="mb-4">
                            <label for="jobdesk" class="block text-gray-700">Jobdesk :</label>
                            <select name="jobdesk" id="jobdesk" class="w-full p-2 border rounded bg-gray-200" required onchange="updateTargetAndAverage()">
                                <option value="Drop Only" data-target="300">Drop Only</option>
                                <option value="Validasi ODCE2E" data-target="30">Validasi ODC E2E</option>
                                <option value="Valins Service" data-target="100">Valins Service</option>
                                <option value="Validasi Egbis" data-target="50">Validasi Egbis</option>
                                <option value="Rekon Valins PSB" data-target="200">Rekon Valins PSB</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <div class="mb-4">
                                <label for="nama" class="block text-gray-700">Nama</label>
                                <input type="text" name="nama" id="nama" value="{{ Auth::User()->name }}" class="w-full p-2 border rounded bg-gray-200" readonly>
                            </div>
                        </div>
                    
                        <div class="mb-4">
                            <label for="hari" class="block text-gray-700">Hari</label>
                            <input type="text" name="hari" id="hari" value="{{ \Carbon\Carbon::now()->translatedFormat('l, d-m-Y') }}" class="w-full p-2 border rounded bg-gray-200" readonly>
                        </div>
                    
                        <div class="mb-4">
                            <label for="perolehan" class="block text-gray-700">Perolehan</label>
                            <input type="number" name="perolehan" id="perolehan" class="w-full p-2 border rounded bg-gray-200" required oninput="updateTargetAndAverage()">
                        </div>
                    
                        <div class="mb-4">
                            <label for="keterangan" class="block text-gray-700">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="w-full p-2 border rounded bg-gray-200" rows="3"></textarea>
                        </div>
                    
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                    </div>
                    
                    <!-- Right Column for Target and Average -->
                    <div class="w-1/2">
                        <div class="mb-4">
                            <label for="target" class="block text-gray-700">Target</label>
                            <input type="text" name="target" id="target" class="w-full p-2 border rounded bg-gray-200" readonly>
                        </div>
                        <div class="mb-4">
                            <label for="average" class="block text-gray-700">Achievement</label>
                            <input type="text" name="average" id="average" class="w-full p-2 border rounded bg-gray-200" readonly>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateTargetAndAverage() {
            // Ambil elemen input
            const jobdeskSelect = document.getElementById('jobdesk');
            const targetInput = document.getElementById('target');
            const perolehanInput = document.getElementById('perolehan');
            const averageInput = document.getElementById('average');
    
            // Ambil target dari data atribut option yang dipilih
            const selectedOption = jobdeskSelect.options[jobdeskSelect.selectedIndex];
            const target = selectedOption.getAttribute('data-target');
    
            // Tampilkan target di input target
            targetInput.value = target;
    
            // Hitung average jika perolehan sudah diisi
            const perolehan = parseFloat(perolehanInput.value) || 0;
            const average = target ? ((perolehan / target) * 100).toFixed(2) : 0;
    
            // Tampilkan average di input average
            averageInput.value = `${average}`;
        }
    </script>    

</body>
</html>
