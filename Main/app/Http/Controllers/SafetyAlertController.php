<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

class SafetyAlertController extends Controller
{
    public function index()
    {
        return view('safetyAlert.safetyAlert');
    }

    public function activateSafetyAlert()
    {
        WebSocketsRouter::broadcastToAll('activateSafetyAlert', []);
        return response()->json(['status' => 'success']);
    }
}
