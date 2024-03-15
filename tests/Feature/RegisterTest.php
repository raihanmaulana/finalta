<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    use DatabaseTransactions; // Menggunakan trait RefreshDatabase agar database di-reset setelah setiap pengujian


    /** @test */
    public function test_create_berhasil()
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        $userData = [
            'nama' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_again' => 'password123',
        ];

        $response = $this->post('/create', $userData);

        $response->assertStatus(302);
        $response->assertRedirect(route('account-sign-in'));
        $this->assertEquals('Akun Berhasil Dibuat.', session('success'));

        $this->assertDatabaseHas('users', [
            'username' => 'testuser',
            'email' => 'test@example.com',
            'nama' => 'Test User',
        ]);
    }


    /** @test */
    public function test_create_inavlid()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/create', [
            'nama' => 'RaihanMaulana',
            'username' => '', // Field username kosong
            'email' => 'invalidemail', // Format email tidak valid
            'password' => 'password123',
            'password_again' => 'differentpassword', // Password konfirmasi tidak sesuai
        ]);

        // Memastikan responsnya adalah status 302 (redirect) karena validasi gagal
        $response->assertStatus(302);

        // Memastikan bahwa tidak ada data user baru yang masuk ke dalam database
        $this->assertDatabaseMissing('users', [
            'nama' => 'RaihanMaulana',
        ]);
    }
}
