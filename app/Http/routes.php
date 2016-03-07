<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});

Route::model('albums', App\Album::class);
Route::model('pictures', App\Picture::class);

Route::group(['middleware' => 'api', 'prefix' => '/api/v1', 'namespace' => 'Api\V1'], function ($route) {
    $route->get('/', function () {
        return response()->json('Hi there!');
    });
    $route->post('/login', 'UsersController@login');
    $route->post('/register', 'UsersController@register');
    Route::group(['middleware' => 'jwt.auth'], function ($route) {
        $route->get('/profile', 'UsersController@profile');
        $route->get('/sync', 'SyncController@sync');
        $route->resource('albums', 'AlbumsController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
        $route->resource('albums.pictures', 'PicturesController');
    });
});
