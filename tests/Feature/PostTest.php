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
    public function testDisplaysPosts()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('Post');
    }

    public function testDisplaysPostCreated()
    {
        $post = factory(Post::class)->make();
        $this->get('/')
            ->assertStatus(200)
            ->assertSee($post->name);
    }
}
