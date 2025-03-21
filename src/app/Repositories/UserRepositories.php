<?php
 

namespace App\Repositories;

use App\Models\User;

class UserRepositories 
{

    public function getAllUsers()
    {
        return User::all();
    }

    public function createUser(array $data) 
    {
        return User::create($data);
    }

    public function getUser(string $id)
    {
        return User::findOrFail($id);
    }

    public function updateUser(array $data, string $id)
    {
        $user = User::findOrFail($id);

        $user->update($data);
        return $user; 
    }

    public function deleteUser(string $id) 
    {
        $user = User::findOrFail($id);

        $user->delete($id);
    }
}

