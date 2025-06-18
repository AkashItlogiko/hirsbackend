<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salary>
 */
class SalaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id_card_no' => $this->faker->unique()->bothify('ID###-####'),
            'employee_name' => $this->faker->name(),
            'designation' => $this->faker->jobTitle(),
            'department' => $this->faker->randomElement(['HR', 'IT', 'Finance', 'Marketing']),
            'net_salary' => $this->faker->randomFloat(2, 3000, 10000),
            'pay_date' => $this->faker->date(),
        ];
    }
}
