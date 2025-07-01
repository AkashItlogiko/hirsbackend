<?php

namespace Database\Factories;

use App\Models\Employee;
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
            'employee_id'=>Employee::inRandomOrder()->first()->id,
            'net_salary' => $this->faker->randomFloat(2, 3000, 10000),
            'pay_date' => $this->faker->date(),
        ];
    }
}
