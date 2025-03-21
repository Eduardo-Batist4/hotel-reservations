<?php

namespace App\Services;

use App\Repositories\UserRepositories;

class UserService 
{

    public function __construct(protected UserRepositories $userRepositories)
    {
    }

    public function getUsers()
    {
        return $this->userRepositories->getAllUsers();
    }

    public function createUser(array $data)
    {
        return $this->userRepositories->createUser($data);
    }

    public function getUser(string $id)
    {
        return $this->userRepositories->getUser($id);
    }

    public function updateUser(array $data, string $id)
    {
        return $this->userRepositories->updateUser($data, $id);
    }

    public function deleteUser(string $id)
    {
        return $this->userRepositories->deleteUser($id);
    }
}

