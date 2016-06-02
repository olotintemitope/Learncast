<?php

namespace LearnCast\Http\Controllers;

use Illuminate\Http\Request;
use LearnCast\Category;
use LearnCast\Favourite;
use LearnCast\Video;

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
     * @param $videoId
     *
     * @return view
     */
    public function viewCurrentVideo($videoId)
    {
        // Update the number of views on this page
        Video::where('id', $videoId)->increment('views');

        $video = Video::getVideoById($videoId)->first();

        if (is_null($video)) {
            return abort(404, 'Page not found.');
        }

        $relatedVideos = Video::getRelatedVideo($videoId, $video->category_id, $video->title)
        ->orderBy('videos.views', 'desc')
        ->take(5)
        ->get();

        return view('main.pages.single_video', compact('video', 'relatedVideos'));
    }

    /**
     * This function store the users favourite video and also
     * increase the number of favourites on a video.
     *
     * @param $videoId
     *
     * @return json response
     */
    public function favouriteVideo(Request $request, $videoId)
    {
        if ($this->verifyVideoFavourite($request->input('user'), $videoId)) {
            if ($this->removeVideoFavourite($videoId) && $this->removeVideoFromMyFavourites($request, $videoId)) {
                return [
                    'statuscode'  => 200,
                    'message'     => 'Successful',
                    'favourites'  => $this->getVideoFavourites($videoId),
                ];
            }
        }

        if ($this->addToVideoFavourite($videoId) && $this->addToMyVideoFavourites($request, $videoId)) {
            return [
                'statuscode'  => 201,
                'message'     => 'Successful',
                'favourites'  => $this->getVideoFavourites($videoId),
            ];
        }

        return [
               'statuscode' => 400,
               'message'    => 'Oops! something went wrong',
            ];
    }

    /**
     * This method increases the number of favourites on a video.
     *
     * @param $request
     * @param $videoId
     *
     * @return bool
     */
    public function addToVideoFavourite($videoId)
    {
        return Video::where('id', $videoId)->increment('favourites');
    }

    /**
     * This method add a video to the user favourites table.
     *
     * @param $request
     * @param $videoId
     *
     * @return bool
     */
    public function addToMyVideoFavourites($request, $videoId)
    {
        $favourites = Favourite::create([
            'user_id'  => $request->input('user'),
            'video_id' => $videoId,
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
     * @param $videoId
     *
     * @return bool
     */
    public function removeVideoFavourite($videoId)
    {
        return Video::where('id', $videoId)->decrement('favourites');
    }

    /**
     * This method remove a video from the user favourites table.
     *
     * @param $request
     * @param $videoId
     *
     * @return bool
     */
    public function removeVideoFromMyFavourites($request, $videoId)
    {
        return Favourite::where('video_id', $videoId)
        ->where('user_id', '=', $request->input('user'))
        ->delete();
    }

    /**
     * This method checks if the user has favourited a particular video before.
     *
     * @param $user_id
     * @param $videoId
     *
     * @return bool
     */
    public function verifyVideoFavourite($userId, $videoId)
    {
        $favourite = Favourite::where('user_id', $userId)
        ->where('video_id', $videoId)
        ->first();

        if (!is_null($favourite)) {
            return true;
        }

        return false;
    }

    /**
     * This method gets the total number of video favourites.
     *
     * @param $videoId
     *
     * @return favourites
     */
    public function getVideoFavourites($videoId)
    {
        return Video::getVideoById($videoId)
        ->first()
        ->favourites;
    }

    /**
     * This method search the database for videos under a category.
     *
     * @param $request
     *
     * @return view
     */
    public function search(Request $request)
    {
        $searchResult = null;

        $decodedString = strtolower(urldecode($request->query('q')));

        if ($decodedString != '') {
            $searchResult = Video::getVideoLike($decodedString)->paginate(10);
        }

        return view('main.pages.view_search_result', compact('searchResult', 'decodedString'));
    }
}
