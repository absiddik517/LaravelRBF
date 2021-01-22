<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('billing_system', ['Daily', 'Weekly', 'Monthly', 'Undefined']);
            $table->string('task');
            $table->enum('allow_advance', ['true', 'false']);
            $table->enum('allow_daily_advance', ['true', 'false']);
            $table->enum('allow_preload', ['true', 'false']);
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
        Schema::dropIfExists('party_types');
    }
}
