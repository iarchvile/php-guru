<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Goods;
use Faker\Generator as Faker;

$factory->define(Goods::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'price' => $faker->randomFloat(null, 0.1, 1000000),
        'photo' => 'https://loremflickr.com/338/240/cats/all?r='.$faker->unique()->randomNumber(),
        'photos' => [
            'https://loremflickr.com/338/240/cats/all?r='.$faker->unique()->randomNumber(),
            'https://loremflickr.com/338/240/cats/all?r='.$faker->unique()->randomNumber(),
        ],
    ];
});