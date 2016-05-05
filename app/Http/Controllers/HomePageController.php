<?php

namespace App\Http\Controllers;

use App\Video;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $allVideos = Video::orderBy('id', 'desc')->get();

        return view('welcome', compact('allVideos'));
    }
}
