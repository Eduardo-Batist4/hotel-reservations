<?php

namespace App\Repositories;

use App\Models\Reservation;

class ReservationRepositories
{

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
}
