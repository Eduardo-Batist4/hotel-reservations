<?php

namespace App\Repositories;

use App\Models\Reservation;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ReservationRepositories
{

    public function findReservation(string $id) 
    {
        $reservation = Reservation::findOrFail($id);

        return $reservation;
    }

    public function getAllReservations(string $id)
    {
        $reservations = Reservation::where('user_id', $id)->get();

        if (!$reservations) {
            throw new HttpException(404, 'You are not have reservations!');
        }

        return $reservations;
    }

    public function getReservation(string $id)
    {
        return Reservation::findOrFail($id);
    }

    public function isRoomAvailable($roomId, $checkIn, $checkOut): bool
    {
        return Reservation::where('room_id', $roomId)
            ->where('status', 'confirmed')
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in_date', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out_date', [$checkIn, $checkOut])
                    ->orWhere(function ($q) use ($checkIn, $checkOut) {
                        $q->where('check_in_date', '<=', $checkIn)
                            ->where('check_out_date', '>=', $checkOut);
                    });
            })
            ->exists();
    }

    public function createReservation(array $data)
    {
        return Reservation::create($data);
    }

    public function cancelReservation(string $id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->update(['status' => 'cancelled']);

        return true;
    }
}
