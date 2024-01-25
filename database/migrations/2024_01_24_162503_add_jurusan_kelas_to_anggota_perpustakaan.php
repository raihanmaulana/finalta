<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJurusanKelasToAnggotaPerpustakaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anggota_perpustakaan', function (Blueprint $table) {
            // Tambahkan kolom 'jurusan' dengan tipe string
            $table->string('jurusan')->after('nomor_anggota')->nullable();

            // Tambahkan kolom 'kelas' dengan tipe integer
            $table->integer('kelas')->after('jurusan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anggota_perpustakaan', function (Blueprint $table) {
            // Hapus kolom 'jurusan' dan 'kelas'
            $table->dropColumn('jurusan');
            $table->dropColumn('kelas');
        });
    }
}
