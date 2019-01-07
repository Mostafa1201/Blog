<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDisplayPosts()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('Post');
    }

    public function testDisplayPostCreated()
    {
        $post = factory(Post::class)->create();
        $this->get('/')
            ->assertStatus(200)
            ->assertSee($post->name);
    }
}
