<?php

namespace App\Http\Controllers;

use Auth;
use App\Video;
use App\Category;
use App\Http\Requests\VideoRequest;
use Illuminate\Http\Request;

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
        $user_id = Auth::user()->id;

        $category = Video::create([
            'title'        => $request->input('title'),
            'url'          => $this->parseYoutubeUrl($request->input('url')),
            'category_id'  => $request->input('category'),
            'user_id'      => $user_id,
            'description'  => $request->input('description'),
            'views'        => 0,
            'favourites'   => 0,
            ]);

        if (!is_null($category)) {
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
    public function updateVideo(VideoRequest $request, $id)
    {
        $video = Video::getVideoById($id)
        ->update([
            'title'        => $request->input('title'),
            'url'          => $this->parseYoutubeUrl($request->input('url')),
            'category_id'  => $request->input('category'),
            'description'  => $request->input('description'),
        ]);

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
     */
    public function parseYoutubeUrl($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);

        return $my_array_of_vars['v'];
    }

    /**
     * This method returns all videos under a category
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
        $myVideos  = Video::where('category_id', '=', $category->id)
        ->paginate(12);

        return view('main.pages.video_category', compact('myVideos', 'categoryName'));

    }
}
