<?php

namespace App\Services;

use App\Repositories\UserRepositories;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserService 
{

    public function __construct(protected UserRepositories $userRepositories)
    {
    }

    public function findUser(string $email)
    {
        $user = $this->userRepositories->findUser($email);

        if(!$user) {
            return throw new HttpException(403, 'No permission!');
        }

        return $user;
    }

    public function getUsers($user)
    {
        if(!$this->userRepositories->userIsAdmin($user)) {
            return throw new HttpException(403, 'No permission!');
        }

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

