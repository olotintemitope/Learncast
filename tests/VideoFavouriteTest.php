<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoFavouriteTest extends TestCase
{
    use DatabaseTransactions;

    public function testThatUserFavouriteAVideo()
    {
        $user = factory('App\User')->create();
        $video = factory('App\Video')->create();

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
        $user = factory('App\User')->create();
        $video = factory('App\Video')->create();

        $response = $this->actingAs($user)
        ->call('GET', '/favourite/video/17', [
            'user' => $user->id,
        ]);

        $output = json_decode($response->getContent());

        $this->assertEquals($output->message, 'Oop! something went wrong');
        $this->assertEquals($output->statuscode, 400);
    }

    public function testThatAUrlClickLinksToAVideo()
    {
        $user = factory('App\User')->create();

        $video = factory('App\Video')->create();

        $this->visit('/')
        ->click('VIEW')
        ->seePageIs('/view/video/'.$video->id);
    }

    public function testThatVideoUrlIsWrong()
    {
        $user = factory('App\User')->create();

        $video = factory('App\Video')->create();

        $this->visit('/view/video/17')
        ->see('Video you requested for cannot be found');
    }
}
