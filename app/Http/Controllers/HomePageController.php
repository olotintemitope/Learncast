<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Video;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * This method get videos paginated by 12 record perPage.
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
     * This method gets video by id.
     *
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
     * increase the number of favourites on a video.
     *
     * @param $video_id
     *
     * @return json response
     */
    public function favouriteVideo(Request $request, $video_id)
    {
        if ($request->input('flag') == 1) {
            if ($this->addToVideoFavourite($video_id) && $this->addToMyVideoFavourites($request, $video_id)) {
                return [
                    'statuscode' => 200,
                    'message'    => 'Successful',
                ];
            }
        }

        if ($this->removeVideoFavourite($video_id) && $this->removeVideoFromMyFavourites($request, $video_id)) {
            return [
                'statuscode' => 200,
                'message'    => 'Successful',
            ];
        }

        return [
               'statuscode' => 200,
               'message'    => 'Oop! something went wrong',
            ];
    }

    /**
     * This method increases the number of favourites on a video.
     *
     * @param $request
     * @param $video_id
     *
     * @return bool
     */
    public function addToVideoFavourite($video_id)
    {
        $video = Video::where('id', '=', $video_id)->increment('favourites');

        return $video;
    }

    /**
     * This method add a video to the user favourites table.
     *
     * @param $request
     * @param $video_id
     *
     * @return bool
     */
    public function addToMyVideoFavourites($request, $video_id)
    {
        $favourites = Favourite::create([
            'user_id'  => $request->input('user'),
            'video_id' => $video_id,
        ]);

        if (!is_null($favourites)) {
            return true;
        }

        return false;
    }

    /**
     * This method decrements the counter of favourites on a video.
     *
     * @param $request
     * @param $video_id
     *
     * @return bool
     */
    public function removeVideoFavourite($video_id)
    {
        $video = Video::where('id', '=', $video_id)->decrement('favourites');

        return $video;
    }

    /**
     * This method remove a video from the user favourites table.
     *
     * @param $request
     * @param $video_id
     *
     * @return bool
     */
    public function removeVideoFromMyFavourites($request, $video_id)
    {
        $favourite = Favourite::where('video_id', '=', $video_id)
        ->where('user_id', '=', $request->input('user'))
        ->delete();

        return $favourite;
    }
}
