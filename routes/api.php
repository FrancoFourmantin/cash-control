<?php

use App\Http\Controllers\CategoryController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// USER RESOURCES
Route::get('/users' , [UserController::class, 'index']);
Route::post('/users' , [UserController::class , 'create']);
Route::get('/users/{slug}' , [UserController::class , 'show']);
Route::put('/users/{slug}' , [UserController::class  , 'update']);
Route::delete('/users/{slug}' , [UserController::class , 'destroy']);


// CATEGORIES RESOURCES
Route::get('/categories' , [CategoryController::class, 'index']);
Route::post('/categories' , [CategoryController::class , 'create']);
Route::get('/categories/{id}' , [CategoryController::class , 'show']);
Route::put('/categories/{id}' , [CategoryController::class  , 'update']);
Route::delete('/categories/{id}' , [CategoryController::class , 'destroy']);

// MOVEMENTS RESOURCES
Route::get('/movements' , [MovementController::class, 'index']);
Route::post('/movements' , [MovementController::class , 'create']);
Route::get('/movements/{id}' , [MovementController::class , 'show']);
Route::put('/movements/{id}' , [MovementController::class  , 'update']);
Route::delete('/movements/{id}' , [MovementController::class , 'destroy']);


// USER_CATEGORIES RESOURCES
//Route::get('/categories' , [CategoryController::class, 'index']);
//Route::post('/categories' , [CategoryController::class , 'create']);
//Route::get('/categories/{id}' , [CategoryController::class , 'show']);
//Route::put('/categories/{id}' , [CategoryController::class  , 'update']);
//Route::delete('/categories/{id}' , [CategoryController::class , 'destroy']);
