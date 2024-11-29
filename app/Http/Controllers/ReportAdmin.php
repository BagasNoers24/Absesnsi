<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobdeskRecord;
use Illuminate\Support\Facades\DB;

class ReportAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = JobdeskRecord::all(); // Mengambil semua record
        $jobdesks = JobdeskRecord::distinct('jobdesk')->get(); // Ambil semua jobdesk unik
        $users = DB::table('users')->get(); // Ambil semua pengguna
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']; // Daftar hari

        // Kembalikan view dengan data yang diperlukan
        return view('admin.ReportAdmin', compact('records', 'jobdesks', 'users', 'days'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
