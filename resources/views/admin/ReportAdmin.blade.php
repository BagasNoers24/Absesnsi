<!-- resources/views/admin/ReportAdmin.blade.php -->

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

        {{-- Main content --}}
        <main class="flex-1 p-6">
            <h2 class="text-xl font-semibold mt-8">Daftar Jobdesk Records</h2>
            <table class="min-w-full table-auto mt-4 border-collapse">
                <thead>
                    <tr class="bg-gray-300">
                        <th class="py-2 px-4">Jobdesk</th>
                        <th class="py-2 px-4">Nama</th>
                        <th class="py-2 px-4">Hari</th>
                        <th class="py-2 px-4">Perolehan</th>
                        <th class="py-2 px-4">Target</th>
                        <th class="py-2 px-4">Average</th>
                        <th class="py-2 px-4">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ $record->jobdesk }}</td>
                            <td class="py-2 px-4">{{ $record->nama }}</td>
                            <td class="py-2 px-4">{{ $record->hari }}</td>
                            <td class="py-2 px-4">{{ $record->perolehan }}</td>
                            <td class="py-2 px-4">{{ $record->target }}</td>
                            <td class="py-2 px-4">{{ $record->average }}</td>
                            <td class="py-2 px-4">{{ $record->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>