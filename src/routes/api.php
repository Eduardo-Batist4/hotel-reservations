<?php

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
Route::post('/login', [UserController::class, 'login']);

// Users
Route::post('/users', [UserController::class, 'store']);

// Hotels
Route::get('/hotels', [HotelController::class, 'index']);    // **Precisa fazer filtro com preço e localização**
Route::get('/hotels/{id}', [HotelController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    // User 
    Route::get('/users', [UserController::class, 'index']); // (ADMIN)

    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Hotels 
    Route::post('/hotels', [HotelController::class, 'store']); // (ADMIN)
    Route::put('/hotels/{id}', [HotelController::class, 'update']); // (ADMIN)
    Route::delete('/hotels/{id}', [HotelController::class, 'destroy']); // (ADMIN)

    // Room 
    Route::get('/hotels/{id}/rooms', [RoomController::class, 'index']);
    Route::get('/rooms/{id}', [RoomController::class, 'show']);

    Route::post('/rooms', [RoomController::class, 'store']); // (ADMIN)
    Route::put('/rooms/{id}', [RoomController::class, 'update']); // (ADMIN)
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy']); // (ADMIN)

    // Reservation
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::get('/reservations/{id}', [ReservationController::class, 'show']);
    Route::put('/reservations/{id}', [ReservationController::class, 'destroy']);

});



Route::middleware('auth:sanctum')->get('/user/logado', function (Request $request) {
    return $request->user();
});
