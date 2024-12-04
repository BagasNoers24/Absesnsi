<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobdeskRecord;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportAdmin extends Controller
{
    public function index(Request $request)
    {
        // Tangkap parameter dari request
        $startDate = $request->input('start_date') 
            ? Carbon::parse($request->input('start_date')) 
            : Carbon::now()->subDays(7);
        
        $endDate = $request->input('end_date') 
            ? Carbon::parse($request->input('end_date')) 
            : Carbon::now();

        // Ambil semua jobdesk unik untuk dropdown
        $jobdesks = JobdeskRecord::distinct('jobdesk')->pluck('jobdesk');

        // Filter records dengan kondisi yang fleksibel
        $query = JobdeskRecord::whereBetween('created_at', [$startDate, $endDate]);

        // Tambahkan filter jobdesk jika dipilih
        if ($request->filled('jobdesk')) {
            $query->where('jobdesk', $request->input('jobdesk'));
        }

        // Eksekusi query
        $records = $query->orderBy('created_at', 'desc')->get();

        // Data tambahan
        $users = DB::table('users')->get();
        $workdays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        return view('admin.ReportAdmin', [
            'records' => $records,
            'jobdesks' => $jobdesks,
            'users' => $users,
            'days' => $workdays,
            'startDate' => $startDate->format('Y-m-d'),
            'endDate' => $endDate->format('Y-m-d'),
            'selectedJobdesk' => $request->input('jobdesk')
        ]);
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
