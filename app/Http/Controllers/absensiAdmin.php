<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Storage;

class absensiAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data absensi
        $absensis = Absensi::all();
        // Mengirim data ke view
        return view('admin.reportAbsen', compact('absensis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'jamabsen' => 'required|date_format:H:i:s',
            'photo_path' => 'required|string|regex:/^data:image\/(png|jpeg);base64,/',
        ]);

        // Mengambil data gambar base64
        $photoData = $request->input('photo_path');
        $photoPath = null;

        if ($photoData) {
            // Mendekode base64 menjadi gambar
            if (strpos($photoData, 'data:image/png;base64,') !== false) {
                $photo = base64_decode(str_replace('data:image/png;base64,', '', $photoData));
                $extension = 'png';
            } elseif (strpos($photoData, 'data:image/jpeg;base64,') !== false) {
                $photo = base64_decode(str_replace('data:image/jpeg;base64,', '', $photoData));
                $extension = 'jpg';
            } else {
                return redirect()->back()->with('error', 'Format gambar tidak didukung.');
            }

            // Membuat nama file unik
            $fileName = 'absensi_' . time() . '.' . $extension;

            // Menyimpan gambar di storage
            $filePath = 'public/absensi/' . $fileName;
            Storage::put($filePath, $photo);

            // Menyimpan path gambar untuk database
            $photoPath = str_replace('public/', '', $filePath);
        }

        // Menyimpan data absensi ke database
        Absensi::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jamabsen' => $request->jamabsen,
            'photo_path' => $photoPath,
        ]);

        return redirect()->route('admin.absensi')->with('success', 'Data absensi berhasil disimpan!');
    }
}
