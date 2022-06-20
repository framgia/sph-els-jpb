<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserUpdateController;
use App\Http\Controllers\Activity\ActivitiesController;
use App\Http\Controllers\Lesson\QuestionsController;
use App\Http\Controllers\Follow\FollowsController;
use App\Http\Controllers\Lesson\ChoicesController;
use App\Http\Controllers\Lesson\LessonsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Answer\AnswersChecker;
use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\Answer\WordLearneds;

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
    Route::resource('/users', UsersController::class)
        ->only(['index', 'show', 'update']);
    Route::get('/users/search/{name}', [UsersController::class, 'search']);
    Route::post('/users/logout', [UsersController::class, 'logout']);

    // Lessons Routes.
    Route::resource('/lessons', LessonsController::class);
    Route::get('/lessons/search/{lessonName}', [LessonsController::class, 'search']);
    Route::get('/lessons/complete/{lessonID}', [LessonsController::class, 'completeLesson']);

    // Questions Routes.
    Route::resource('/questions', QuestionsController::class);

    // Choices Routes.
    Route::resource('/choices', ChoicesController::class);

    // Answer Checker. 
    Route::post('/answers/checker/{lessonID}', [AnswersChecker::class, 'checker']);
    Route::get('/words/learned', [WordLearneds::class, 'index']);
    Route::get('/words/learned/{lessonID}', [WordLearneds::class, 'show']);

    // Follows Routes. 
    Route::prefix('/follows')->group(function () {
        Route::get('/', [FollowsController::class, 'index']);
        Route::post('/{following}', [FollowsController::class, 'store']);
        Route::delete('/{unfollowing}', [FollowsController::class, 'destroy']);
        Route::get('/following/{followerID}', [FollowsController::class, 'followings']);
        Route::get('/follower/{followingID}', [FollowsController::class, 'followers']);
    });

    // Activity Routes.
    Route::prefix('/activities')->group(function () {
        Route::get('/', [ActivitiesController::class, 'index']);
        Route::get('/{activityID}', [ActivitiesController::class, 'show']);
    });
});
