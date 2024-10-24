<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Role;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostInteraction;
use App\Models\Payment;
use App\Models\PaymentStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_belongs_to_role(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();

        $user = User::factory()->create([
            'role_id' => $role->id,
            'language_id' => $language->id,
        ]);

        $this->assertInstanceOf(Role::class, $user->role);
    }

    public function test_belongs_to_language(): void
    {
        $language = Language::factory()->create();
        $user = User::factory()->create(['language_id' => $language->id]);

        $this->assertInstanceOf(Language::class, $user->language);
    }

    public function test_has_many_posts(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();
        $category = PostCategory::factory()->create();

        $user = User::factory()
            ->hasPosts(3, ['category_id' => $category->id])
            ->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $this->assertCount(3, $user->posts);
        $this->assertInstanceOf(Post::class, $user->posts->first());
    }

    public function test_has_many_post_interactions(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();

        $user = User::factory()
            ->hasPostInteractions(3)
            ->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $this->assertCount(3, $user->postInteractions);
        $this->assertInstanceOf(PostInteraction::class, $user->postInteractions->first());
    }

    public function test_has_many_payments(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();
        $status = PaymentStatus::factory()->create();

        $user = User::factory()
            ->hasPayments(3, ['status_id' => $status->id])
            ->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $this->assertCount(3, $user->payments);
        $this->assertInstanceOf(Payment::class, $user->payments->first());
    }

    public function test_belongs_to_many_following(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();

        $user = User::factory()->create(['role_id' => $role->id, 'language_id' => $language->id]);
        $followingUser = User::factory()->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $user->following()->attach($followingUser);

        $this->assertTrue($user->following->contains($followingUser));
    }

    public function test_belongs_to_many_followers(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();

        $user = User::factory()->create(['role_id' => $role->id, 'language_id' => $language->id]);
        $followerUser = User::factory()->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $user->followers()->attach($followerUser);

        $this->assertTrue($user->followers->contains($followerUser));
    }
}
