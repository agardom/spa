<?php

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

$factory->define(\spa\Service\Service::class, function (Faker $faker) {
    return [
        'id' => $faker->randomDigitNotNull(),
        'price' => $faker->randomFloat(2, 70, 150),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
