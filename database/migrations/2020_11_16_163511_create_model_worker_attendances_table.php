<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelWorkerAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('worker_id');
            $table->integer('selery');
            $table->date('date');
            $table->enum('status', ['Present', 'Absent']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker_attendances');
    }
}
