<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function __construct(protected ReservationService $reservationService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->reservationService->getAllReservations(Auth::id());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'user_id' => 'required|numeric|min:1|exists:users,id',
            'room_id' => 'required|numeric|min:1|exists:rooms,id',

            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',

            'total_price' => 'sometimes|numeric|min:1',
        ]);

        $reservation = $this->reservationService->createReservation($validateData);

        return response()->json([
            'message' => 'Reservation successfully',
            'reservation' => $reservation
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->reservationService->getReservation($id, Auth::id());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
