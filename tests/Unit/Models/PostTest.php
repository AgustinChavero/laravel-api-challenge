<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use App\Models\PostStat;
use App\Models\PostInteraction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    public function test_belongs_to_post_category(): void
    {
        $post = Post::factory()->create();
        $this->assertInstanceOf(PostCategory::class, $post->category);
    }

    public function test_belongs_to_user(): void
    {
        $post = Post::factory()->create();
        $this->assertInstanceOf(User::class, $post->user);
    }

    public function test_has_one_stats(): void
    {
        $post = Post::factory()->hasStats()->create();
        $this->assertInstanceOf(PostStat::class, $post->stats);
    }

    public function test_has_many_interactions(): void
    {
        $post = Post::factory()->hasInteractions(3)->create();
        $this->assertCount(3, $post->interactions);
        $this->assertInstanceOf(PostInteraction::class, $post->interactions->first());
    }
}
