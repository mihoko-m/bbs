<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(10),
        'body' => $faker->realText(50),
        'get_credit' => $faker->numberBetween(1,5),
        'adequacy' => $faker->numberBetween(1,5),
        'created_at' => now()
        //
    ];
});
