<?php

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

Route::get('/v1', function () {
    return response('You are at the version 1 of this api');
});

/*------------------User-Routes------------------*/
Route::group(['prefix' => '/v1/users'], function () {
    Route::post('/', [UsersController::class, 'store']);
    Route::get('/', [UsersController::class, 'index']);
    Route::get('/{user_id}', [UsersController::class, 'show']);
    Route::put('/{user_id}', [UsersController::class, 'update']);
    Route::delete('/{user_id}', [UsersController::class, 'destroy']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
