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

$factory->define(LearnCast\Role::class, function (Faker\Generator $faker) {
    return [
        'name'       => $faker->name,
        'role'       => 1,
    ];
});

$factory->define(LearnCast\User::class, function (Faker\Generator $faker) {
    return [
        'profile_bio'    => $faker->name,
        'username'       => $faker->name,
        'email'          => $faker->email,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role_id'        => 1,
        'picture_url'    => $faker->url,
    ];
});

$factory->define(LearnCast\Category::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->text,
        'user_id'     => 1,
    ];
});

$factory->define(LearnCast\Video::class, function (Faker\Generator $faker) {
    return [
        'title'       => $faker->name,
        'url'         => $faker->url,
        'description' => $faker->text,
        'category_id' => 1,
        'user_id'     => 1,
        'views'       => 0,
        'favourites'  => 0,
    ];
});

$factory->define(LearnCast\Comment::class, function (Faker\Generator $faker) {
    return [
        'comment'  => $faker->name,
        'video_id' => 1,
        'user_id'  => 1,
    ];

});

$factory->define(LearnCast\Favourite::class, function (Faker\Generator $faker) {
    return [
        'video_id' => 1,
        'user_id'  => 1,
    ];

});
