<?php

namespace Tests\Feature;

use App\Category;
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

    public function testDisplayPostsThatBelongToACategory()
    {
        $category = factory(Category::class)->make();
        $this->get('/categories')
            ->assertSee($category->id);
    }
}
