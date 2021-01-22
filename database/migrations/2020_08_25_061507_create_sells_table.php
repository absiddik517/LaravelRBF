<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->integer('ref')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->string('rate');
            $table->string('transport_rate');
            $table->integer('quantity');
            $table->integer('product_price');
            $table->integer('transport');
            $table->integer('total');
            $table->integer('paid')->nullable();
            $table->integer('due')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sells');
    }
}
