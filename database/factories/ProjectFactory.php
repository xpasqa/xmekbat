<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'no_order' => $this->faker->randomNumber(5, true).now()->toDateString(),
            'project_name' => $this->faker->word(),
            'project_location' => $this->faker->city(),
            'total_sample' => $this->faker->randomNumber(3, false),
            'pic' => $this->faker->name(),
            'company_name' => $this->faker->state(),
            'company_address' => $this->faker->address(),
            'file' => 'sample.pdf',
            'status' => $this->faker->randomElement(['accept', 'process']),
            'estimated_opened' => now()->toDateString(),
        ];
    }
}
