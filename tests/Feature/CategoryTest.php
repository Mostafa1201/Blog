<?php

namespace Tests\Feature;

use App\Admin;
use App\Category;
use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDisplayCategories()
    {
        $this->get('/categories')
            ->assertStatus(200)
            ->assertSee('All Categories');
    }

    public function testDisplayCategoryCreated()
    {
        $admin = factory(Admin::class)->make();
        $response = $this->actingAs($admin)->post('admin/dashboard/login');
        $response->assertRedirect('admin/dashboard');
        $category = factory(Category::class)->make();
        $response = $this->post('admin/dashboard/categories', [
            'name' => $category->name
        ]);
        $response->assertSuccessful();
        $category = factory(Category::class)->create([
            'name' => $category->name
        ]);

        $this->get('/categories')
            ->assertSee($category->name);
    }

    public function testDisplayCategoryUpdated()
    {
        $admin = factory(Admin::class)->make();
        $response = $this->actingAs($admin)->post('admin/dashboard/login');
        $response->assertRedirect('admin/dashboard');
        $category = factory(Category::class)->create();
        $categoryUpdatedName = $category->name.' Updated';
        $response = $this->put('admin/dashboard/categories/'.$category->id, [
            'name' => $categoryUpdatedName
        ]);
        $response->assertSuccessful();
        $category->name = $category->name.' Updated';
        $category->save();
        $this->assertDatabaseHas('categories', [
            'name' => $categoryUpdatedName
        ]);
        $this->get('/categories')
            ->assertSee($categoryUpdatedName);
    }

    public function testDisplayCategoryDeleted()
    {
        $admin = factory(Admin::class)->make();
        $response = $this->actingAs($admin)->post('admin/dashboard/login');
        $response->assertRedirect('admin/dashboard');
        $category = factory(Category::class)->create();
        $this->delete('admin/dashboard/categories/'.$category->id);
        $this->assertDatabaseMissing('categories', [
            'name' => $category->name
        ]);
        $this->get('/categories')
            ->assertDontSee($category->name);
    }

    public function testDisplayPostsThatBelongToACategory()
    {
        $category = factory(Category::class)->create();
        $post = factory(Post::class)->create([
            'category_id' => $category->id
        ]);
        $this->get('/categories/'.$category->id.'/posts')
            ->assertSee($post->name);
    }

}
