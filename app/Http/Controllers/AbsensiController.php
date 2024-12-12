<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    // Menampilkan daftar absensi
    public function index()
{
    $absensis = Absensi::all()->map(function ($absensi) {
        $absensi->hari = \Carbon\Carbon::parse($absensi->created_at)->translatedFormat('l');
        $absensi->tanggal = \Carbon\Carbon::parse($absensi->created_at)->format('d-m-Y');
        $absensi->status = ($absensi->jamabsen <= '08:00:00') ? 'Tepat Waktu' : 'Terlambat';
        $absensi->warna = ($absensi->jamabsen <= '08:00:00') ? 'text-green-500' : 'text-orange-500';
        return $absensi;
    });
    

    return view('absensi.index', compact('absensis'));
}


    public function create()
    {
        return view('absensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'jamabsen' => 'required|date_format:H:i:s',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'photo_path' => 'required|string', // foto dalam base64
        ]);

        // Periksa apakah pengguna sudah absen hari ini
            $today = now()->toDateString();
            $alreadyAbsen = Absensi::where('nik', auth()->user()->nik)
                ->whereDate('created_at', $today)
                ->exists();

    if ($alreadyAbsen) {
        return redirect()->back()->withErrors(['error' => 'Anda sudah melakukan absensi hari ini.']);
    }
        // Mengambil data foto (base64)
        $photoData = $request->input('photo_path');
        $photoPath = null;

        if ($photoData) {
            // Decode base64 menjadi gambar
            $photo = base64_decode(str_replace('data:image/png;base64,', '', $photoData));

            // Buat nama file unik untuk foto
            $fileName = 'absensi_' . time() . '.png';

            // Tentukan path di folder 'public/absensi'
            $filePath = 'absensi/' . $fileName;

            // Simpan gambar di storage/public/absensi
            Storage::disk('public')->put($filePath, $photo);

            // Simpan path foto relatif di dalam database
            $photoPath = $filePath;
        }

        // Menyimpan data absensi ke database
        Absensi::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jamabsen' => $request->jamabsen,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'photo_path' => $photoPath, // menyimpan path file relatif
        ]);

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil disimpan!');
    }

    // Menampilkan detail absensi
    public function show(Absensi $absensi)
    {
        return view('absensi.show', compact('absensi'));
    }
}
