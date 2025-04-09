<?php

namespace App\Repositories;

use App\Models\Hotel;

class HotelRepositories
{

    public function getAllHotels(array $filters)
    {
        $query = Hotel::query();

        if (!empty($filters['location'])) {
            $query->location($filters['location']);
        }

        if (!empty($filters['amenities'])) {
            $query->amenities($filters['amenities']); 
        }

        return $query->get();
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

