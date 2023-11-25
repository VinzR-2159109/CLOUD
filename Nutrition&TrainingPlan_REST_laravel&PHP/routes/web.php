<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StartController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\RunningScheduleController;
use App\Http\Controllers\SocialRunningController;

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

Route::get('/', [StartController::class, 'index'])->name('start');

Route::get('/make-running-schedule-view', [RunningScheduleController::class, 'view']);
Route::post('/make-running-schedule', [RunningScheduleController::class, 'makeRunningSchedule']);

Route::get('/search-nutrition-form', [NutritionController::class, 'showSearchForm']);
Route::post('/search-nutrition', [NutritionController::class, 'showByFoodName']);

Route::get('/social-running-tracker', [SocialRunningController::class, 'view']);