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


Route::post("/api/login/",[UserController::class,"login"]);

Route::middleware("api.auth")->group(function(){
    // *Rutas de Usuario
    Route::get("/api/users",[UserController::class,"index"]);
    Route::get("/api/user/{id}",[UserController::class,"show"]);
    Route::post("/api/register",[UserController::class,"store"]);
    Route::delete("/api/delete-user/{id}",[UserController::class,"destroy"]);
    Route::post("/api/user/upload",[UserController::class,"upload"]);
    Route::get("/api/user/avatar/{filename}",[UserController::class,"getImage"]);
    Route::put("/api/modify-user/{id}",[UserController::class,"update"]);

    // * Rutas de roles
    Route::get("/api/roles-users",[RolesController::class,"index"]);
    Route::get("/api/role-user/{id}",[RolesController::class,"show"]);
    Route::post("/api/register-roles",[RolesController::class,"store"]);
    Route::put("/api/modify-role/{id}",[RolesController::class,"update"]);
    Route::delete("/api/delete-role/{id}",[RolesController::class,"destroy"]);

    //* Rutas de Permisos
});


