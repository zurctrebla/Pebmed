<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'dob' => $this->faker->date('YmdHis'),
            'gender' => $this->faker->randomElement(['Masculino' ,'Feminino', 'Outros']),
            'height' => $this->faker->randomFloat(),
            'weight' => $this->faker->randomFloat(),
        ];
    }
}
