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
    // Mengambil data jobdesk unik
    $jobdesks = JobdeskRecord::distinct('jobdesk')->get(); 

    // Mengambil data lainnya
    $records = JobdeskRecord::all();
    $users = DB::table('users')->get();
    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

    // Kembalikan ke view dengan data yang diperlukan
    return view('jobdesk_records.index', compact('records', 'jobdesks', 'users', 'days'));

}

public function store(Request $request)
{
    $request->validate([
        'jobdesk' => 'required',
        'nama' => 'required',
        'hari' => 'required',
        'perolehan' => 'required|integer|min:0',
        'keterangan' => 'nullable|string',
    ]);

    // Ubah pencarian berdasarkan jobdesk yang dipilih, bukan berdasarkan nama
    $jobdesk = DB::table('jobdesk_records')->where('jobdesk', $request->jobdesk)->first();

    // Cek apakah jobdesk ditemukan
    if (!$jobdesk) {
        return redirect()->back()->with('error', 'Jobdesk tidak ditemukan.');
    }

    $target = $jobdesk->target;
    $average = ($request->perolehan / $target) * 100;

    // Menyimpan data baru
    JobdeskRecord::create([
        'jobdesk' => $request->jobdesk,
        'nama' => $request->nama,
        'hari' => $request->hari,
        'perolehan' => $request->perolehan,
        'target' => $target,
        'average' => $average,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->back()->with('success', 'Data berhasil ditambahkan');
}

}
