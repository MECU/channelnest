<?php

namespace App\Http\Controllers;

class VideoController extends Controller
{
    public function videoSubmit()
    {

        return view('videoSubmit');
    }

    public function video()
    {

        return view('video');
    }
}
