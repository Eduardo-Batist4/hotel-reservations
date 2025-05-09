<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservationController;
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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/users', [AuthController::class, 'register']);

// Hotels
Route::get('/hotels', [HotelController::class, 'index']);
Route::get('/hotels/{id}', [HotelController::class, 'show']);

// Room 
Route::get('/hotels/{id}/rooms', [RoomController::class, 'index']);
Route::get('/hotels/rooms/{id}', [RoomController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    // User 
    Route::get('/users', [UserController::class, 'index'])->middleware('isAdmin');
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Hotels 
    Route::post('/hotels', [HotelController::class, 'store'])->middleware('isAdmin');
    Route::put('/hotels/{id}', [HotelController::class, 'update'])->middleware('isAdmin');
    Route::delete('/hotels/{id}', [HotelController::class, 'destroy'])->middleware('isAdmin');

    // Rooms
    Route::post('/rooms', [RoomController::class, 'store'])->middleware('isAdmin');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->middleware('isAdmin');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->middleware('isAdmin');

    // Reservation
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::get('/reservations/{id}', [ReservationController::class, 'show']);
    Route::put('/reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->middleware('isAdmin');

});