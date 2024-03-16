<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\BukuTamuUmum;
use App\Models\User;

class FilterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test filtering of bukutamu umum.
     *
     * @return void
     */
    public function test_bukutamuumumFilter()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        BukuTamuUmum::factory()->create([
            'created_at' => '2022-01-01 10:00:00', // Sesuaikan dengan tanggal yang diinginkan
            // Tambahkan atribut lain yang diperlukan sesuai kebutuhan pengujian
        ]);

        // Panggil rute untuk mengakses halaman dengan filter
        $response = $this->get('/bukutamu-umum/filter?bulan=1&tahun=2022');

        // Periksa bahwa respons memiliki status 200 (OK)
        $response->assertStatus(200);
        $response->assertSee('Buku Tamu Umum');
        $response->assertSee('Pilih Bulan');
        $response->assertSee('Pilih Tahun');
        $response->assertSee('Cari');
        $response->assertSee('No');
        $response->assertSee('Nama');
        $response->assertSee('Asal Daerah');
        $response->assertSee('Tanggal Kunjungan');
    }
}
