<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{

    use WithoutModelEvents;

    public function run(): void
    {
        Room::factory(10)->create();
    }
}
