<?php

namespace Tests\Unit\Models;

use App\Models\Payment;
use App\Models\User;
use App\Models\PaymentStatus;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    public function test_belongs_to_user(): void
    {
        $payment = Payment::factory()->create();

        $this->assertInstanceOf(User::class, $payment->user);
    }

    public function test_belongs_to_status(): void
    {
        $payment = Payment::factory()->create();

        $this->assertInstanceOf(PaymentStatus::class, $payment->status);
    }

    public function test_has_correct_amount_format(): void
    {
        $amount = 150.75;
        $payment = Payment::factory()->create(['amount' => $amount]);

        $this->assertEquals(number_format($amount, 2), $payment->amount);
    }
}
