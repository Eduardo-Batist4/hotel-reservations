<?php

namespace App\Services;

use App\Repositories\HotelRepositories;
use App\Repositories\UserRepositories;
use Error;

class HotelService 
{

    public function __construct(protected HotelRepositories $hotelRepositories, protected UserRepositories $userRepositories)
    {
    }

    public function getHotels()
    {
        return $this->hotelRepositories->getAllHotels();
    }

    public function createHotel(array $data, $user)
    {
        if(!$this->userRepositories->userIsAdmin($user)) {
            return throw new Error('No permission!', 400);
        }
        return $this->hotelRepositories->createHotel($data);
    }

    public function getHotel(string $id)
    {
        return $this->hotelRepositories->getHotel($id);
    }

    public function updateHotel(array $data, $id, $user)
    {
        if(!$this->userRepositories->userIsAdmin($user)) {
            return throw new Error('No permission!', 400);
        }

        return $this->hotelRepositories->updateHotel($data, $id);
    }

    public function deleteHotel(string $id)
    {
        return $this->hotelRepositories->deleteHotel($id);
    }

}


