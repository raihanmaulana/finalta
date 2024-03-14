<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_buku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_buku');
            $table->string('isbn');
            $table->unsignedBigInteger('id_anggota');
            $table->string('status');
            $table->dateTime('tanggal_peminjaman');
            $table->dateTime('tanggal_pengembalian');
            $table->timestamps();

            // Define foreign keys
            $table->foreign('id_buku')->references('id_buku')->on('buku');
            $table->foreign('id_anggota')->references('id_anggota')->on('anggota_perpustakaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman_buku');
    }
}
