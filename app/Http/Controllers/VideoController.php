<?php

namespace LearnCast\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use LearnCast\Category;
use LearnCast\Favourite;
use LearnCast\Http\Requests\VideoRequest;
use LearnCast\User;
use LearnCast\Video;

class VideoController extends Controller
{
    /**
     * This Method change the video status.
     *
     * @param void
     *
     * @return view
     */
    public function index()
    {
        $categories = Category::all();

        return view('dashboard.pages.add_video', compact('categories'));
    }

    /**
     * This Method change the video status.
     *
     * @param $request
     *
     * @return $response
     */
    public function store(VideoRequest $request)
    {
        $video = $this->createVideo($request, Auth::user()->id);

        if ($video === false) {
            return redirect('/dashboard/video/add')->with(
                'status',
                'Invalid url'
            );
        }

        if (!is_null($video)) {
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

    /**
     * This Method gets all videos.
     *
     * @param void
     *
     * @return view
     */
    public function viewAllVideos()
    {
        $user_id = $user_id = Auth::user()->id;

        $videos = Video::with('category')
        ->getVideosByUserId($user_id)
        ->paginate(10);

        $pendingVideos = Video::with('category')
        ->allTrashedVideos($user_id)
        ->paginate(10);

        return view('dashboard.pages.list_all_videos', compact('videos', 'pendingVideos'));
    }

    /**
     * This Method get all videos.
     *
     * @param $id
     *
     * @return $response
     */
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

    /**
     * This Method update the video.
     *
     * @param $id
     * @param $request
     *
     * @return $response
     */
    public function updateVideo(Request $request, $id)
    {
        $this->validateRequest($request, $id);

        $video = $this->assistUpdateVideo($request, $id);

        if ($video === false) {
            return redirect('/dashboard/video/edit'.$id)->with(
                'status',
                'Invalid url'
            );
        }

        if (!is_null($video)) {
            return redirect('/dashboard/video/view');
        }

        return redirect('/dashboard/video/edit'.$id)->with(
            'status',
            'Oops! Something went wrong!'
        );
    }

    /**
     * This Method change the video status.
     *
     * @param $id
     * @param $request
     *
     * @return $videostatus
     */
    public function changeVideoStatus(Request $request, $id)
    {
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

    /**
     * This Method return the video status.
     *
     * @param $classObject
     *
     * @return $response
     */
    public function returnChangeVideoStatus($classObject)
    {
        if (!is_null($classObject)) {
            return [
            'statuscode' => 200,
            'message'    => 'Operation Successfully',
            ];
        }

        return [
        'statuscode' => 404,
        'message'    => 'Invalid Video ID!',
        ];
    }

    /**
     * This method parse youtube url.
     *
     * @param $url
     *
     * @return string
     */
    public function parseYoutubeUrl($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);

        if (! array_key_exists('v', $my_array_of_vars)) {
            return false;

        }

        return $my_array_of_vars['v'];
    }

    /**
     * This method returns all videos under a category.
     *
     * @param $name
     *
     * @return view
     */
    public function getVideosByCategory($name)
    {
        $videos = null;

        $category = Category::getCategoryByName($name)
        ->first();

        if (is_null($category)) {
            return abort(404, 'Page not found.');
        }

        $categoryName = ucwords($category->name);
        $myVideos = Video::where('category_id', '=', $category->id)
        ->paginate(12);

        return view('main.pages.video_category', compact('myVideos', 'categoryName'));
    }

    /**
     * This method returns user video favourites.
     *
     * @param void
     *
     * @return view
     */
    public function myFavouriteVideos()
    {
        $favourite = Favourite::with('video')
        ->getVideoFavouritedByUser(Auth::user()->id)
        ->paginate(10);

        return view('dashboard.pages.myfavourite_videos', compact('favourite'));
    }

    /**
     * This method validates video request.
     *
     * @param $request
     * @param $id
     *
     * @return object
     */
    public function validateRequest($request, $id)
    {
        $this->validate($request, [
            'title'        => 'required|max:50|unique:videos,title,'.$id,
            'url'          => 'required|min:10|unique:videos,url,'.$id,
            'description'  => 'required|max:256',
            'category'     => 'required|max:5',
        ]);
    }

    /**
     * This method updates a video and return the video object.
     *
     * @param $request
     * @param $id
     *
     * @return $video
     */
    public function assistUpdateVideo($request, $id)
    {
        if ($this->parseYoutubeUrl($request->input('url')) == false) {
            return false;
        }

        $video = Video::getVideoById($id)
        ->update([
            'title'        => $request->input('title'),
            'url'          => $this->parseYoutubeUrl($request->input('url')),
            'category_id'  => $request->input('category'),
            'description'  => $request->input('description'),
        ]);

        return $video;
    }

    /**
     * This method creates video and return the video object.
     *
     * @param  $request
     * @param  $user_id
     *
     * @return $video
     */
    public function createVideo($request, $user_id)
    {
        if ($this->parseYoutubeUrl($request->input('url')) === false) {
            return false;

        }

        $video = Video::create([
            'title'        => $request->input('title'),
            'url'          => $this->parseYoutubeUrl($request->input('url')),
            'category_id'  => $request->input('category'),
            'user_id'      => $user_id,
            'description'  => $request->input('description'),
            'views'        => 0,
            'favourites'   => 0,
        ]);

        return $video;
    }
}
