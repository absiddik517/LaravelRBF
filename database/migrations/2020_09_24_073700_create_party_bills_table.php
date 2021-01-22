<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartyBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_bill', function (Blueprint $table) {
            $table->id();
            $table->integer('party_id');
            $table->date('first_date');
            $table->date('last_date');
            $table->integer('selery');
            $table->integer('paid');
            $table->integer('advance');
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
        Schema::dropIfExists('party_bill');
    }
}
