<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

class SafetyAlertController extends Controller
{
    public function view()
    {
        return view('safetyAlert.safetyAlert');
    }

    public function activateSafetyAlert()
    {
        WebSocketsRouter::broadcastToAll('activateSafetyAlert', []);
        return response()->json(['status' => 'success']);
    }
}
