<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JocController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValoracioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//MAIN ROUTES
Route::get('/home', [HomeController::class,'index']);
Route::get('/main', [HomeController::class,'index']);
Route::get('/', [HomeController::class, 'index']);

// USER ROUTES ----------------------------------------------------------
/*Route::get('login', function () {
    return view('auth.login');
});*/
Route::get('/seeUsers', [UserController::class,'viewUsers']);
Route::get('/user/{id}/delete', [UserController::class,'deleteUser']);
Route::get('/user/{id}/update', [UserController::class,'updateUserView']);
Route::post('/updateUser', [UserController::class,'update']);
Route::post('/myProfile', [UserController::class,'profile']);
Route::get('/user/{id}', [UserController::class,'getUserById']);

//ROOM ROUTES -----------------------------------------------------------
Route::get('/roomView', [SalaController::class,'view']);
Route::resource('/rooms', SalaController::class)->middleware('auth');

//GAME ROUTES -----------------------------------------------------------
Route::get('/gamesView', [JocController::class,'view']);
Route::resource('/games', JocController::class);

//RESERVA ROUTES --------------------------------------------------------
//Route::get('/reservesView', [ReservaController::class,'view']);
Route::get('/makeReservation', [ReservaController::class,'view'])->middleware('auth');
Route::get('/reserves/confirm', [ReservaController::class,'confirm']);
Route::get('/myReservations', [ReservaController::class,'user']);
Route::resource('/reserves', ReservaController::class)->middleware('auth');

//VALORACIO ROUTES
Route::get('/valoracions/{id}', [ValoracioController::class, 'index']);
Route::resource('/valoracions', ValoracioController::class)->middleware('auth');
