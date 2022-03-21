<?php

namespace Database\Factories;

use App\Models\Scheduling;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'scheduling' => Scheduling::factory(),
            'note' => $this->faker->sentence(100),
        ];
    }
}
