<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDeleveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_deleveries', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('dref');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->string('driver');
            $table->string('destination');
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
        Schema::dropIfExists('project_deleveries');
    }
}
