<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\AukcijaController;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\ProizvodController;
use App\Http\Controllers\UserController;
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

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::group(['middleware'=>['auth:sanctum']],function(){

Route::get('/profile',function(Request $request){
    return auth()->user();
});

Route::resource('/proizvods', ProizvodController::class)->only('update','store','destroy');

Route::post('/logout', [AuthController::class,'logout']);


});


Route::get('/proizvods', [ProizvodController::class, 'index']);
 //automatski generiše rute za CRUD operacije



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
