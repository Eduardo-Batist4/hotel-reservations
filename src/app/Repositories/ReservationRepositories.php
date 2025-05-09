<?php

namespace App\Repositories;

use App\Models\Reservation;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ReservationRepositories
{

    public function findReservation(int $id, int $user_id) 
    {
        $reservation = Reservation::where('id', $id)
            ->where('user_id', $user_id)
            ->first();

        return $reservation;
    }

    public function getAllReservations(int $id)
    {
        $reservations = Reservation::where('user_id', $id)->get();

        if (!$reservations) {
            throw new HttpException(404, 'You are not have reservations!');
        }

        return $reservations;
    }

    public function getReservation(int $id)
    {
        $reservation = Reservation::findOrFail($id);

        return $reservation;
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

    public function cancelReservation(int $id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->update(['status' => 'cancelled']);

        return true;
    }

    public function deleteReservation(int $id) 
    {
        $reservation =  Reservation::findOrFail($id);

        $reservation->destroy($id);
    }
}
