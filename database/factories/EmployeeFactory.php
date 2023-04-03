<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'avatar' => $this->faker->imageUrl(),
            'level' => $this->faker->boolean(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
        ];
    }
}
