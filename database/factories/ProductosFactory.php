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
$factory->define(App\src\Models\Product2::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->name(5),
        'precio' => $faker->randomFloat(2,0,100),
        'unidades_id' => $faker->numberBetween(1, 3),
    ];
});
