<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->integer('party_type');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->integer('deal')->nullable();
            $table->string('rate')->nullable();
            $table->integer('advance')->nullable();
            $table->string('cutting_rate')->nullable();
            $table->string('billing_day')->nullable();
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
        Schema::dropIfExists('parties');
    }
}
