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

    public function deleteHotel(string $id)
    {
        return Hotel::destroy($id);
    }
}

