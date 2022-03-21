<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\Movie\MoviesController;

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

Route::group(['middleware' => 'api'], function ($router) {
  Route::post('/register', [JWTController::class, 'register']);
  Route::post('/login', [JWTController::class, 'login']);
  Route::post('/logout', [JWTController::class, 'logout']);
  Route::post('/refresh', [JWTController::class, 'refresh']);
  Route::get('/profile', [JWTController::class, 'profile']);
});

Route::group(['middleware' => 'api'], function ($router) {
  Route::get('/movie/popular/', [MoviesController::class, 'index']);
  Route::get('/movie/trending/', [MoviesController::class, 'trendingMovies']);
  Route::get('/movie/search/', [MoviesController::class, 'search']);
  Route::get('/movie/genre/', [MoviesController::class, 'genre']);
});
