<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
use App\Models\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status_id' => PaymentStatus::factory(),
            'transfer_id' => $this->faker->unique()->randomNumber(5),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
