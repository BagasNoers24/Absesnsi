<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi dengan Kamera</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        #camera-preview {
            width: 100%;
            max-width: 400px;
            height: auto;
        }
        #capture {
            display: none;
            margin-top: 10px;
        }
        #alert {
            display: none;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        #alert.success {
            background-color: #d4edda;
            color: #155724;
        }
        #alert.error {
            background-color: #f8d7da;
            color: #721c24;
        }
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
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="dashboard">
                            <i class="fas fa-tachometer-alt mr-2"></i> DASHBOARD
                        </a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="jobdesk_records">
                            <i class="fas fa-database mr-2"></i> REPORT DATA
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="absolute bottom-4 left-4">
                <button class="bg-red-600 p-2 rounded-full">
                    <i class="fas fa-arrow-left text-white"></i>
                </button>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">ABSENSI KEHADIRAN PEGAWAI</h1>
                <div class="flex items-center">
                    <span class="mr-2">Users</span>
                    <div class="bg-gray-300 p-2 rounded-full">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>

            <div id="alert" class="alert"></div> <!-- Alert Box -->

            <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data" class="mt-4" id="absensi-form">
                @csrf
                <div class="flex">
                    <div class="w-1/2">
                        <div class="mb-4">
                            <label for="nama" class="block text-gray-700">Nama</label>
                            <input id="nama" name="nama" type="text" class="w-full p-2 border rounded bg-gray-200" required>
                        </div>
                        <div class="mb-4">
                            <label for="nik" class="block text-gray-700">NIK</label>
                            <input id="nik" name="nik" type="text" class="w-full p-2 border rounded bg-gray-200" required>
                        </div>
                        <div class="mb-4">
                            <label for="jamabsen" class="block text-gray-700">Jam Absen</label>
                            <input id="jamabsen" name="jamabsen" type="text" class="w-full p-2 border rounded bg-gray-200" readonly>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Latitude</label>
                            <input id="latitude" name="latitude" class="w-full p-2 border rounded bg-gray-200" readonly type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Longitude</label>
                            <input id="longitude" name="longitude" class="w-full p-2 border rounded bg-gray-200" readonly type="text">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                    </div>
                    <div class="w-1/2 flex flex-col items-center">
                        <!-- Video stream dari kamera -->
                        <video id="camera-preview" autoplay playsinline></video>
                        <!-- Gambar hasil tangkapan -->
                        <canvas id="capture" width="640" height="480" style="display: none;"></canvas>
                        <input type="hidden" name="photo_path" id="photo_path">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const video = document.getElementById('camera-preview');
            const captureCanvas = document.getElementById('capture');
            const photoDataInput = document.getElementById('photo_path');
            const absensiForm = document.getElementById('absensi-form');
            const alertBox = document.getElementById('alert');
            const jamAbsen = document.getElementById('jamabsen');

            // Fungsi untuk menampilkan alert
            function showAlert(type, message) {
                alertBox.className = type === 'success' ? 'success' : 'error';
                alertBox.textContent = message;
                alertBox.style.display = 'block';
                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 3000);
            }

            // Fungsi untuk memperbarui waktu
            function updateTime() {
                const sekarang = new Date();
                const jam = sekarang.getHours().toString().padStart(2, '0');
                const menit = sekarang.getMinutes().toString().padStart(2, '0');
                const detik = sekarang.getSeconds().toString().padStart(2, '0');
                jamAbsen.value = `${jam}:${menit}:${detik}`;
            }

            // Jalankan fungsi pertama kali untuk menginisialisasi waktu
            updateTime();

            // Perbarui jam setiap detik
            setInterval(updateTime, 1000);

            // Akses lokasi pengguna
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                }, () => showAlert('error', 'Gagal mendapatkan lokasi. Periksa izin lokasi.'));
            }

            // Akses kamera
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                })
                .catch(() => showAlert('error', 'Kamera tidak dapat diakses.'));

            absensiForm.addEventListener('submit', function (event) {
                event.preventDefault();

                captureCanvas.width = video.videoWidth;
                captureCanvas.height = video.videoHeight;
                const context = captureCanvas.getContext('2d');
                context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);

                photoDataInput.value = captureCanvas.toDataURL('image/png');

                if (photoDataInput.value) {
                    showAlert('success', 'Absensi berhasil disimpan!');
                } else {
                    showAlert('error', 'Absensi gagal, coba lagi.');
                }

                absensiForm.submit();
            });
        });
    </script>
</body>
</html>
