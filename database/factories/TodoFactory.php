<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Todo::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(4),
        'description' => $faker->paragraph(3),
        'completed' => false,
    ];
});
