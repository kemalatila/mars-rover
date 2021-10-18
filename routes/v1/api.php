<?php

use App\Http\Controllers\v1\Api\PlateauController;
use App\Http\Controllers\v1\Api\RoverCommandController;
use App\Http\Controllers\v1\Api\RoverController;
use App\Http\Controllers\v1\Api\RoverStateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/plateaus'], function () {
    Route::post('/', [PlateauController::class, 'store']);
    Route::get('/{id}', [PlateauController::class, 'show']);
});

Route::group(['prefix' => 'rovers'], function () {
    Route::post('/', [RoverController::class, 'store']);
    Route::get('/{id}', [RoverController::class, 'show']);
    Route::post('/{id}/command-receiver', [RoverCommandController::class, 'commandReceiver']);
    Route::get('/{id}/states', [RoverStateController::class, 'show']);
});

