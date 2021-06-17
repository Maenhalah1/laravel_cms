<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $users_ids = \App\User::pluck('id')->toArray();
    return [
        "title" => $faker->sentence,
        "body" => $faker->paragraph,
        "user_id" => $faker->randomElement($users_ids)
    ];
});
