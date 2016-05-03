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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username'       => $faker->name,
        'email'          => $faker->email,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role_id' => 1,
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->text,
        'user_id'     => 1,
    ];
});

$factory->define(App\Video::class, function (Faker\Generator $faker) {
    return [
        'title'       => $faker->name,
        'url'         => $faker->url,
        'description' => $faker->text,
        'category_id' => 1,
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name'       => $faker->name,
        'role'       => 1,
    ];
});

