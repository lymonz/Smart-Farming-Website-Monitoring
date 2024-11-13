<?php

use App\Http\Controllers\ChartsAPIController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('chart', 'ChartsAPIController@updateChart')->name('api.chart');

// Route::get('/battery/home',[ChartsAPIController::class, 'updateChart'])->name('api.chart');

Route::get('chart', 'InserDataSensor@insert')->name('api.chart');