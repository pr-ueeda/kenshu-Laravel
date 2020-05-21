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
           $table->id('article_tag');
           $table->integer('article_id');
           $table->integer('tag_id');

           $table->foreign('article_id')
               ->references('article_id')
               ->on('articles')
               ->onDelete('cascade');
           $table->foreign('tag_id')
               ->references('tag_id')
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
        //
    }
}
