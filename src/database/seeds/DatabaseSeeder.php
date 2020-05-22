<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ArticlesTableSeeder::class,
            UserArticlesTableSeeder::class,
            ImagesTableSeeder::class,
            ArticleImagesTableSeeder::class,
            TagsTableSeeder::class,
            ArticleTagsTableSeeder::class,
            ThumbnailsTableSeeder::class
        ]);
    }
}
