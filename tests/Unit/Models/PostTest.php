<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use App\Models\Role;
use App\Models\Language;
use App\Models\PostStat;
use App\Models\PostInteraction;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_belongs_to_user(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $post->user);
    }

    public function test_belongs_to_post_category(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $category = PostCategory::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id, 'category_id' => $category->id]);

        $this->assertInstanceOf(PostCategory::class, $post->category);
    }

    public function test_has_one_stats(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $postWithStats = Post::factory()->hasStats()->create(['user_id' => $post->user_id]);

        $this->assertInstanceOf(PostStat::class, $postWithStats->stats);
    }

    public function test_has_many_interactions(): void
    {
        $role = Role::factory()->create();
        $language = Language::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id, 'language_id' => $language->id]);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $postWithInteractions = Post::factory()->hasInteractions(3)->create(['user_id' => $post->user_id]);

        $this->assertCount(3, $postWithInteractions->interactions);
        $this->assertInstanceOf(PostInteraction::class, $postWithInteractions->interactions->first());
    }
}
