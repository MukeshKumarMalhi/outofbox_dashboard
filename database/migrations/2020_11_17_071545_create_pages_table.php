<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('website_id')->nullable();
          $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade')->onUpdate('cascade');
          $table->string('parent_page_id')->nullable();
          $table->string('page_name')->nullable();
          $table->timestamps();
        });

        Schema::table('pages', function($table){
           $table->foreign('parent_page_id')->references('id')->on('pages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
