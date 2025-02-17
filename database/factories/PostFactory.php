<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->words(4),
        'body' => $faker->paragraph(3),
        'published' => $faker->numberBetween(0,1),
        'user_id' => 1, // @TODO could generate a user here when none is passed through
    ];
});
