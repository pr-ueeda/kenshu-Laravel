<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('tags')->insert([
            [
                'tag_name' => 'コロナウイルス',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'tag_name' => 'プログラミング',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
        ]);
    }
}
