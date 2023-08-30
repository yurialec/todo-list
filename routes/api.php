<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FallbackController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'success' => true,
    ]);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
});

/** Route validation */
Route::group([
    'prefix' => '/tasks'
], function () {
    Route::get('/list', [TaskController::class, 'index']);
    Route::post('/create', [TaskController::class, 'store']);
    Route::get('/{id}', [TaskController::class, 'show']);
    Route::delete('/{id}', [TaskController::class, 'delete']);
    Route::post('/update/{id}', [TaskController::class, 'update']);
    Route::post('/complete_task/{id}', [TaskController::class, 'completeTask']);
});