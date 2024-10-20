<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Language;

class LanguageFactory extends Factory
{
    protected $model = Language::class;

    public function definition(): array
    {
        $languages = [
            'French' => 'FR',
            'German' => 'DE',
            'Italian' => 'IT',
            'Portuguese' => 'PT',
            'Russian' => 'RU',
            'Chinese' => 'ZH',
            'Japanese' => 'JA',
            'Korean' => 'KO',
            'Arabic' => 'AR',
            'Turkish' => 'TR',
        ];

        $language = $this->faker->unique()->randomElement(array_keys($languages));
        $code = $languages[$language];

        return [
            'name' => $language,
            'code' => $code,
        ];
    }
}
