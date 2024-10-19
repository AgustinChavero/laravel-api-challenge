<?php

namespace Database\Factories;

use App\Models\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentStatusFactory extends Factory
{
    protected $model = PaymentStatus::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Pending', 'Completed']),
            'color' => $this->faker->hexColor(),
        ];
    }
}
