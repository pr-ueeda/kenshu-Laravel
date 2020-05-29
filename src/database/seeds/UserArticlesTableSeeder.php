<?php

use Illuminate\Database\Seeder;

class UserArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('user_articles')->insert([
            [
                'user_id'    => 1,
                'article_id' => 1
            ],
            [
                'user_id' => 1,
                'article_id' => 2
            ]
        ]);
    }
}
