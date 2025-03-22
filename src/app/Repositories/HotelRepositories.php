<?php

namespace App\Repositories;

use App\Models\Hotel;

class HotelRepositories
{

    public function getAllHotels()
    {
        return Hotel::all();
    }

    public function getHotel(string $id)
    {
        return Hotel::findOrFail($id);
    }

    public function createHotel(array $data)
    {
        return Hotel::create($data);
    }

    public function updateHotel(array $data, string $id)
    {
        $hotel = Hotel::findOrFail($id);
        
        $hotel->update($data);

        return $hotel;
    }

    public function deleteHotel(string $id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel->destroy($id);
    }
}

