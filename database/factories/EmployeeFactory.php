<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_card_number' => $this->faker->unique()->regexify('ID[0-9]{4}-[0-9]{4}'),
            'employee_name' => $this->faker->name(),
            'designation' => $this->faker->jobTitle(),
            'department_id' => Department::inRandomOrder()->first()->id,
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
}
//
