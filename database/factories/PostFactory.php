<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->sentence(6),
        'content' => $faker->paragraph(4),
        'category_id' => 1,
        'published_at' => $faker->dateTime,
        'image' => $faker->imageUrl(),
    ];
});
