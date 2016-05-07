<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * This method add video comments
     * 
     * @param $request
     *
     * @return object comment
     */
    public function addComment(Request $request)
    {
        $findComment = Comment::where('comment', '=', strtolower($request->input('comment')))
        ->first();

        if (!is_null($findComment)) {
            return [
               'statuscode' => 202,
               'message'    => 'Comment has been added earlier!'
            ];
        }

        $comment = Comment::create([
            'comment'  => strtolower($request->input('comment')),
            'video_id' => $request->input('video'),
            'user_id'  => $request->input('user'),
        ]);

        if (!is_null($comment)) {
            return [
                'statuscode' => 201,
                'message'    => 'Comment added successfully!',
            ];
        }

        return [
            'statuscode' => 400,
            'message'    => 'Comment failed to add!'
        ];

    }
}
