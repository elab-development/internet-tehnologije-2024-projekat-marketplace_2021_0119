<?php

use App\Http\Controllers\AukcijaController;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\ProizvodController;
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
Route::resource('proizvods', ProizvodController::class);

Route::get('/aukcijas', [AukcijaController::class, 'index']); // GET - lista aukcija
Route::post('/aukcijas', [AukcijaController::class, 'store']); // POST - kreiranje aukcije
Route::get('/aukcijas/{id}', [AukcijaController::class, 'show']); // GET - prikaz detalja aukcije

Route::get('/korisniks', [KorisnikController::class, 'index']);
Route::post('/korisniks', [KorisnikController::class, 'store']);
Route::get('/korisniks/{id}', [KorisnikController::class, 'show']);
Route::put('/korisniks/{id}', [KorisnikController::class, 'update']);
Route::delete('/korisniks/{id}', [KorisnikController::class, 'destroy']);

Route::get('/proizvods', [ProizvodController::class, 'index']);
 //automatski generiše rute za CRUD operacije



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
