<?php

namespace App\Http\Controllers;

use App\Category;
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
        $allCategories = Category::all();

        return view('welcome', compact('allVideos', 'allCategories', 'user'));
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

        $video = Video::getVideoById($video_id)
        ->get()
        ->first();

        if (is_null($video)) {
            return abort(404, 'Page not found.');
        }

        $relatedVideos = Video::getRelatedVideo($video_id, $video->category_id, $video->title)
        ->orderBy('videos.views', 'desc')
        ->get();

        return view('main.pages.single_video', compact('video', 'relatedVideos'));
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
        if ($this->verifyVideoFavourite($request->input('user'), $video_id)) {
            if ($this->removeVideoFavourite($video_id) && $this->removeVideoFromMyFavourites($request, $video_id)) {
                return [
                    'statuscode'  => 200,
                    'message'     => 'Successful',
                    'favourites'  => $this->getVideoFavourites($video_id),
                ];
            }
        }

        if ($this->addToVideoFavourite($video_id) && $this->addToMyVideoFavourites($request, $video_id)) {
            return [
                'statuscode'  => 201,
                'message'     => 'Successful',
                'favourites'  => $this->getVideoFavourites($video_id),
            ];
        }

        return [
               'statuscode' => 400,
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

    /**
     * This method checks if the user has favourited a particular video before.
     *
     * @param $user_id
     * @param $video_id
     *
     * @return bool
     */
    public function verifyVideoFavourite($user_id, $video_id)
    {
        $favourite = Favourite::where('user_id', '=', $user_id)
        ->where('video_id', '=', $video_id)
        ->get()
        ->first();

        if (!is_null($favourite)) {
            return true;
        }

        return false;
    }

    /**
     * This method gets the total number of video favourites.
     *
     * @param $video_id
     *
     * @return favourites
     */
    public function getVideoFavourites($video_id)
    {
        return Video::getVideoById($video_id)->get()->first()->favourites;
    }
}
