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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'forename' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret', // secret
        'validated' => $faker->numberBetween(0,1),
    ];
});

$factory->define(App\Department::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->jobTitle
    ];
});

$factory->define(App\DepartmentShortcut::class, function (Faker $faker) {
    return [
        'category' => 'category_'.$faker->numberBetween(1,10),
        'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'description' => $faker->sentence($nbWords = 25, $variableNbWords = true),
        'link' => $faker->url // secret
    ];
});

$factory->define(App\UserShortcut::class, function (Faker $faker) {
    return [
        'category' => 'category_'.$faker->numberBetween(1,10),
        'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'description' => $faker->sentence($nbWords = 25, $variableNbWords = true),
        'link' => $faker->url // secret
    ];
});
