<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\src\Models\Coupon::class, function (Faker\Generator $faker) {

    return [
        'codigo' => $faker->unique()->randomNumber(5),
        'descuento' => $faker->unique()->randomFloat(2,0,10),
    ];
});
