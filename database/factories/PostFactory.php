<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->sentence(6),
        'content' => $faker->text(2000),
        'category_id' => 1,
        'published_at' => $faker->dateTime,
        'image' => $faker->imageUrl(),
        'user_id' => User::where('email', '=', 'jcazallasc@gmail.com')->first(),
    ];
});
