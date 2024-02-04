<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToAnggotaPerpustakaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anggota_perpustakaan', function (Blueprint $table) {
            $table->string('gambar')->nullable(); // Kolom gambar
        });
    }

    public function down()
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
}
