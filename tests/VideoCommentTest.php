<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoCommentTest extends TestCase 
{
    use DatabaseTransactions;

    public function testThatCommentWasAddedSuccessfully()
    {
        $user = factory('App\User')->create();
        $video = factory('App\Video')->create();

        $request = $this->actingAs($user)
        ->call('POST', '/video/comment/add', [
            'comment' => 'This is a comment body',
            'user'    => $user->id,
            'video'   => $video->id,
        ]);

        $response = json_decode($request->getContent());

        $this->assertEquals($response->message, 'Comment added successfully!');
        $this->assertEquals($response->statuscode, 201);

    }

    public function testThatCommentWasUpdatedSuccessfully()
    {
        $user = factory('App\User')->create();
        $comment = factory('App\Comment')->create();

        $request = $this->actingAs($user)
        ->call('GET', '/video/comment/update/'.$comment->id, [
            'comment' => 'Please I will like to update my comment',
        ]);

        $response = json_decode($request->getContent());

        $this->assertEquals($response->message, 'Comment updated successfully!');
        $this->assertEquals($response->statuscode, 200);

    }

    public function testThatCommentWasUpdatedNotSuccessfully()
    {
        $user = factory('App\User')->create();

        $comment = factory('App\Comment')->create();

        $request = $this->actingAs($user)->call('GET', '/video/comment/update/20', [
            'comment' => 'This comment will not be updated',
        ]);

        $response = json_decode($request->getContent());

        $this->assertEquals($response->message, 'Comment failed to update!');
        $this->assertEquals($response->statuscode, 400);

    }

    public function testThatCommentWasDeletedSuccessfully()
    {
        $user = factory('App\User')->create();

        $comment = factory('App\Comment')->create();

        $request = $this->actingAs($user)->call('GET', 
            '/video/comment/delete/'.$comment->id, [
        ]);

        $response = json_decode($request->getContent());

        $this->assertEquals($response->message, 'Comment deleted successfully!');
        $this->assertEquals($response->statuscode, 200);

    }

    public function testThatCommentWasNotDeletedSuccessfully()
    {
        $user = factory('App\User')->create();

        $comment = factory('App\Comment')->create();

        $request = $this->actingAs($user)->call('GET', 
            '/video/comment/delete/20', [
        ]);

        $response = json_decode($request->getContent());

        $this->assertEquals($response->message, 'Comment failed to delete!');
        $this->assertEquals($response->statuscode, 400);

    }
}