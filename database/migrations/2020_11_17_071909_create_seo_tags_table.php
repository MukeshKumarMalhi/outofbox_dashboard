<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_tags', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('page_id')->nullable();
          $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade')->onUpdate('cascade');
          $table->string('title')->nullable();
          $table->text('description')->nullable();
          $table->string('keyword')->nullable();
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
        Schema::dropIfExists('seo_tags');
    }
}
