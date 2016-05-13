<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoTest extends TestCase
{
    use DatabaseTransactions;

    public function testVideoWasVisited()
    {
        $user = factory('LearnCast\User')->create();

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->see('/dashboard/video/create');
    }

    public function testThatVideoWasAddedEalier()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
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
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
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
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
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
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
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
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
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
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
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
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
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
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
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
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
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
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
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
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/edit/'.$video->id)
          ->select($category->id, 'category')
          ->type('I have made you too small in my heart', 'title')
          ->type('It is the language of the Html', 'description')
          ->press('Update')
          ->seePageIs('/dashboard/video/view')
          ->see('I have made you too small in my heart');
    }

    public function testThatOnlyLoggedInUserCanUpdateVideo()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
        ]);

        $video = $this->createVideo($user, $category);

        $this->visit('/dashboard/video/edit/'.$video->id)
          ->seePageIs('/login');
    }

    public function testThatASingleVideoWasRetrived()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/edit/'.$video->id)
         ->see($video->title);
    }

    public function testgetAllVideos()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/view')
        ->see($video->title)
        ->see($video->url)
        ->see($video->category->name);
    }

    public function testchangeVideoStatus()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/delete/'.$video->id)
       ->see('Operation Successfully');
    }

    public function testThatOnlyLoggedInUserCanDeleteVideo()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
        ]);

        $video = $this->createVideo($user, $category);

        $this->visit('/dashboard/video/delete/'.$video->id)
        ->seePageIs('/login');
    }

    public function createVideo($user, $category)
    {
        $video = factory('LearnCast\Video')->create([
          'title'        => 'Javascript',
          'description'  => 'It is the language of the web',
          'user_id'      => $user->id,
          'category_id'  => $category->id,
          'views'        => 0,
          'favourites'   => 0,
        ]);

        return $video;
    }

    public function testThatUserDoesNotSupplyAValidYoutubeUrl()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
        ]);

        $video = $this->createVideo($user, $category);

        $this->actingAs($user)->visit('/dashboard/video/add')
             ->select($category->id, 'category')
             ->type('Laravel file System/Cloud Storage', 'title')
             ->type('//http://goodheads.io/2016/03/16/dependency-injection-explained-plain-english/', 'url')
             ->type('File upload system in laravel', 'description')
             ->press('Create')
             ->see('Invalid url');
    }

    public function testThatAUrlClickLinksToAVideo()
    {
        $user = factory('LearnCast\User')->create();

        $video = factory('LearnCast\Video')->create();

        $this->visit('/')
        ->click('VIEW')
        ->seePageIs('/view/video/'.$video->id);
    }
}
