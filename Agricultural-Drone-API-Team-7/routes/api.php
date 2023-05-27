<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\DroneTypeController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::put('/instruction/drones/{name}', [InstructionController::class, 'commandDrone']);
    Route::get('/updateSystem/drones/{name}', [DroneController::class, 'updateDroneSystem']);
    Route::resource('/drones', DroneController::class);
    Route::get('/drone/{droneName}', [DroneController::class, 'showDroneByName']);
    Route::put('/drone/{name}', [DroneController::class, 'updateDronByName']);
    Route::get('/maps', [MapController::class,"showUserMap"]);
    Route::get('/drones/{droneName}/location/{locationId}', [DroneController::class, 'findDroneLocation']);
    Route::get('/maps/province/{provinceName}/farm/{farmId}', [MapController::class,"downloadImage"]);
    Route::delete('/maps/province/{provinceName}/farm/{farmId}', [MapController::class,"deleteImage"]);
    Route::post('/maps/province/{provinceName}/farm/{farmId}', [MapController::class,"storeMapInUniqueFarm"]);
    Route::resource('/plans', PlanController::class);
    Route::resource('/farm', FarmController::class);
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::resource('/user', UserController::class);
Route::resource('/droneType', DroneTypeController::class);
Route::resource('/instructions', InstructionController::class);

Route::resource('/province', ProvinceController::class);
Route::resource('/map', MapController::class);
Route::resource('/location', LocationController::class);
// Route::resource('/plans', PlanController::class);

