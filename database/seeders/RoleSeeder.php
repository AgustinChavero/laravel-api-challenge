<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'color' => '#FF5733', 'price' => 0],
            ['name' => 'Viewer', 'color' => '#1E90FF', 'price' => 0],
            ['name' => 'Viewer Premium', 'color' => '#FFD700', 'price' => 100],
            ['name' => 'Moderator', 'color' => '#6A5ACD', 'price' => 0],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
