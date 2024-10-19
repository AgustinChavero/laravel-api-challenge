<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentStatus;

class PaymentStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Pending', 'color' => '#FFA500'],
            ['name' => 'Completed', 'color' => '#008000'],
            ['name' => 'Failed', 'color' => '#FF0000'],
        ];

        foreach ($statuses as $status) {
            PaymentStatus::create($status);
        }
    }
}
