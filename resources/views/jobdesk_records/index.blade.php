<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobdesk Records</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" /> </script>
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
                            <label for="jobdesk" class="block text-gray-700">Jobdesk</label>
                            <select name="jobdesk" id="jobdesk" class="w-full p-2 border rounded bg-gray-200" required>
                                <option value="">Pilih Jobdesk</option>
                                @foreach($jobdesks as $jobdesk)
                                    <option value="{{ $jobdesk->jobdesk }}" data-target="{{ $jobdesk->target }}">{{ $jobdesk->jobdesk }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        
                        <div class="mb-4">
                            <label for="nama" class="block text-gray-700">Nama</label>
                            <select name="nama" id="nama" class="w-full p-2 border rounded bg-gray-200" required>
                                <option value="">Pilih Nama</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="hari" class="block text-gray-700">Hari</label>
                            <select name="hari" id="hari" class="w-full p-2 border rounded bg-gray-200" required>
                                <option value="">Pilih Hari</option>
                                @foreach($days as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="perolehan" class="block text-gray-700">Perolehan</label>
                            <input type="number" name="perolehan" id="perolehan" class="w-full p-2 border rounded bg-gray-200" required>
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
                            <label for="average" class="block text-gray-700">Average</label>
                            <input type="text" name="average" id="average" class="w-full p-2 border rounded bg-gray-200" readonly>
                        </div>
                    </div>
                </div>
            </form>

            {{-- <h2 class="text-xl font-semibold mt-8">Daftar Jobdesk Records</h2>
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
            </table> --}}
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Update target field when jobdesk changes
            $('#jobdesk').on('change', function () {
                var selectedJobdesk = $(this).find('option:selected');
                var target = selectedJobdesk.data('target');
    
                // Set target field
                $('#target').val(target || 0);
    
                // Recalculate average if perolehan is already entered
                calculateAverage();
            });
    
            // Recalculate average when perolehan changes
            $('#perolehan').on('input', function () {
                calculateAverage();
            });
    
            // Function to calculate average
            function calculateAverage() {
                var target = parseFloat($('#target').val()) || 0;
                var perolehan = parseFloat($('#perolehan').val()) || 0;
    
                if (target > 0) {
                    var average = (perolehan / target) * 100;
                    $('#average').val(average.toFixed(2)); // Set average field
                } else {
                    $('#average').val('0.00'); // Default to 0 if no target
                }
            }
        });
    </script>
    

</body>
</html>
