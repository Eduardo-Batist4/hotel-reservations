<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    use WithoutModelEvents;

    public function run(): void
    {

        User::create([
            'name' => 'Eduardo',
            'email' => 'eduardo@teste.com',
            'password' => 'senha123',
            'role' => 'admin',
        ]);

        User::factory(3)->create();
    }
}
