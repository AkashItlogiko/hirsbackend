<?php

namespace Database\Factories;

use App\Models\Employee;
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
            'employee_id'=>Employee::inRandomOrder()->first()->id,
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['present', 'absent', 'on_leave']),
        ];
    }
}
