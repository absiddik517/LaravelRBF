<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preloads', function (Blueprint $table) {
            $table->id();
            $table->integer('party_id');
            $table->integer('item_id');
            $table->integer('quantity');
            $table->string('description')->nullable();
            $table->integer('amount');
            $table->integer('user_id');
            $table->date('date');
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
        Schema::dropIfExists('preloads');
    }
}
