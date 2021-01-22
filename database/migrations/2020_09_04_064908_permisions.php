<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Permisions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rule_id');
            $table->unsignedTinyInteger('insert_access')->default(0);
            $table->unsignedTinyInteger('update_access')->default(0);
            $table->unsignedTinyInteger('delete_access')->default(0);
            $table->unsignedTinyInteger('rule_access')->default(0);
            $table->unsignedTinyInteger('permission_access')->default(0);
            $table->unsignedTinyInteger('user_access')->default(0);
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
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
        Schema::drop('permissions');
    }
}
