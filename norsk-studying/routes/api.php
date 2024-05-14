<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerbController;
use App\Http\Controllers\WordController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/show/{id?}', [UserController::class, 'show']);
        Route::put('/edit/{id?}', [UserController::class, 'update']);
        Route::prefix('/form')->group(function () {
            Route::get('/', [UserController::class, 'getForm']);
            Route::get('/{id}', [UserController::class, 'getFormEdit']);
        });
    });
    Route::prefix('verbs')->group(function () {
        Route::get('/', [VerbController::class, 'index']);
        Route::get('/show/{id?}', [VerbController::class, 'show']);
        Route::post('/check-answer', [VerbController::class, 'checkAnswer']);
        Route::prefix('/form')->group(function () {
            Route::get('/', [VerbController::class, 'getForm']);
            Route::get('/{id}', [VerbController::class, 'getFormEdit']);
        });
    });
    Route::prefix('words')->group(function () {
        Route::get('/', [WordController::class, 'index']);
        Route::post('/', [WordController::class, 'store']);
        Route::patch('/edit/{id}', [WordController::class, 'update']);
        Route::post('/check-answer', [WordController::class, 'checkAnswer']);
        Route::get('/show/{id?}/{type?}', [WordController::class, 'show']);
        Route::prefix('/form')->group(function () {
            Route::get('/', [WordController::class, 'getForm']);
            Route::get('/{id}', [WordController::class, 'getFormEdit']);
        });
    });
});

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
