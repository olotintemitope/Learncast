<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Storage;
use Cloudder;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserSignupRequest;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Contracts\Filesystem\Filesystem;

class UserController extends Controller
{
    public function updateProfile(UserSignupRequest $request)
    {
        $user = User::where('id', '=', Auth::user()->id)
        ->update([
            'username'    => $request->input('username'),
            'email'       => $request->input('email'),
            'profile_bio' => $request->input('profile_bio'),
        ]);

        if (! is_null($user)) {
            return redirect('/dashboard/profile')->with(
                'status', 
                'Sucessfully updated!'
            );
        }

        return redirect('/dashboard/profile')->with(
            'status', 
            'Oops! Something went wrong!'
        );
    }

    /**
     * This method upload profile picture to cloudinary
     * 
     * @param  $request
     * 
     * @return response
     */
    public function updateAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'picture_url' => 'required|image|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect('/dashboard/profile')
            ->with('status', 'File accepted must be a jpg and not more 10MB!');
        }

        $imageUrl = $this->handleCloudinaryFileUpload($request);

         if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
            $user = User::where('id', '=', Auth::user()->id)
            ->update(['picture_url' => $imageUrl,]);

            return redirect('/dashboard/profile')
            ->with('status', 'Profile picture update successfully!');
         }

         return redirect('/dashboard/profile')->with(
            'status', 
            'Oops! Something went wrong!'
        );

    }
    /**
     * This method upload image to cloudinary
     * 
     * @param $request
     * 
     * @return picture url
     */
    public function handleCloudinaryFileUpload($request)
    {
        $avatar = $request->file('picture_url');
        $avatar = Cloudder::upload($avatar, null, [
            "format" => "jpg",
            "crop" => "fill",
            "width" => 250,
            "height" => 250
        ]);

        return  Cloudder::getResult()['url'];
    }
}
