<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models;
use Faker\Generator as Faker;

$factory->define(Models\Article::class, function (Faker $faker) {
    return [
        'title'     => $faker->sentence(10),
        'body'      => $faker->paragraph(),
    ];
});

$factory->define(Models\Tag::class, function () {
    return [
        'tag_name' => 'laravel'
    ];
});

$factory->define(Models\Image::class, function () {
    return [
        'image_url' => 'http://.......'
    ];
});
