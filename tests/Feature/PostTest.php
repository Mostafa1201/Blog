<?php

namespace Tests\Feature;

use App\Admin;
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

    public function testViewCreatePostPage()
    {
        $admin = factory(Admin::class)->make();
        $response = $this->actingAs($admin)->post('admin/dashboard/login');
        $response->assertRedirect('admin/dashboard');
        $this->get('admin/dashboard/posts/create')
            ->assertStatus(200)
            ->assertSee('Add Post');
    }

    public function testDisplayPostCreated()
    {
        $post = factory(Post::class)->create();
        $this->get('/')
            ->assertStatus(200)
            ->assertSee($post->name);
    }

    public function testDisplayPostDetailsToPass()
    {
        $post = factory(Post::class)->create();
        $this->get('posts/'.$post->id)
            ->assertStatus(200)
            ->assertSee($post->name);
    }

    public function testDisplayPostDetailsToFail()
    {
        $this->get('posts/random')
            ->assertRedirect('404');
    }

    public function testViewEditPostPageToPass()
    {
        $admin = factory(Admin::class)->make();
        $response = $this->actingAs($admin)->post('admin/dashboard/login');
        $response->assertRedirect('admin/dashboard');
        $post = factory(Post::class)->create();
        $this->get('admin/dashboard/posts/'.$post->id.'/edit')
            ->assertStatus(200)
            ->assertSee('Edit Post');
    }

    public function testViewEditPostPageToFail()
    {
        $admin = factory(Admin::class)->make();
        $response = $this->actingAs($admin)->post('admin/dashboard/login');
        $response->assertRedirect('admin/dashboard');
        $this->get('admin/dashboard/posts/random/edit')
            ->assertRedirect('404');
    }

    public function testDisplayPostDeletedToPass()
    {
        $admin = factory(Admin::class)->make();
        $response = $this->actingAs($admin)->post('admin/dashboard/login');
        $response->assertRedirect('admin/dashboard');
        $post = factory(Post::class)->create();
        $this->delete('admin/dashboard/posts/'.$post->id);
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id
        ]);
        $this->get('/posts')
            ->assertDontSee($post->id);
    }

    public function testDisplayPostDeletedToFail()
    {
        $admin = factory(Admin::class)->make();
        $response = $this->actingAs($admin)->post('admin/dashboard/login');
        $response->assertRedirect('admin/dashboard');
        $this->delete('admin/dashboard/posts/random')->assertRedirect('404');

    }


}
