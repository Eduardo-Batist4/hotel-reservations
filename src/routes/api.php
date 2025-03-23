<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

// Login
Route::post('/login', [UserController::class, 'login']); 

// Users
Route::post('/users', [UserController::class, 'store']); 
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Hotels
Route::get('/hotels', [HotelController::class, 'index']);    // **Precisa fazer filtro com preço e localização**
Route::get('/hotels/{id}', [HotelController::class, 'show']); 

// Rooms
Route::get('/hotels/{id}/rooms', [RoomController::class, 'index']); 
Route::get('/rooms/{id}', [RoomController::class, 'show']); 



Route::middleware('auth:sanctum')->group(function () {
    
    // User -> (Admin)
    Route::get('/users', [UserController::class, 'index']);
    
    // Hotels -> (Admin)
    Route::post('/hotels', [HotelController::class, 'store']); 
    Route::put('/hotels/{id}', [HotelController::class, 'update']);
    Route::delete('/hotels/{id}', [HotelController::class, 'destroy']);
    
    // Room -> (Admin)
    Route::post('/rooms', [RoomController::class, 'store']);
    Route::put('/rooms/{id}', [RoomController::class, 'update']);
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);


});



Route::middleware('auth:sanctum')->get('/user/logado', function (Request $request) {
    return $request->user();
});
