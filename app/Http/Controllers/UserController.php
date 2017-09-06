<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function profile(User $user): View
    {
        return view('profile', ['user' => $user]);
    }
}
