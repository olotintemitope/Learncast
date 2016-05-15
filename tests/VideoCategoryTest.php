<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoCategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testVideoCategoryWasVisited()
    {
        $user = $this->createUserWithSuperAdminRole();

        $this->actingAs($user)->visit('/dashboard/category/add')
       ->see('/dashboard/category/create');
    }

    public function testThatVideoCategoryWasAddedEalier()
    {
        $user = $this->createUserWithSuperAdminRole();

        $category = factory('LearnCast\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
            ]);

        $this->actingAs($user)->visit('/dashboard/category/add')
             ->type('Javascript', 'name')
             ->type('It is the language of the web', 'description')
             ->press('Create')
             ->see('The name has already been taken.');
    }

    public function testThatVideoCategoryWasSuccessful()
    {
        $user = $this->createUserWithSuperAdminRole();

        $category = factory('LearnCast\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
            ]);

        $this->actingAs($user)->visit('/dashboard/category/add')
             ->type('Python2', 'name')
             ->type('Python is a widely used high-level, general-purpose, interpreted, dynamic programming language.', 'description')
             ->press('Create')
             ->see('Sucessfully created!');
    }

    public function testThatVideoCategoryNameFieldIsMissing()
    {
        $user = $this->createUserWithSuperAdminRole();

        $category = factory('LearnCast\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
        ]);

        $this->actingAs($user)->visit('/dashboard/category/add')
             ->type('Python is a widely used high-level language.', 'description')
             ->press('Create')
             ->see('The name field is required.');
    }

    public function testThatVideoCategoryDescriptionFieldIsMissing()
    {
        $user = $this->createUserWithSuperAdminRole();

        $category = factory('LearnCast\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
        ]);

        $this->actingAs($user)->visit('/dashboard/category/add')
             ->type('Java', 'name')
             ->press('Create')
             ->see('The description field is required.');
    }

    public function testThatVideoCategoryFieldsAreMissing()
    {
        $user = $this->createUserWithSuperAdminRole();

        $category = factory('LearnCast\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
        ]);

        $this->actingAs($user)->visit('/dashboard/category/add')
             ->press('Create')
             ->see('The name field is required.')
             ->see('The description field is required.');
    }

    public function testThatVideoCategoryWasUpdated()
    {
        $user = $this->createUserWithSuperAdminRole();

        $category = factory('LearnCast\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
        ]);

        $this->actingAs($user)->visit('/dashboard/category/edit/'.$category->id)
          ->type('Javascript 2.0', 'name')
          ->type('It is the language of the Html', 'description')
          ->press('Update')
          ->seePageIs('/dashboard/category/view')
          ->see('Javascript');
    }

    public function testThatASingleCategoryWasRetrived()
    {
        $user = $this->createUserWithSuperAdminRole();

        $category = factory('LearnCast\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
        ]);

        $this->actingAs($user)->visit('/dashboard/category/edit/'.$category->id)
         ->see($category->name);
    }

    public function testThatASingleCategoryWasNotRetrived()
    {
        $user = $this->createUserWithSuperAdminRole();

        $category = factory('LearnCast\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
        ]);

        $this->actingAs($user)->visit('/dashboard/category/edit/100')
         ->seePageIs('/dashboard/category/add')
         ->see('Oops! unauthorized access to video category!');
    }

    public function testgetAllCategories()
    {
        $user = $this->createUserWithSuperAdminRole();

        $categories = factory('LearnCast\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
        ]);

        $this->actingAs($user)->visit('/dashboard/category/view')
        ->see($categories->name);

        $this->assertArrayHasKey('id', $categories->toArray());
        $this->assertArrayHasKey('name', $categories->toArray());
        $this->assertArrayHasKey('description', $categories->toArray());
        $this->assertArrayHasKey('user_id', $categories->toArray());
    }

    public function testchangeCategoryStatus()
    {
        $user = $this->createUserWithSuperAdminRole();

        $category = factory('LearnCast\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
        ]);

        $this->actingAs($user)->visit('/dashboard/category/delete/1')
       ->see('Operation Successfully');
    }

    public function createUserWithSuperAdminRole()
    {
        $user = factory('LearnCast\User')->create([
            'username'       => 'prosper',
            'email'          => 'ginger.prosper@php.io',
            'password'       => bcrypt(str_random(10)),
            'remember_token' => str_random(10),
            'role_id'        => 2,
            'picture_url'    => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
            'profile_bio'    => 'PHP awesome evangelist',
        ]);

        return $user;
    }

    public function testGetVideosByCategory()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create();

        $video = factory('LearnCast\Video')->create([
            'title'        => 'Haskell',
            'description'  => 'It is the language of the web',
            'user_id'      => $user->id,
            'category_id'  => $category->id,
            'views'        => 0,
            'favourites'   => 0,
        ]);

        $this->visit('video/category/'.$category->name)
        ->see($category->name)
        ->see($video->title)
        ->see($video->description); 
    }

    public function testThatVideosHasNotBeenUploadedForACategory()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create();

        $video = factory('LearnCast\Video')->create();

        $this->visit('video/category/Ginger')
        ->see('Oops! videos are not available for display!'); 
    }
}
