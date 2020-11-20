<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('category_id')->nullable();
          $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
          $table->string('industry_id')->nullable();
          $table->foreign('industry_id')->references('id')->on('industries')->onDelete('cascade')->onUpdate('cascade');
          $table->text('images')->nullable();
          $table->string('title')->nullable();
          $table->string('sub_title')->nullable();
          $table->text('body_text')->nullable();
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
        Schema::dropIfExists('portfolios');
    }
}
