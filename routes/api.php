<?php

use App\Http\Controllers\Todo\TodoController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/**
 * Auth
 */
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    /**
     * Todos
     */
    Route::get('/todos', [TodoController::class, 'items']);
    Route::post('/todos/store', [TodoController::class, 'store']);
    Route::put('/todos/toggle-status/{id}', [TodoController::class, 'toggleStatus']);
    Route::delete('/todos/destroy/{id}', [TodoController::class, 'destroy']);
});
