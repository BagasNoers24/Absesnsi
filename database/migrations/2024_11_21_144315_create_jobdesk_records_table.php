<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobdeskRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobdesk_records', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('jobdesk'); // Nama Jobdesk
            $table->string('nama'); // Nama User
            $table->string('hari'); // Hari
            $table->integer('perolehan'); // Perolehan
            $table->integer('target'); // Target
            $table->decimal('average', 5, 2); // Average, dengan skala 2 desimal
            $table->string('keterangan')->nullable(); // Keterangan tambahan (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobdesk_records');
    }
}
