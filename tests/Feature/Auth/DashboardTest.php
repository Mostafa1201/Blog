<?php

namespace Tests\Feature\Auth;

use App\Admin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDisplayDashboard()
    {
        $admin = factory(Admin::class)->make();
        $response = $this->actingAs($admin)->post('admin/dashboard/login');
        $this->get('admin/dashboard')
            ->assertStatus(200)
            ->assertSee('Admin Dashboard Homepage');
    }

}
