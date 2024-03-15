<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $user = User::factory()->create([
            'username' => 'admin123',
            'password' => bcrypt('admin123'), // Encrypting the password
        ]);

        $userData = [
            'username' => 'admin123',
            'password' => 'admin123',
        ];

        // Submitting the login form
        $response = $this->post('/sign-in', $userData);

        // Verifying if the user is redirected to the intended page
        $response->assertRedirect('home');

        // Verifying if the user is authenticated
        $this->assertAuthenticated();
    }

    public function test_logout()
    {
        // Create a user and login
        $user = User::factory()->create();
        $this->actingAs($user);

        // Call the logout endpoint
        $response = $this->get('/sign-out');

        // Check if the user is redirected to the sign-in page after logout
        $response->assertRedirect(route('account-sign-in'));

        // Check if the user is no longer authenticated
        $this->assertGuest();
    }
}
