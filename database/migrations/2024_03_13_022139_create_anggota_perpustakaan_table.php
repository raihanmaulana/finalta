<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaPerpustakaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_perpustakaan', function (Blueprint $table) {
            $table->id('id_anggota');
            $table->string('nama_anggota');
            $table->string('nomor_anggota')->unique();
            $table->string('username')->unique();
            $table->string('nomor_hp')->unique();
            $table->string('email')->unique();
            $table->string('jurusan')->nullable();
            $table->string('kelas')->nullable();
            $table->string('password');
            $table->string('gambar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota_perpustakaan');
    }
}
