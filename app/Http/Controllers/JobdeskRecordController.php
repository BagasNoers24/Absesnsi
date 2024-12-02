<?php

namespace App\Http\Controllers;

use App\Models\JobdeskRecord;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JobdeskRecordController extends Controller
{
    public function index()
{
    $records = JobdeskRecord::all(); // Menggunakan Eloquent
    $jobdesks = JobdeskRecord::distinct('jobdesk')->get(); // Ambil semua jobdesk unik
    $users = DB::table('users')->get();
    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

    return view('jobdesk_records.index', compact('records'));
}


public function store(Request $request)
{
    $request->validate([
        'jobdesk' => 'required|string',
        'nama' => 'required|string',
        'hari' => 'required|string',
        'perolehan' => 'required|integer|min:0',
        'keterangan' => 'nullable|string',
    ]);

    // Tentukan target default jika tidak ditemukan
    // $target = $request->target ?? 100; // Misalnya target default adalah 100
    // $average = ($request->perolehan / $target) * 100;

    // Simpan data baru
    JobdeskRecord::create([
        'jobdesk' => $request->jobdesk,
        'nama' => $request->nama,
        'hari' => $request->hari,
        'perolehan' => $request->perolehan,
        'target' => $request->target,
        'average' => $request->average,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->back()->with('success', 'Data berhasil ditambahkan');
}

}


