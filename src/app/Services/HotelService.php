<?php

namespace App\Services;

use App\Repositories\HotelRepositories;
use App\Repositories\UserRepositories;

class HotelService
{

    public function __construct(
        protected HotelRepositories $hotelRepositories,
        protected UserRepositories $userRepositories
    ) {}

    public function getHotels(array $filters)
    {
        return $this->hotelRepositories->getAllHotels($filters);
    }

    public function getHotelWithAllRooms(int $id)
    {
        return $this->hotelRepositories->getHotelWithAllRooms($id);
    }

    public function createHotel(array $data)
    {
        return $this->hotelRepositories->createHotel($data);
    }

    public function getHotel(int $id)
    {
        return $this->hotelRepositories->getHotel($id);
    }

    public function updateHotel(array $data, int $id)
    {
        return $this->hotelRepositories->updateHotel($data, $id);
    }

    public function deleteHotel(int $id)
    {
        return $this->hotelRepositories->deleteHotel($id);
    }
}
