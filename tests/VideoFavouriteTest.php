<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoFavouriteTest extends TestCase
{
    use DatabaseTransactions;

    public function testThatUserFavouriteAVideo()
    {
        $user = factory('LearnCast\User')->create();
        $video = factory('LearnCast\Video')->create();

        $response = $this->actingAs($user)
        ->call('GET', '/favourite/video/'.$video->id, [
            'user' => $user->id,
        ]);

        $output = json_decode($response->getContent());

        $this->assertEquals($output->message, 'Successful');
        $this->assertEquals($output->statuscode, 201);
    }

    public function testThatTheVideoCouldNotBeFavourited()
    {
        $user = factory('LearnCast\User')->create();
        $video = factory('LearnCast\Video')->create();

        $response = $this->actingAs($user)
        ->call('GET', '/favourite/video/17', [
            'user' => $user->id,
        ]);

        $output = json_decode($response->getContent());

        $this->assertEquals($output->message, 'Oop! something went wrong');
        $this->assertEquals($output->statuscode, 400);
    }

    public function testThatOnlyAuthenticatedUserCanFavouriteAVideo()
    {
        $user = factory('LearnCast\User')->create();

        $video = factory('LearnCast\Video')->create();

        $response = $this->call('GET', '/favourite/video/22', [
            'user' => '',
        ]);

        $output = json_decode($response->getContent());

        $this->assertEquals($output->message, 'Oop! something went wrong');
        $this->assertEquals($output->statuscode, 400);
    }

    public function testGetAuthenticatedVideoFavourites()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Scala',
            'description' => 'A functional programming language',
        ]);

        $video = factory('LearnCast\Video')->create();

        $favourites = factory('LearnCast\Favourite')->create([
            'video_id' => $video->id,
            'user_id'  => $user->id,
        ]);

        $response = $this->actingAs($user)
        ->visit('/dashboard/video/favourites')
        ->see($favourites->video->title)
        ->see($favourites->video->url)
        ->see($favourites->video->category->name);
    }

    public function testThatTheAuthenticatedUserHasNoFavourites()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Scala',
            'description' => 'A functional programming language',
        ]);

        $video = factory('LearnCast\Video')->create();

        $this->actingAs($user)
        ->visit('/dashboard/video/favourites')
        ->see('Video are not available for display');
    }
}
