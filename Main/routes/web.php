<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StartController;
Route::get('/', [StartController::class, 'index'])->name('start');

use App\Http\Controllers\RunningScheduleController;
Route::get('/make-running-schedule-view', [RunningScheduleController::class, 'index']);
Route::post('/make-running-schedule', [RunningScheduleController::class, 'makeRunningSchedule']);

use App\Http\Controllers\NutritionController;
Route::get('/search-nutrition-form', [NutritionController::class, 'showSearchForm']);
Route::post('/search-nutrition', [NutritionController::class, 'showByFoodName']);

use App\Http\Controllers\RunningHistoryController;
Route::get('/running-history', [RunningHistoryController::class, 'index']);
Route::post('/get-running-history', [RunningHistoryController::class, 'getRunningHistory']);
Route::post('/calculate-average-pace', [RunningHistoryController::class, 'calculateAveragePace']);
Route::post('/add-running-activity', [RunningHistoryController::class, 'addRunningActivity']);
Route::post('/add-samples', [RunningHistoryController::class, 'addSamples']);

use App\Http\Controllers\SocialRunningController;
Route::get('/social-running-tracker', [SocialRunningController::class, 'index']);

use App\Http\Controllers\SafetyAlertController;
Route::get('/websocket', [SafetyAlertController::class, 'index']);
Route::post('/activate-safety-alert', [SafetyAlertController::class, 'activateSafetyAlert']);

use App\Http\Controllers\SensorController;
Route::get('/sensors', [SensorController::class, 'index']);
