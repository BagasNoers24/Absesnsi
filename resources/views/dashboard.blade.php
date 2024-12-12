<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 min-h-screen">
                <!-- Header -->
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                    </div>
                </header>
            
                <!-- Main Content -->
                <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-600">Total Karyawan</h3>
                            <p class="mt-2 text-3xl font-bold text-gray-900">120</p>
                        </div>
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-600">Kehadiran Hari Ini</h3>
                            <p class="mt-2 text-3xl font-bold text-green-600">98%</p>
                        </div>
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-600">Izin Hari Ini</h3>
                            <p class="mt-2 text-3xl font-bold text-red-600">5</p>
                        </div>
                    </div>
            
                    <!-- Charts Section -->
                    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white shadow rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-600">Grafik Kehadiran</h3>
                            <div class="mt-4 h-64 flex items-center justify-center text-gray-400">
                                <!-- Placeholder for chart -->
                                <span>Grafik Kehadiran (Integrasikan dengan Chart.js atau Laravel Charts)</span>
                            </div>
                        </div>
                        <div class="bg-white shadow rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-600">Grafik Izin dan Absen</h3>
                            <div class="mt-4 h-64 flex items-center justify-center text-gray-400">
                                <!-- Placeholder for chart -->
                                <span>Grafik Izin dan Absen (Integrasikan dengan Chart.js atau Laravel Charts)</span>
                            </div>
                        </div>
                    </div>
            
                    <!-- Recent Activities Section -->
                    <div class="mt-8 bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-600">Daftar Kehadiran Terbaru</h3>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full table-auto border-collapse border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Nama</th>
                                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Status</th>
                                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Waktu Masuk</th>
                                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Waktu Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-t">
                                        <td class="px-4 py-2 text-gray-800">John Doe</td>
                                        <td class="px-4 py-2 text-green-600">Hadir</td>
                                        <td class="px-4 py-2 text-gray-600">08:00</td>
                                        <td class="px-4 py-2 text-gray-600">17:00</td>
                                    </tr>
                                    <tr class="border-t">
                                        <td class="px-4 py-2 text-gray-800">Jane Smith</td>
                                        <td class="px-4 py-2 text-yellow-600">Izin</td>
                                        <td class="px-4 py-2 text-gray-600">-</td>
                                        <td class="px-4 py-2 text-gray-600">-</td>
                                    </tr>
                                    <tr class="border-t">
                                        <td class="px-4 py-2 text-gray-800">Alice Johnson</td>
                                        <td class="px-4 py-2 text-red-600">Absen</td>
                                        <td class="px-4 py-2 text-gray-600">-</td>
                                        <td class="px-4 py-2 text-gray-600">-</td>
                                    </tr>
                                    <script>
                                        // Data dari Laravel
                                        const attendanceData = @json($kehadiran);
                                        const izinData = @json($izin);
                                        const absenData = @json($absen);
                                    
                                        // Konversi ke format grafik
                                        const labels = Object.keys(attendanceData); // Ambil tanggal
                                        const attendanceValues = Object.values(attendanceData); // Ambil jumlah kehadiran
                                        const izinValues = Object.values(izinData); // Ambil jumlah izin
                                        const absenValues = Object.values(absenData); // Ambil jumlah absen

                                        const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(attendanceCtx, {
        type: 'line',
        data: {
            labels: labels, // Tanggal
            datasets: [{
                label: 'Kehadiran',
                data: attendanceValues, // Data kehadiran
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
            },
        },
    }); 
                                    </script>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
            
            </div>
        </div>
    </div>
</x-app-layout>
