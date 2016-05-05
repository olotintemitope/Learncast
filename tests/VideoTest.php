<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoTest extends TestCase
{
    use DatabaseTransactions;

    public function testVideoWasVisited()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->see('/dashboard/video/create');
    }

    public function testThatVideoWasAddedEalier()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->select($category->id, 'category')
             ->type('Regular expression in Javascript', 'title')
             ->type('https://www.youtube.com/watch?v=9vN2IdeALaI', 'url')
             ->type('It is the language of the web', 'description')
             ->press('Create')
             ->see('Sucessfully created!');

    }

    public function testThatCreateVideoWasSuccessful()
    {

        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->select($category->id, 'category')
             ->type('Asynchronous Task in Javascript', 'title')
             ->type('https://www.youtube.com/watch?v=9vN2IdeALaJ', 'url')
             ->type('Asynchronous Task of the web', 'description')
             ->press('Create')
             ->see('Sucessfully created!');

    }

    public function testThatAllFieldsAreMissingExceptDescription()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->type('Asynchronous Task in Javascrip', 'description')
             ->press('Create')
             ->see('The title field is required.')
             ->see('The category field is required.')
             ->see('The url field is required.');

    }

    public function testThatAllFieldsAreMissingExceptTitle()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->type('Asynchronous Task in Javascript', 'title')
             ->press('Create')
             ->see('The description field is required.')
             ->see('The category field is required.')
             ->see('The url field is required.');

    }

    public function testThatAllFieldsAreMissingExceptUrl()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->type('https://www.youtube.com/watch?v=eUJUOxPpiQc', 'url')
             ->press('Create')
             ->see('The title field is required.')
             ->see('The category field is required.')
             ->see('The description field is required.');

    }

    public function testThatAllFieldsAreMissingExceptCategory()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->type($category->id, 'category')
             ->press('Create')
             ->see('The title field is required.')
             ->see('The url field is required.')
             ->see('The description field is required.');

    }

    public function testThatUrlAndDescriptionFieldsAreMissing()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->type($category->id, 'category')
             ->type('Asynchronous Task in Javascript', 'title')
             ->press('Create')
             ->see('The url field is required.')
             ->see('The description field is required.');
    }

    public function testThatCategoryAndTitleFieldsAreMissing()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->type('https://www.youtube.com/watch?v=eUJUOxPpiQc', 'url')
             ->type('Asynchronous Task of the web', 'description')
             ->press('Create')
             ->see('The category field is required.')
             ->see('The title field is required.');
    }

    public function testThatTitleAndDescriptionFieldsAreMissing()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->type($category->id, 'category')
             ->type('https://www.youtube.com/watch?v=eUJUOxPpiQc', 'url')
             ->press('Create')
             ->see('The description field is required.')
             ->see('The title field is required.');
    }

    public function testThatCategoryAndUrlFieldsAreMissing()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->type('Promises in Javascript', 'title')
             ->type('Asynchronous Task in Javascript', 'description')
             ->press('Create')
             ->see('The category field is required.')
             ->see('The url field is required.');
    }

    public function testThatVideoWasUpdated()
    {
       $user = factory('App\User')->create();

       $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

       $video = $this->createVideo($user, $category);

       $this->actingAs($user)->visit('/dashboard/video/edit/'.$video->id)
          ->type('I have made you too small in my heart', 'title')
          ->type('It is the language of the Html', 'description')
          ->press('Update')
          ->seePageIs('/dashboard/video/view')
          ->see('Javascript');
    }

    public function testThatASingleVideoWasRetrived()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/edit/'.$video->id)
         ->see($video->title);
    }

    public function testgetAllVideos()
    {
        $user = factory('App\User')->create();

        $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/view')
        ->see($video->title)
        ->see($video->url)
        ->see($video->category->name);

    }

    public function testchangeVideoStatus()
    {
       $user = factory('App\User')->create();

       $category = factory('App\Category')->create([
            'user_id' => $user->id,
            'name'    => 'Erlang',
            'description' => 'I have made you too small in my heart'
        ]);

       $video = $this->createVideo($user, $category);

       $this->actingAs($user)->visit('/dashboard/video/delete/'.$video->id)
       ->see('Operation Successfully');
        
    }

    public function createVideo($user, $category)
    {
        $video = factory('App\Video')->create([
          'title'        => 'Javascript',
          'description'  => 'It is the language of the web',
          'user_id'      => $user->id,
          'category_id'  => $category->id,
          'views'       => 0,
          'favourites'  => 0,
        ]);

        return $video;
    }

}