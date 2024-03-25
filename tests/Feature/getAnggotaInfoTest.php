<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\WithFaker;
use App\Models\AnggotaPerpustakaan;
use Tests\TestCase;

class getAnggotaInfoTest extends TestCase
{
    public function test_getAnggota()
    {
        // Membuat anggota perpustakaan untuk diuji
        $anggota = AnggotaPerpustakaan::factory()->create([
            'nomor_anggota' => '1234567894',
            'username' => 'maulana',
            'nama_anggota' => 'Maulana Raihan',
            'email' => 'maulana42@example.com',
            'jurusan' => 'IPA',
            'kelas' => '12 IPA 1',
        ]);

        // Panggil route untuk mendapatkan informasi anggota
        $response = $this->getJson("/getAnggotaInfo/1234567894");

        // Periksa bahwa respons memiliki status 200 (OK)
        $response->assertStatus(200);

        // Periksa bahwa respons berisi data anggota yang sesuai dengan nomor anggota yang dicari
        $response->assertJson([
            'nama_anggota' => 'Maulana Raihan',
            'email' => 'maulana42@example.com',
            'kelas' => '12 IPA 1',
        ]);
    }
}
