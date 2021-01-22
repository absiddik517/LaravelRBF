<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeleveryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('delevery_products', function (Blueprint $table) {
            $table->id();
            $table->integer('ref');
            $table->integer('d_ref')->unique();
            $table->integer('quantity');
            $table->string('driver');
            $table->string('destination');
            $table->integer('user_id');
            $table->date('date');
            $table->timestamps();

            $table->foreign('ref')->references('ref')->on('sells');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delevery_products');
    }
}
