<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Lesson\LessonsController;
use App\Http\Controllers\User\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "aTpi" middleware group. Enjoy building your API!
|
*/
//

//------------------All-Public-Routes------------------//
Route::group(['prefix' => '/v1'], function () {
    Route::get('/', function () {
        return response('You are at the version 1 of this api');
    });

    // User Routes.
    Route::post('/users', [UsersController::class, 'register']);
    Route::post('/users/login', [UsersController::class, 'login']);
});

//------------------All-Private-Routes------------------//
Route::group(['middleware' => 'auth:sanctum'], function () {

    // Admin Routes.
    Route::resource('/v1/admin', AdminController::class);

    // User Routes.
    Route::resource('/v1/users', UsersController::class);

    // Lessons Routes.
    Route::resource('/v1/lessons', LessonsController::class);
});
