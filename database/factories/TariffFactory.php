<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tariff;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Tariff::class, function (Faker $faker) {
    return [
        'name' => 'Тариф ' . $faker->unique()->text(10),
        'condition' => 'Условия ' . \n . $faker->text,
        'created_at' => now(),
    ];
});
