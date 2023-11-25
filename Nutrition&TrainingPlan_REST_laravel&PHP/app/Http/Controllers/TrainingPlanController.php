<?php

// app/Http/Controllers/TrainingPlanController.php

namespace App\Http\Controllers;

use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class TrainingPlanController extends Controller
{
    public function genRunningScheduleOnFitnessLevel($level)
    {
        $model = new TrainingPlan();
        $plan = $model->genRunningScheduleOnFitnessLevel($level);

        return response()->json($plan, 201);
    }

    public function showRunningSchedule(Request $request)
    {
        $fitnessLevel = $request->input('fitness_level', 1);

        $trainingPlan = new TrainingPlan();
        $schedule = $trainingPlan->genRunningScheduleOnFitnessLevel($fitnessLevel);

        return view('runningSchedule/running_schedule', compact('fitnessLevel', 'schedule'));
    }

    public function showSelectFitnessLevel()
    {
        return view('runningSchedule/select_fitness_level');
    }
    
}
