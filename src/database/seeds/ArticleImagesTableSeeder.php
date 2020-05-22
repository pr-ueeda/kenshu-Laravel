<?php

use Illuminate\Database\Seeder;

class ArticleImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('article_images')->insert([
            'article_id' => 1,
            'image_id'   => 1
        ]);
    }
}
