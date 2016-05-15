<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(LearnCast\Role::class, 1)->create();
        factory(LearnCast\User::class, 1)->create();
        factory(LearnCast\Category::class, 5)->create();
        factory(LearnCast\Video::class, 1)->create();
        factory(LearnCast\Comment::class, 1)->create();
        factory(LearnCast\Favourite::class, 1)->create();
    }
}
