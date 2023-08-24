<?php

use App\Http\Controllers\AuthController;
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

Route::post('/create_task', [TaskController::class, 'store']); /** WORK */
Route::get('/show_task/{id}', [TaskController::class, 'show']); /** WORK */
Route::any('/update_task/{id}', [TaskController::class, 'update']);
Route::delete('/delete_task/{id}', [TaskController::class, 'delete']);
Route::get('/list_tasks', [TaskController::class, 'index']); /** WORK */
