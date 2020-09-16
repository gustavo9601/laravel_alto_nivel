<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'description' => $faker->paragraph(5),
        'price' => $faker->randomFloat($maxDecimals = 2, $min = 10, $max = 1000), // Numero aleatorio entre 10 y 1000 con maximo de 2 decimales
        'stock' => $faker->numberBetween(1, 100),
        'status' => $faker->randomElement(['available', 'unavailable'])
    ];
});
