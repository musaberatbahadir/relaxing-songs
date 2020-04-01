<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Song;
use Faker\Generator as Faker;

$factory->define(Song::class, function (Faker $faker) {
    $categories = \App\Category::all()->pluck('id')
        ->toArray();

    return [
        'name' => $faker->colorName,
        'singer' => $faker->firstName . ' ' . $faker->lastName,
        'category_id' => empty($categories) ? null : $categories[array_rand($categories)]
    ];
});
