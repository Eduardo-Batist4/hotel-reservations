<?php

namespace App\Services;

use App\Repositories\RoomRepositories;

class RoomService
{

    public function __construct(
        protected RoomRepositories $roomRepositories,
        protected HotelService $hotelService,
    ) {}

    public function getAllRooms(int $id)
    {
        return $this->hotelService->getHotelWithAllRooms($id);
    }

    public function createRoom(array $data)
    {
        return $this->roomRepositories->createRoom($data);
    }

    public function getRoom(string $id)
    {
        return $this->roomRepositories->getRoom($id);
    }

    public function updateRoom(array $data, string $id)
    {
        return $this->roomRepositories->updateRoom($data, $id);
    }

    public function deleteRoom(string $id)
    {
        return $this->roomRepositories->deleteRoom($id);
    }
}
