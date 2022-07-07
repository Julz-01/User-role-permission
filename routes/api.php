<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

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

//User API Routes
Route::prefix('user')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/', 'all');

        Route::post('/', 'store');

        Route::get('/{id}', 'findById');

        Route::put('/{id}', 'update');

        Route::delete('/{id}', 'delete');
    });
});


//Roles API Routes
Route::prefix('role')->group(function () {
    Route::controller(RoleController::class)->group(function () {
        Route::post('/', 'store');

        Route::get('/', 'all');

        Route::put('/{id}', 'update');

        Route::delete('/{id}', 'delete');

        Route::get('/open', 'openRoles');
    });
});
