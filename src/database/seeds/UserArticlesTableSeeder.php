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
            'id'    => 1,
            'article_id' => 1
        ]);
    }
}
