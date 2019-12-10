<?php

use Illuminate\Http\Request;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'API\AuthController@login');
    Route::post('logout', 'API\AuthController@logout');
    Route::post('refresh', 'API\AuthController@refresh');
    Route::post('me', 'API\AuthController@me');

});

Route::middleware('auth:api')->group(function () {
    /** BOOK */
    Route::resource('book', 'API\BookController');

    /** BOOK RATING */
    Route::resource('rating', 'API\BookRatingsController');

    /** REPOSITORY BOOKS */
    Route::resource('repository', 'API\RepositoryBooksController');

    /** REPOSITORY BOOKS STATUS */
    Route::resource('status', 'API\RepositoryBookStatusController');
});


