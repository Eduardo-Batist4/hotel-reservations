<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepositories
{

    public function getAllRooms()
    {
        return Room::all();
    }

    public function createRoom(array $data)
    {
        return Room::create($data);
    }

    public function getRoom(string $id)
    {
        return Room::findOrFail($id);
    }

    public function updateRoom(array $data, string $id)
    {
        $room = Room::findOrFail($id);

        $room->update($data);
        return $room;
    }

    public function deleteRoom($id)
    {
        $hotel = Room::findOrFail($id);

        $hotel->destroy($id);
    }
}
