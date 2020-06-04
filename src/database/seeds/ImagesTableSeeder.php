<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('images')->insert([
            [
                'image_url' => '/storage/images/no image.jpg',
                'updated_at' => new DateTime(),
                'created_at' => new DateTime()
            ],
                [
                    'image_url' => '/storage/images/no image.jpg',
                    'updated_at' => new DateTime(),
                    'created_at' => new DateTime()
                ]
            ]);
    }
}
