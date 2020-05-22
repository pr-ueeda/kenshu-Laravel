<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatArticleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_images', function (Blueprint $table) {
           $table->increments('article_image_id');
           $table->integer('article_id')->unsigned();
           $table->integer('image_id')->unsigned();

           $table->foreign('article_id')
               ->references('article_id')
               ->on('articles')
               ->onDelete('cascade');

           $table->foreign('image_id')
               ->references('image_id')
               ->on('images')
               ->onDelete('cascade')
               ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_images');
    }
}
