<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'RegNumber' => mb_strtoupper($this->faker->bothify('#??#?#')),
            'VIN' => $this->faker->numerify('#################'),
            'Model' => $this->faker->text(rand(10,20)),
            'Brand' => $this->faker->text(rand(10,20)),
        ];
    }
}
