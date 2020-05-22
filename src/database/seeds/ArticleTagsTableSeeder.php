<?php

use Illuminate\Database\Seeder;

class ArticleTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('article_tags')->insert([
            'article_id' => 1,
            'tag_id'     => 1,
        ]);
    }
}
