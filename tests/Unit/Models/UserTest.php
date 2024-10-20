<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Role;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostInteraction;
use App\Models\Payment;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_belongs_to_role(): void
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(Role::class, $user->role);
    }

    public function test_belongs_to_language(): void
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(Language::class, $user->language);
    }

    public function test_has_many_posts(): void
    {
        $user = User::factory()->hasPosts(3)->create();
        $this->assertCount(3, $user->posts);
        $this->assertInstanceOf(Post::class, $user->posts->first());
    }

    public function test_has_many_post_interactions(): void
    {
        $user = User::factory()->hasPostInteractions(3)->create();
        $this->assertCount(3, $user->postInteractions);
        $this->assertInstanceOf(PostInteraction::class, $user->postInteractions->first());
    }

    public function test_has_many_payments(): void
    {
        $user = User::factory()->hasPayments(3)->create();
        $this->assertCount(3, $user->payments);
        $this->assertInstanceOf(Payment::class, $user->payments->first());
    }

    public function test_belongs_to_many_following(): void
    {
        $user = User::factory()->create();
        $followingUser = User::factory()->create();

        $user->following()->attach($followingUser);

        $this->assertTrue($user->following->contains($followingUser));
    }

    public function test_belongs_to_many_followers(): void
    {
        $user = User::factory()->create();
        $followerUser = User::factory()->create();

        $user->followers()->attach($followerUser);

        $this->assertTrue($user->followers->contains($followerUser));
    }
}
