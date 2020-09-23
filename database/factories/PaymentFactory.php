<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat($maxDecimals = 2, $min = 10, $max = 1000),
        // factory que permite generar fechas aleatorias pasando los siugientes parametros
        'payed_at' => $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now', $timezone = null),
        // order_id
    ];
});
