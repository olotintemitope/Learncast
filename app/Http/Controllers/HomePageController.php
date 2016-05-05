<?php

namespace App\Http\Controllers;

use App\Video;
class HomePageController extends Controller
{
    /**
     * This method get videos paginated by 12 record perPage
     * 
     * @param void
     * 
     * @return view
     */
    public function index()
    {
        $allVideos = Video::paginate(12);

        return view('welcome', compact('allVideos'));
    }

    /**
     * This method gets video by id
     * @param $video_id
     * 
     * @return view
     */
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
