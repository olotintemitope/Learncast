<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoCommentTest extends TestCase
{
    use DatabaseTransactions;

    public function testThatCommentWasAddedSuccessfully()
    {
        $user = factory('LearnCast\User')->create();
        $video = factory('LearnCast\Video')->create();

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
        $user = factory('LearnCast\User')->create();
        $comment = factory('LearnCast\Comment')->create();

        $request = $this->actingAs($user)
        ->call('GET', '/video/comment/update/'.$comment->id, [
            'comment' => 'Please I will like to update my comment',
        ]);

        $response = json_decode($request->getContent());

        $this->assertEquals($response->message, 'Comment updated successfully!');
        $this->assertEquals($response->statuscode, 200);
    }

    public function testThatOnlyAuthenticatedUserCanAddCommentsToVideos()
    {
        $user = factory('LearnCast\User')->create();

        $category = factory('LearnCast\Category')->create([
            'user_id'     => $user->id,
            'name'        => 'Erlang',
            'description' => 'I have made you too small in my heart',
        ]);

        $video = $this->createVideo($user, $category);

        $this->visit('/video/'.$video->id)
        ->dontSee('<form method="POST" id="comment_form">')
        ->dontSee('textarea');
    }

    public function testThatCommentWasUpdatedNotSuccessfully()
    {
        $user = factory('LearnCast\User')->create();

        $comment = factory('LearnCast\Comment')->create();

        $request = $this->actingAs($user)->call('GET', '/video/comment/update/20', [
            'comment' => 'This comment will not be updated',
        ]);

        $response = json_decode($request->getContent());

        $this->assertEquals($response->message, 'Comment failed to update!');
        $this->assertEquals($response->statuscode, 400);
    }

    public function testThatCommentWasDeletedSuccessfully()
    {
        $user = factory('LearnCast\User')->create();

        $comment = factory('LearnCast\Comment')->create();

        $request = $this->actingAs($user)->call('GET',
            '/video/comment/delete/'.$comment->id, [
        ]);

        $response = json_decode($request->getContent());

        $this->assertEquals($response->message, 'Comment deleted successfully!');
        $this->assertEquals($response->statuscode, 200);
    }

    public function testThatCommentWasNotDeletedSuccessfully()
    {
        $user = factory('LearnCast\User')->create();

        $comment = factory('LearnCast\Comment')->create();

        $request = $this->actingAs($user)->call('GET',
            '/video/comment/delete/20', [
        ]);

        $response = json_decode($request->getContent());

        $this->assertEquals($response->message, 'Comment failed to delete!');
        $this->assertEquals($response->statuscode, 400);
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
}
