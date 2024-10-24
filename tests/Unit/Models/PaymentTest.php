<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Payment;
use App\Models\User;
use App\Models\Role;
use App\Models\Language;
use App\Models\PaymentStatus;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_belongs_to_user(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $payment = Payment::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $payment->user);
    }

    public function test_belongs_to_status(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $status = PaymentStatus::factory()->create();
        $payment = Payment::factory()->create(['user_id' => $user->id, 'status_id' => $status->id]);

        $this->assertInstanceOf(PaymentStatus::class, $payment->status);
    }

    public function test_has_correct_amount_format(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $payment = Payment::factory()->create(['user_id' => $user->id]);

        $this->assertMatchesRegularExpression('/^\d+(\.\d{1,2})?$/', $payment->amount);
    }
}
