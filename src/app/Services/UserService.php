<?php

namespace App\Services;

use App\Repositories\UserRepositories;

class UserService
{

    public function __construct(protected UserRepositories $userRepositories) {}

    public function findUser(string $email)
    {
        return $this->userRepositories->findUser($email);
    }

    public function getUsers($user)
    {
        return $this->userRepositories->getAllUsers();
    }

    public function createUser(array $data)
    {
        return $this->userRepositories->createUser($data);
    }

    public function getUser(int $id)
    {
        return $this->userRepositories->getUser($id);
    }

    public function updateUser(array $data, int $id)
    {
        return $this->userRepositories->updateUser($data, $id);
    }

    public function deleteUser(string $id)
    {
        return $this->userRepositories->deleteUser($id);
    }
}
