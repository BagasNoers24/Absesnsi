<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JobdeskRecordsSeeder extends Seeder
{
    public function run()
    {
        DB::table('jobdesk_records')->insert([
            [
                'jobdesk' => 'Validasi ODC E2E',
                'nama' => 'Yuma Maulana',
                'hari' => 'Senin',
                'perolehan' => 20,
                'target' => 30,
                'average' => (20 / 30) * 100,
                'keterangan' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'jobdesk' => 'Valins Service',
                'nama' => 'Ganjar',
                'hari' => 'Selasa',
                'perolehan' => 80,
                'target' => 100,
                'average' => (80 / 100) * 100,
                'keterangan' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'jobdesk' => 'Drop Only',
                'nama' => 'Evie Dwiritasari',
                'hari' => 'Rabu',
                'perolehan' => 150,
                'target' => 300,
                'average' => (150 / 300) * 100,
                'keterangan' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'jobdesk' => 'Validasi Egbis',
                'nama' => 'Rian Aditia',
                'hari' => 'Kamis',
                'perolehan' => 40,
                'target' => 50,
                'average' => (40 / 50) * 100,
                'keterangan' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'jobdesk' => 'Rekon Valins PSB',
                'nama' => 'Irvan',
                'hari' => "Jum'at",
                'perolehan' => 150,
                'target' => 200,
                'average' => (150 / 200) * 100,
                'keterangan' => 'Sakit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
