<?php

namespace Tests\Feature\Auth;

use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function testRegistrationScreenCanBeRendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testNewUsersCanRegister()
    {
        Role::insert([['id' => 1, 'name' => 'admin'], ['id' => 2, 'name' => 'user']]);
        $response = $this->post('/register', [
            'username' => 'testuser',
            'first_name' => 'first',
            'last_name' => 'last',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
