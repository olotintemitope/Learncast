<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoCategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testVideoCategoryWasVisited()
    {
      $user = factory('App\User')->create();

      $this->actingAs($user)->visit('/dashboard/category/add')
       ->see('/dashboard/category/create');
    }

    public function testThatVideoCategoryWasAddedEalier()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
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
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
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
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
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
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
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
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
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
       $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
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
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
        ]);

        $this->actingAs($user)->visit('/dashboard/category/edit/'.$category->id)
         ->see($category->name);
    }

    public function testgetAllCategories()
    {
        $user = factory('App\User')->create();

        $categories = factory('App\Category')->create([
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
       $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'name'        => 'Javascript',
            'description' => 'It is the language of the web',
            'user_id'     => $user->id,
        ]);

       $this->actingAs($user)->visit('/dashboard/category/delete/1')
       ->see('Operation Successfully');
        
    }

}