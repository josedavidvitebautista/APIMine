<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\PelisMarvelController;
use App\Http\Controllers\PelisDCController;
use App\Http\Controllers\PelisSMController;
use App\Http\Controllers\PelisBatmanController;
use App\Http\Controllers\PelisTerminatorController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("Marvel", PelisMarvelController::class);
Route::apiResource("DC", PelisDCController::class);
Route::apiResource("Spider-Man", PelisSMController::class);
Route::apiResource("Batman", PelisBatmanController::class);
Route::apiResource("Terminator", PelisTerminatorController::class);

Route::get("/lool1", [PelisMarvelController::class, 'store']);
Route::get("/lool2", [PelisDCController::class, 'store']);
Route::get("/lool3", [PelisSMController::class, 'store']);
Route::get("/lool4", [PelisBatmanController::class, 'store']);
Route::get("/lool5", [PelisTerminatorController::class, 'store']);

