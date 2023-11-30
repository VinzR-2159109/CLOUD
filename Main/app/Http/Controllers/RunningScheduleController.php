<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RunningSchedule;

class RunningScheduleController extends Controller
{   
    public function makeRunningSchedule(Request $request)
    {
        $fitnessLevel = $request->input('fitnessLevel', 1);

        $model = new RunningSchedule();
        $schedule = $model->genRunningScheduleOnFitnessLevel($fitnessLevel);
        
        return response()->json(['message' => 'Running schedule is gemaakt!', 'schedule' => $schedule]);
    }

    public function index(){
        return view('runningSchedule/makeRunningSchedule');
    }
}
