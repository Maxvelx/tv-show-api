<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1'], function () {
    // Routes for the register, login and logout users
    Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
        Route::post('register', [App\Http\Controllers\Auth\AuthController::class, 'register']);
        Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
        Route::post('logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
    });

// Route for generate static api_key
    Route::middleware('jwt.auth')->get('generate-token', [App\Http\Controllers\Auth\GenerateApiKey::class, 'generateNewApiKey']);

// Endpoints group
    Route::group(['middleware' => 'api.key'], function () {
        Route::middleware('tvmaze.rate.limit')->get('media-content', [App\Http\Controllers\MediaContent\TvShowsController::class, 'processRequest']);
    });
});



