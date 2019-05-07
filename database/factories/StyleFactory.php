<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Style::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph
    ];
});
