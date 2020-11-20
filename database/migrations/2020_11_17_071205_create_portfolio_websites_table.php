<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_websites', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('portfolio_id')->nullable();
          $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade')->onUpdate('cascade');
          $table->string('website_id')->nullable();
          $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('portfolio_websites');
    }
}
