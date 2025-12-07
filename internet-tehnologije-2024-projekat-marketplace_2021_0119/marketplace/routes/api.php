<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\AukcijaController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProizvodController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KupovinaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ------------------- PUBLIC ROUTES -------------------

// Proizvodi – samo public read (index, show)
Route::resource('proizvods', ProizvodController::class)->only(['index', 'show']);

// Aukcije public
Route::get('/aukcijas', [AukcijaController::class, 'index']);
Route::get('/aukcijas/{id}', [AukcijaController::class, 'show']);
Route::get('/aukcijas/filter', [AukcijaController::class, 'filterIndex']);


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

// Password reset
Route::post('/forgot-password', [PasswordResetController::class, 'forgotPassword']);
Route::post('/reset-password', [PasswordResetController::class,'resetPassword']);

// Users CRUD
Route::apiResource('/users', UserController::class);


// ------------------- PROTECTED ROUTES -------------------
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/profile', function(Request $request){
        return auth()->user();
    });

    // Proizvodi – create, update, delete
    Route::resource('proizvods', ProizvodController::class)->only(['store','update','destroy']);
    Route::post('/kupovinas', [KupovinaController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/logout', [AuthController::class,'logout']);
});