<?php

namespace App\Http\Controllers;

use App\Video;

class VideoController extends Controller
{
    public function videoSubmit()
    {

        return view('videoSubmit');
    }

    public function video(Video $video)
    {

        return view('video', ['video' => $video]);
    }
}
