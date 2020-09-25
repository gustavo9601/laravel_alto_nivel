<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    $filename = $faker->numberBetween($min = 1, $max = 10) . '.jpg';
    return [
        'path' => "img/products/{$filename}"
    ];
});

// Un factory de estado
// le ponemos un nombre/state para que pueda ser llamado desde otras factorias
$factory->state(Image::class, 'user', function (Faker $faker) {
    $filename = $faker->numberBetween($min = 1, $max = 6) . '.jpg';
    return [
        'path' => "img/users/{$filename}"
    ];
});
