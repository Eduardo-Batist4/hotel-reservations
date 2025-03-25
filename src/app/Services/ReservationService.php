<?php

namespace App\Services;

use App\Repositories\ReservationRepositories;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ReservationService
{

    public function __construct(
        protected ReservationRepositories $reservationRepositories, 
        protected RoomService $roomService, 
        protected UserService $userService
    ){}
    
    public function getAllReservations(string $id)
    {
        return $this->userService->getUser($id)->load('reservations');
    }

    public function createReservation(array $data)
    {
        $checkIn = Carbon::parse($data['check_in_date']);
        $checkOut = Carbon::parse($data['check_out_date']);

        $day = $checkIn->diffInDays($checkOut);

        $roomPrice = $this->roomService->getRoom($data['room_id']);

        $totalPrice = $day * $roomPrice->price;
        
        $data['total_price'] = $totalPrice;

        if($this->reservationRepositories->isRoomAvailable($data['room_id'], $data['check_in_date'], $data['check_out_date'])) {
            return throw new HttpException(403, 'Room unavailable!');
        }

        return $this->reservationRepositories->createReservation($data);
    }

    public function getReservation(string $id)
    {
        return $this->reservationRepositories->getReservation($id);
    }
}
