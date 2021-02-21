<?php

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

Route::middleware('auth:api')->group(function () {
  Route::get('/recipes', 'App\Http\Controllers\Api\RecipeController@index');
  Route::get('/comments', 'App\Http\Controllers\Api\CommentController@index');
  Route::get('/comments/{id}', 'App\Http\Controllers\Api\CommentController@show');
  Route::post('/comments/store', 'App\Http\Controllers\Api\CommentController@store');
  Route::post('/ratings', 'App\Http\Controllers\Api\RatingController@store');
});
