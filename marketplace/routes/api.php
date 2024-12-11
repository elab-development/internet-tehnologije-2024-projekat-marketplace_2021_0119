<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ProizvodController;

Route::resource('proizvods', ProizvodController::class);

// Route::get('proizvods', [ProizvodController::class, 'index']);
// Route::post('proizvods', [ProizvodController::class, 'store']);
// Route::get('proizvods/{id}', [ProizvodController::class, 'show']);
// Route::put('proizvods/{id}', [ProizvodController::class, 'update']);
// Route::delete('proizvods/{id}', [ProizvodController::class, 'destroy']);

use App\Http\Controllers\AukcijaController;

// Dodavanje API ruta za Aukcija model
Route::get('aukcijas', [AukcijaController::class, 'index']); // GET - lista aukcija
Route::post('aukcijas', [AukcijaController::class, 'store']); // POST - kreiranje aukcije
Route::get('aukcijas/{id}', [AukcijaController::class, 'show']); // GET - prikaz detalja aukcije


// Dodavanje API ruta za Korisnik model
use App\Http\Controllers\KorisnikController;

// Rute za model Korisnik
Route::get('korisniks', [KorisnikController::class, 'index']);
Route::post('korisniks', [KorisnikController::class, 'store']);
Route::get('korisniks/{id}', [KorisnikController::class, 'show']);
Route::put('korisniks/{id}', [KorisnikController::class, 'update']);
Route::delete('korisniks/{id}', [KorisnikController::class, 'destroy']);




Route::get('proizvods', [ProizvodController::class, 'index']);
 //automatski generiše rute za CRUD operacije


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
