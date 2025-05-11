<?php

namespace App\Services;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\NotFoundException;
use App\Exceptions\RoomUnavailableException;
use App\Repositories\ReservationRepositories;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationService
{

    public function __construct(
        protected ReservationRepositories $reservationRepositories, 
        protected RoomService $roomService, 
        protected UserService $userService
    ){}
    
    public function getAllReservations(string $id)
    {
        return $this->reservationRepositories->getAllReservations($id);
    }

    public function createReservation(array $data)
    {
        $checkIn = Carbon::parse($data['check_in_date']);
        $checkOut = Carbon::parse($data['check_out_date']);

        $day = $checkIn->diffInDays($checkOut);

        $roomPrice = $this->roomService->getRoom($data['room_id']);

        $totalPrice = $day * $roomPrice->price;
        
        $data['total_price'] = $totalPrice;

        $data['user_id'] = Auth::id();

        if($this->reservationRepositories->isRoomAvailable($data['room_id'], $data['check_in_date'], $data['check_out_date'])) {
            return throw new RoomUnavailableException();
        }

        return $this->reservationRepositories->createReservation($data);
    }

    public function getReservation(string $id)
    {
        $reservation = $this->reservationRepositories->getReservation($id);
        
        if($reservation->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return throw new NotFoundException();
        }

        return $reservation; 
    }

    public function cancelReservation($id)
    {
        $reservation = $this->reservationRepositories->findReservation($id, Auth::id());

        if(!$reservation && Auth::user()->role !== 'admin') {
            return throw new AccessDeniedException();
        }

        return $this->reservationRepositories->cancelReservation($id);
    }

    public function deleteReservation(int $id)
    {
        return $this->reservationRepositories->deleteReservation($id);
    }
}
