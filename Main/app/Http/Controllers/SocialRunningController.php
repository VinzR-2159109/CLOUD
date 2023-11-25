<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialRunningController extends Controller
{
    public function view()
    {
        return view('socialRunningTracker/socialRunning');
    }
}
