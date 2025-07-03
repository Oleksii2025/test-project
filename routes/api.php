<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
    Route::post('/check-token', [AuthController::class, 'checkToken'])->name('check-token');
});

Route::middleware('auth:api')->group(static function () {
    Route::prefix('/tasks')->group(static function () {
        Route::post('/list', 'App\Http\Controllers\TasksController@index');
        Route::post('/create', 'App\Http\Controllers\TasksController@store');
        Route::get('/show/{id}', 'App\Http\Controllers\TasksController@show');
        Route::post('/edit', 'App\Http\Controllers\TasksController@edit');
        Route::get('/delete/{id}', 'App\Http\Controllers\TasksController@destroy');
    });
    Route::prefix('/categories')->group(static function () {
        Route::get('/list', 'App\Http\Controllers\CategoriesController@index');
    });
    Route::prefix('/types')->group(static function () {
        Route::get('/list', 'App\Http\Controllers\TypesController@index');
    });
});
