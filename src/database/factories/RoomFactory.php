<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $countHotel = 1;

        return [
            'hotel_id' => $countHotel++,
            'room_type' =>  fake()->randomElement(['single', 'double', 'suite']),
            'price' => fake()->randomFloat(2, 150, 1000),
            'available' => true
        ];
    }
}
