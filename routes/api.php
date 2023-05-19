<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Web\StatementController;
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

// Guest Routes -------
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'logIn'])->name('login');
});

// Auth Routes --------
Route::middleware('auth:sanctum')->group(function () {
    // Auth Routes -------
    Route::post('/logout', [AuthController::class, 'logOut'])->name('logout');

    //Statement Routes -------
    Route::apiResource('statement', StatementController::class)->except(['index', 'show'])->names('statement');
});

//Statement Route -------
Route::apiResource('statement', StatementController::class)->only(['index', 'show']);
