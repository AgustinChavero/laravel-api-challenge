<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        Language::create([
            'name' => 'English',
            'code' => 'EN',
        ]);

        Language::create([
            'name' => 'Spanish',
            'code' => 'ES',
        ]);

        Language::factory()->count(8)->create();
    }
}
