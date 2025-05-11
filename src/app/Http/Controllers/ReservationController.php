<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Services\ReservationService;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function __construct(protected ReservationService $reservationService) {}

    public function index()
    {
        return $this->reservationService->getAllReservations(Auth::id());
    }


    public function store(StoreReservationRequest $request)
    {
        $validateData = $request->validated();

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
