<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\AnggotaPerpustakaan;


class cariAnggotaByNomorAnggotaTest extends TestCase
{
    use DatabaseTransactions;

    public function test_cariAnggotaByNomorAnggota()
    {
        // Membuat pengguna untuk simulasi autentikasi
        $user = User::factory()->create();
        $this->actingAs($user);

        // Membuat data anggota perpustakaan
        $anggota = AnggotaPerpustakaan::factory()->create([
            'nomor_anggota' => '12345', // Nomor anggota yang akan dicari
            'nama_anggota' => 'John Doe', // Nama anggota yang akan dicari
            'email' => 'john@example.com',
            'jurusan' => 'IPA',
            'kelas' => '12 IPA 1',
            // Tambahkan atribut lain yang diperlukan
        ]);

        // Panggil route untuk mencari anggota berdasarkan nomor anggota
        $response = $this->getJson("/cari-anggota/12345");

        // Periksa bahwa respons memiliki status 200 (OK)
        $response->assertStatus(200);

        // Periksa bahwa respons berisi data anggota yang sesuai dengan nomor anggota yang dicari
        $response->assertJsonFragment([
            'nama_anggota' => 'John Doe',
            'nomor_anggota' => '12345',
            'email' => 'john@example.com',
            'jurusan' => 'IPA',
            'kelas' => '12 IPA 1',
        ]);

        // Periksa bahwa respons berisi atribut yang diharapkan untuk setiap anggota
        $response->assertJsonStructure([
            '*' => [
                'nama_anggota',
                'nomor_anggota',
                'email',
                'jurusan',
                'kelas',
            ]
        ]);
    }
}
