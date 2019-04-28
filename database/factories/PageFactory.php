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

$factory->define(App\Models\Page::class, function (Faker $faker) {
    $name = $faker->name;

    return [
        'title' => $name,
        'slug' => str_slug($name),
        'created_user_id' => rand(1, 50),
        'updated_user_id' => rand(1, 50),
        'content' => $faker->text,
    ];
});