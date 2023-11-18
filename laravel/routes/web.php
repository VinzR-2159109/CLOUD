<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingPlanController;
use App\Http\Controllers\NutritionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/training-plans/{fitnesLevel}', [TrainingPlanController::class, 'genRunningScheduleOnFitnessLevel']);
Route::get('/running-schedule', [TrainingPlanController::class, 'showRunningSchedule']);
Route::get('/select-fitness-level', [TrainingPlanController::class, 'showSelectFitnessLevel']);

Route::get('/search-nutrition-form', [NutritionController::class, 'showSearchForm']);
Route::post('/search-nutrition', [NutritionController::class, 'showByFoodName']);