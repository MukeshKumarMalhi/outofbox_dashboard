<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layouts', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('page_id')->nullable();
          $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade')->onUpdate('cascade');
          $table->string('building_block_id')->nullable();
          $table->foreign('building_block_id')->references('id')->on('building_blocks')->onDelete('cascade')->onUpdate('cascade');
          $table->integer('layout_order')->nullable();
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
        Schema::dropIfExists('layouts');
    }
}
