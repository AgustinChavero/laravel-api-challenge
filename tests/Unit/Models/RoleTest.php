<?php

namespace Tests\Unit\Models;

use Illuminate\Support\Facades\Artisan;
use App\Models\Role;
use App\Models\Language;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_many_users(): void
    {
        $language = Language::factory()->create();

        $role = Role::factory()->has(
            User::factory()->count(3)->state(['language_id' => $language->id])
        )->create();

        $this->assertCount(3, $role->users);

        $this->assertEquals($language->id, $role->users->first()->language_id);
        $this->assertInstanceOf(User::class, $role->users->first());
    }
}
