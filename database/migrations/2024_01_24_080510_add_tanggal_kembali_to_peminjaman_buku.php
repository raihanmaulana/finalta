<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalKembaliToPeminjamanBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjaman_buku', function (Blueprint $table) {
            $table->date('tanggal_kembali')->nullable();
        });
    }

    public function down()
    {
        Schema::table('peminjaman_buku', function (Blueprint $table) {
            $table->dropColumn('tanggal_kembali');
        });
    }
}
