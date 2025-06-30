<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_card_no' => $this->faker->unique()->bothify('ID###-####'),
            'employee_name' => $this->faker->name(),
            'designation' => $this->faker->jobTitle(),
            'department' => $this->faker->randomElement(['HR', 'IT', 'Finance', 'Marketing']),
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['present', 'absent', 'on_leave']),
        ];
    }
}
