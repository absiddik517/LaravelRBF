<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_bills', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->date('first_date');
            $table->date('last_date');
            $table->longText('quantity');
            $table->integer('sub_total');
            $table->integer('advance_cutting')->default(0);
            $table->integer('previous_due')->default(0);
            $table->integer('transport')->default(0);
            $table->integer('total');
            $table->date('date');
            $table->integer('user_id');
            
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
        Schema::dropIfExists('project_bills');
    }
}
