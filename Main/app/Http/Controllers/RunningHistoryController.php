<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RunningHistoryController extends Controller
{
    public function index()
    {
        view('runningHistory.runningHistoryResponse');
    }
}
