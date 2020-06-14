<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Task::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create([
                'password' => bcrypt('password')
                ])->id;
        },
        'task_name' => $faker->sentence(10)
    ];
});
