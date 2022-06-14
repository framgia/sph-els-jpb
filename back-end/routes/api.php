<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Follow\FollowsController;
use App\Http\Controllers\Lesson\ChoicesController;
use App\Http\Controllers\Lesson\LessonsController;
use App\Http\Controllers\Lesson\QuestionsController;
use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\User\UserUpdateController;
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
Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => '/v1'
], function () {

    // Admin Routes.
    Route::resource('/admin', AdminController::class);

    // User Routes.
    Route::post('/users/logout', [UsersController::class, 'logout']);
    Route::resource('/users', UsersController::class)
        ->only(['index', 'show', 'update']);

    // Lessons Routes.
    Route::resource('/lessons', LessonsController::class);

    // Questions Routes.
    Route::resource('/questions', QuestionsController::class);

    // Choices Routes.
    Route::resource('/choices', ChoicesController::class);

    // Follows Routes. 
    Route::prefix('/follows')->group(function () {
        Route::get('/', [FollowsController::class, 'index']);
        Route::post('/{following}', [FollowsController::class, 'store']);
        Route::delete('/{unfollowing}', [FollowsController::class, 'destroy']);
        Route::get('/following/{follower_id}', [FollowsController::class, 'followings']);
        Route::get('/follower/{following_id}', [FollowsController::class, 'followers']);
    });
});
