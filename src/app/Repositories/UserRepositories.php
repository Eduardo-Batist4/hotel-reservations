<?php


namespace App\Repositories;

use App\Models\User;

class UserRepositories
{
    public function userIsAdmin(int $id)
    {
        $user = User::findOrFail($id);
        return $user->role === 'admin';
    }

    public function findUser(string $email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function getUser(int $id)
    {
        return User::findOrFail($id);
    }

    public function updateUser(array $data, int $id)
    {
        $user = User::findOrFail($id);

        $user->update($data);
        return $user;
    }

    public function deleteUser(int $id)
    {
        $user = User::findOrFail($id);

        $user->delete($id);
    }
}
