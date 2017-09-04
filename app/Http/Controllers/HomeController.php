<?php

namespace App\Http\Controllers;

use App\Video;

class HomeController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('created_at', 'DESC')->take(3)->get();

        return view('index', ['videos' => $videos]);
    }
}
