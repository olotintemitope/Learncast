<?php

namespace App\Http\Controllers;

use App\Video;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\VideoController;

class HomePageController extends Controller
{
    public function index()
    {
        $allVideos = Video::paginate(12);

        return view('welcome', compact('allVideos'));
    }

    public function viewCurrentVideo($video_id)
    {
        $video = Video::with('category')->getVideoById($video_id)
        ->get()
        ->first();

        if (is_null($video)) {
            return abort(404, 'Page not found.');
        }

        return view('main.pages.single_video', compact('video'));
    }
}
