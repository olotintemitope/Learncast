<?php

namespace App\Http\Controllers;

use Auth;
use App\Video;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('dashboard.pages.add_video', compact('categories'));
    }

    public function store(VideoRequest $request)
    {
        $user_id = Auth::user()->id;

        $category = Video::create([
            'title'        => $request->input('title'),
            'url'          => $request->input('url'),
            'category_id'  => $request->input('category'),
            'user_id'      => $user_id,
            'description'  => $request->input('description'),
            ]);

        if (! is_null($category)) {
            return redirect('/dashboard/video/add')->with(
                'status', 
                'Sucessfully created!'
            );
        } 

        return redirect('/dashboard/video/add')->with(
            'status', 
            'Oops! Something went wrong!'
        );
    }

    public function viewAllVideos()
    {
        $user_id = $user_id = Auth::user()->id;;

        $videos = Video::with('category')
        ->getVideosByUserId($user_id)
        ->paginate(10);

        $pendingVideos = Video::with('category')
        ->allTrashedVideos($user_id)
        ->paginate(10);

        return view('dashboard.pages.list_all_videos', compact('videos', 'pendingVideos'));

    }

    public function getVideo($id)
    {
        $video = Video::getVideoById($id)
        ->get()
        ->first();

        $categories = Category::all();

        if (is_null($video)) {
            return redirect('/dashboard/video/add')->with(
                'status', 
                'Oops! Video does not exist!'
            );
        }

        return view('dashboard.pages.view_video', compact('categories', 'video'));
    }

    public function updateVideo(VideoRequest $request, $id)
    {
        $video = Video::getVideoById($id)
        ->update([
            'title'        => $request->input('title'),
            'url'          => $request->input('url'),
            'category_id'  => $request->input('category'),
            'description'  => $request->input('description'),
        ]);

        if (! is_null($video)) {
            return redirect('/dashboard/video/view');
        } 

        return redirect('/dashboard/video/edit'.$id)->with(
            'status', 
            'Oops! Something went wrong!'
        );
    }

    public function changeVideoStatus(Request $request, $id) {
        $video = null;

        if ($request->input('status') == 0) {
            $video = Video::setVideoStatus($id)
            ->delete();
        } else {
            $video = Video::setVideoStatus($id)
            ->restore();
        }

        return $this->returnChangeVideoStatus($video);
        
    }

    public function returnChangeVideoStatus($classObject)
    {
        if (! is_null($classObject)) {
            return [
            'statuscode' => 200,
            'message' => 'Operation Successfully'
            ];
        }

        return [
        'statuscode' => 404,
        'message' => 'Invalid Video ID!'
        ];
    }
}
