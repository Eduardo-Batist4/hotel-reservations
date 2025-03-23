<?php

namespace App\Services;

use App\Repositories\RoomRepositories;
use App\Repositories\UserRepositories;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RoomService
{

    public function __construct(protected RoomRepositories $roomRepositories, protected UserRepositories $userRepositories) {}

    public function getAllRooms()
    {
        return $this->roomRepositories->getAllRooms();
    }

    public function createRoom(array $data, $user)
    {
        if(!$this->userRepositories->userIsAdmin($user)) {
            return throw new HttpException(403, 'No permission!');
        }
        return $this->roomRepositories->createRoom($data);
    }

    public function getRoom(string $id)
    {
        return $this->roomRepositories->getRoom($id);
    }

    public function updateRoom(array $data, $user, string $id){
        if(!$this->userRepositories->userIsAdmin($user)) {
            return throw new HttpException(403, 'No permission!');
        }
        return $this->roomRepositories->updateRoom($data, $id);
    }

    public function deleteRoom(string $id, $user)
    {
        if (!$this->userRepositories->userIsAdmin($user)) {
            return throw new HttpException(403, 'No permission!');
        }
        return $this->roomRepositories->deleteRoom($id);
    }
}
