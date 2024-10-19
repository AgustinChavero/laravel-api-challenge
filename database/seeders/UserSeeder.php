<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Language;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::all();

        foreach ($roles as $role) {
            User::factory()->create([
                'role_id' => $role->id,
                'language_id' => 1,
                'name' => $role->name . ' User',
                'email' => strtolower($role->name) . '@' . strtolower($role->name) . '.com',
                'password' => bcrypt('password'),
            ]);
        }
    }
}
