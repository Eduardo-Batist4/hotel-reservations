<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function __construct(protected ReservationService $reservationService) {}

    public function index()
    {
        return $this->reservationService->getAllReservations(Auth::id());
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
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

    public function show(int $id)
    {
        return response()->json($this->reservationService->getReservation($id), 200);
    }

    public function update(int $id) {
        $this->reservationService->cancelReservation($id);
        return response()->json([
            'message' => 'Reservation successfully canceled!'
        ], 200);
    }

    public function destroy(int $id)
    {
        $this->reservationService->deleteReservation($id);

        return response()->json([
            'message' => 'Reservation successfully deleted!'
        ], 200);
    }
}
