<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            LanguageSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PaymentStatusSeeder::class,
            PostCategorySeeder::class,
        ]);
    }
}
