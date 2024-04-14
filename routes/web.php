<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de Usuario
Route::get("/api/users",[UserController::class,"index"]);
Route::get("/api/user/{id}",[UserController::class,"show"]);
Route::post("/api/save-user",[UserController::class,"store"]);
Route::delete("/api/delete-user/{id}",[UserController::class,"destroy"]);

//Rutas de roles
Route::get("/api/roles-users",[RolesController::class,"index"]);