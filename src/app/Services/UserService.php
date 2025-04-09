<?php

namespace App\Services;

use App\Repositories\UserRepositories;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserService
{

    public function __construct(protected UserRepositories $userRepositories) {}

    public function findUser(string $email)
    {
        $user = $this->userRepositories->findUser($email);

        if (!$user) {
            return throw new HttpException(403, 'No permission!');
        }

        return $user;
    }

    public function getUsers($user)
    {
        if (!$this->userRepositories->userIsAdmin($user)) {
            return throw new HttpException(403, 'No permission!');
        }

        return $this->userRepositories->getAllUsers();
    }

    public function createUser(array $data)
    {
        return $this->userRepositories->createUser($data);
    }

    public function getUser(int $id, $user_id)
    {
        if ($id !== $user_id) {
            return throw new HttpException(403, "No permission!");
        }

        return $this->userRepositories->getUser($id);
    }

    public function updateUser(array $data, int $id, int $user_id)
    {
        $user = $this->userRepositories->getUser($user_id);

        if ($user->id !== $user_id) {
            return throw new HttpException(403, "No permission!");
        }

        return $this->userRepositories->updateUser($data, $id);
    }

    public function deleteUser(string $id, $user_id)
    {
        $user = $this->userRepositories->getUser($user_id);

        if ($user->id !== $user_id) {
            return throw new HttpException(403, "No permission!");
        }

        return $this->userRepositories->deleteUser($id);
    }
}
