<?php

namespace App\Services;

use App\Repositories\HotelRepositories;
use App\Repositories\UserRepositories;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HotelService
{

    public function __construct(protected HotelRepositories $hotelRepositories, protected UserRepositories $userRepositories) {}

    public function getHotels(array $filters)
    {
        return $this->hotelRepositories->getAllHotels($filters);
    }

    public function getHotelWithAllRooms(int $id)
    {
        return $this->hotelRepositories->getHotelWithAllRooms($id);
    }

    public function createHotel(array $data, $user)
    {
        if (!$this->userRepositories->userIsAdmin($user)) {
            return throw new HttpException(403, 'No permission!');
        }
        return $this->hotelRepositories->createHotel($data);
    }

    public function getHotel(string $id)
    {
        return $this->hotelRepositories->getHotel($id);
    }

    public function updateHotel(array $data, $id, $user)
    {
        if (!$this->userRepositories->userIsAdmin($user)) {
            return throw new HttpException(403, 'No permission!');
        }

        return $this->hotelRepositories->updateHotel($data, $id);
    }

    public function deleteHotel(string $id, $user)
    {
        if (!$this->userRepositories->userIsAdmin($user)) {
            return throw new HttpException(403, 'No permission!');
        }
        return $this->hotelRepositories->deleteHotel($id);
    }
}
