<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('website_id')->nullable();
          $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade')->onUpdate('cascade');
          $table->string('blog_title')->nullable();
          $table->text('blog_description')->nullable();
          $table->string('blog_image')->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
