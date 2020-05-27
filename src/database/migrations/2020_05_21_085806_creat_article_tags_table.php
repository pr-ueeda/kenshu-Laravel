<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatArticleTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tags', function (Blueprint $table) {
           $table->increments('article_tag');
           $table->integer('article_id')->unsigned();
           $table->integer('tag_id')->unsigned();

           $table->foreign('article_id')
               ->references('id')
               ->on('articles')
               ->onDelete('cascade');
           $table->foreign('tag_id')
               ->references('id')
               ->on('tags')
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
        Schema::dropIfExists('article_tags');
    }
}
