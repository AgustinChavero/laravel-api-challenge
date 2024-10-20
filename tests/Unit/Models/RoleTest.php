<?php

namespace Tests\Unit\Models;

use App\Models\Role;
use App\Models\User;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public function test_has_many_users(): void
    {
        $role = Role::factory()->hasUsers(3)->create();

        $this->assertCount(3, $role->users);
        $this->assertInstanceOf(User::class, $role->users->first());
    }
}
