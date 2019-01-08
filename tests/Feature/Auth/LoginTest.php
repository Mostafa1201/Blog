<?php

namespace Tests\Feature\Auth;

use App\Admin;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminCanViewLoginPage(){
        $response = $this->get('admin/dashboard/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testAdminCannotViewLoginPageWhenAuthenticated()
    {
        $admin = factory(Admin::class)->make();
        $response = $this->actingAs($admin)->get('admin/dashboard/login');
        $response->assertRedirect('admin/dashboard');
    }

    public function testAdminCanLoginWithCorrectCredentials()
    {
        $admin = factory(Admin::class)->create([
            'password' => bcrypt($password = 'i-like-laravel'),
            'email_verified_at' => "2019-01-03 02:41:35"
        ]);
        $response = $this->post('admin/dashboard/login', [
            'email' => $admin->email,
            'password' => $password,
        ]);
        $response->assertRedirect('admin/dashboard');
        $this->assertAuthenticatedAs($admin);
    }

    public function testAdminCannotLoginWithIncorrectPassword()
    {
        $admin = factory(Admin::class)->create([
            'password' => bcrypt('i-love-laravel'),
            'email_verified_at' => "2019-01-03 02:41:35"
        ]);

        $response = $this->from('admin/dashboard/login')->post('admin/dashboard/login', [
            'email' => $admin->email,
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('admin/dashboard/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testAdminCanLogout(){
        $admin = factory(Admin::class)->create([
            'password' => bcrypt($password = 'i-like-laravel'),
            'email_verified_at' => "2019-01-03 02:41:35"
        ]);
        $response = $this->post('admin/dashboard/login', [
            'email' => $admin->email,
            'password' => $password,
        ]);
        $response->assertRedirect('admin/dashboard');
        $response = $this->get('admin/dashboard/logout');
        $response->assertRedirect('admin/dashboard/login');
    }
}
