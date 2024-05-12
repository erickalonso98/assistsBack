<?php

use App\Http\Controllers\PermissionController;
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
use App\Http\Controllers\StateController;

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
    Route::get("/api/roles",[RolesController::class,"index"]);
    Route::get("/api/role/{id}",[RolesController::class,"show"]);
    Route::post("/api/register-roles",[RolesController::class,"store"]);
    Route::put("/api/modify-role/{id}",[RolesController::class,"update"]);
    Route::delete("/api/delete-role/{id}",[RolesController::class,"destroy"]);

    //* Rutas de Permisos
    Route::get("/api/permissions",[PermissionController::class,"index"]);
    Route::get("/api/permission/{id}",[PermissionController::class,"show"]);
    Route::post("/api/register-permission",[PermissionController::class,"store"]);
    Route::put("/api/modify-permission/{id}",[PermissionController::class,"update"]);
    Route::delete("/api/delete-permission/{id}",[PermissionController::class,"destroy"]);

    //* Rutas de Estados

    Route::get("/api/states",[StateController::class,"index"]);
    Route::get("/api/state/{id}",[StateController::class,"show"]);
    Route::post("/api/register-state/",[StateController::class,"store"]);
    Route::put("/api/modify-state/{id}",[StateController::class,"update"]);
    Route::delete("/api/delete-state/{id}",[StateController::class,"destroy"]);
});


