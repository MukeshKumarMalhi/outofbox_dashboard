<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_images', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('portfolio_id')->nullable();
          $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade')->onUpdate('cascade');
          $table->string('image_url')->nullable();
          $table->string('image_name')->nullable();
          $table->string('image_type')->nullable();
          $table->string('image_size')->nullable();
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
        Schema::dropIfExists('portfolio_images');
    }
}
