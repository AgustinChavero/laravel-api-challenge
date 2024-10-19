<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostCategory;

class PostCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'color' => '#1E90FF'],
            ['name' => 'Health', 'color' => '#32CD32'],
            ['name' => 'Education', 'color' => '#FFD700'],
            ['name' => 'Travel', 'color' => '#FF4500'],
            ['name' => 'Food', 'color' => '#FF6347'],
            ['name' => 'Sports', 'color' => '#00BFFF'],
            ['name' => 'Politics', 'color' => '#8B0000'],
            ['name' => 'War', 'color' => '#A52A2A'],
            ['name' => 'Comedy', 'color' => '#FF69B4'],
            ['name' => 'Business', 'color' => '#4682B4'],
            ['name' => 'Art', 'color' => '#DA70D6'],
            ['name' => 'Science', 'color' => '#40E0D0'],
            ['name' => 'Entertainment', 'color' => '#8A2BE2'],
            ['name' => 'Nature', 'color' => '#228B22'],
            ['name' => 'History', 'color' => '#D2691E'],
            ['name' => 'Economics', 'color' => '#B8860B'],
            ['name' => 'Music', 'color' => '#8B4513'],
            ['name' => 'Lifestyle', 'color' => '#FFB6C1'],
            ['name' => 'Culture', 'color' => '#9932CC'],
        ];

        foreach ($categories as $category) {
            PostCategory::create($category);
        }
    }
}
