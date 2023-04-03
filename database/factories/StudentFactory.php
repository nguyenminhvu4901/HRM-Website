<?php

namespace Database\Factories;

use App\Enums\StudentStatusEnum;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
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
            'email' => $this->faker->email,
            'password' => $this->faker->phoneNumber,
            'birthdate' => $this->faker->date(),
            'gender' => $this->faker->numberBetween(0, 1),
            'status' => $this->faker->randomElement(StudentStatusEnum::asArray()),
            'course_id' => Course::query()->inRandomOrder()->value('id'),
        ];
    }
}
