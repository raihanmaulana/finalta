<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase; // Menggunakan trait RefreshDatabase agar database di-reset setelah setiap pengujian


    /** @test */
    public function test_create()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $userData = [
            'nama' => 'Raihan Maulana',
            'username' => 'raihan',
            'email' => 'raihan@example.com',
            'password' => 'password123',
            'password_again' => 'password123',
        ];

        // Mengirim permintaan POST dan menangkap respons
        $response = $this->post('/create', $userData);

        // Memeriksa status respons
        $response->assertStatus(302);

        // Memastikan bahwa akun telah dibuat dengan benar di dalam database
        $this->assertDatabaseHas('users', [
            'username' => 'raihan',
            'email' => 'raihan@example.com',
            'nama' => 'Raihan Maulana',
        ]);

        $response->assertRedirect(route('account-sign-in'));

        $this->assertEquals('Akun Berhasil Dibuat.', session('sucsess'));
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
