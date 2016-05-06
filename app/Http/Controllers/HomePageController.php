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
        // Update the number of views on this page 
        Video::where('id', '=', $video_id)->increment('views');

        $video = Video::with('category')->getVideoById($video_id)
        ->get()
        ->first();

        if (is_null($video)) {
            return abort(404, 'Page not found.');
        }

        return view('main.pages.single_video', compact('video'));
    }

    /**
     * This function store the users favourite video and also 
     * increase the number of favourites on a video
     * 
     * @param $video_id
     *
     * @return json response
     */
    public function favouriteVideo($video_id)
    {
        return [
           'statuscode' => 200,
           'message'    => 'Successful'
        ];
    }
}
