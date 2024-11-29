<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    // Menampilkan daftar absensi
    public function index()
    {

    // Mengambil semua data absensi dari database
        $absensis = Absensi::all();
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
        'photo_path' => 'required|string',
    ]);

    // Mengambil data foto
    $photoData = $request->input('photo_path');
    $photoPath = null;

    if ($photoData) {
        // Decode base64 menjadi gambar
        $photo = base64_decode(str_replace('data:image/png;base64,', '', $photoData));

        // Buat nama file unik
        $fileName = 'absensi_' . time() . '.png';

        // Simpan gambar di folder 'public/absensi'
        $filePath = 'public/absensi/' . $fileName;
        Storage::put($filePath, $photo);

        // Simpan path gambar (tanpa 'public/') ke dalam database
        $photoPath = str_replace('public/', '', $filePath);
    }

    // Menyimpan data absensi
    Absensi::create([
        'nama' => $request->nama,
        'nik' => $request->nik,
        'jamabsen' => $request->jamabsen,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'photo_path' => $photoPath,
    ]);

    return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil disimpan!');
}

    // Menampilkan detail absensi
    public function show(Absensi $absensi)
    {
        $absensis = Absensi::all();
        return view('absensi.show', compact('absensis'));
    }
}