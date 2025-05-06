<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{

    use WithoutModelEvents;

    public function run(): void
    {
        Hotel::factory(5)->create();
    }
}
